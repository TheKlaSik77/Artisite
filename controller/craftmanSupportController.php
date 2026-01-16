<?php
require_once "./model/requests.support.php";

function craftmanSupportController(PDO $pdo)
{
    

    // Adapte à ta session artisan (si c’est différent)
    $craftmanId = (int)($_SESSION['user']['id'] ?? 0);
    if ($craftmanId <= 0) {
        die("Accès refusé : artisan non connecté.");
    }

    $action = $_GET['action'] ?? 'read';
    $ticketId = (int)($_GET['ticket_id'] ?? 0);

    // Répondre
    if ($action === 'reply' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $message = trim($_POST['message'] ?? '');
        if ($ticketId > 0 && $message !== '') {
            $ticket = supportGetTicket($pdo, $ticketId);
            if (!$ticket || (int)$ticket['craftman_id'] !== $craftmanId) {
                die("Ticket introuvable ou non autorisé.");
            }
            supportAddMessage($pdo, $ticketId, 'craftman', $craftmanId, $message);
            supportUpdateStatus($pdo, $ticketId, 'en_cours');
            header("Location: index.php?page=craftman-support&ticket_id=".$ticketId);
            exit;
        }
    }

    // Changer statut
    if ($action === 'status' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $status = $_POST['status'] ?? 'nouveau';
        if ($ticketId > 0) {
            $ticket = supportGetTicket($pdo, $ticketId);
            if (!$ticket || (int)$ticket['craftman_id'] !== $craftmanId) {
                die("Non autorisé.");
            }
            supportUpdateStatus($pdo, $ticketId, $status);
            header("Location: index.php?page=craftman-support&ticket_id=".$ticketId);
            exit;
        }
    }

    $tickets = supportGetTicketsForCraftman($pdo, $craftmanId);
    $currentTicket = $ticketId ? supportGetTicket($pdo, $ticketId) : null;
    $messages = ($currentTicket && (int)$currentTicket['craftman_id'] === $craftmanId)
        ? supportGetMessages($pdo, $ticketId)
        : [];

    // Ici tu peux utiliser un layout artisan si tu en as, sinon header normal
    require "./view/layout/header.php";
    require "./view/pages/craftman-support.php";
    require "./view/layout/footer.php";
}
