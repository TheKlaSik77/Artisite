<?php
require_once "./model/requests.support.php";

function supportController(PDO $pdo)
{
    // IMPORTANT : adapte si ton session user stocke autrement
    $customerId = (int)($_SESSION['user']['id'] ?? 0);
    if ($customerId <= 0) {
        die("Accès refusé : utilisateur non connecté.");
    }

    $action = $_GET['action'] ?? 'read';
    $ticketId = (int)($_GET['ticket_id'] ?? 0);

    // Créer un ticket
    if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $subject = trim($_POST['subject'] ?? '');
        $craftmanId = (int)($_POST['craftman_id'] ?? 0);
        $message = trim($_POST['message'] ?? '');

        if ($subject !== '' && $craftmanId > 0 && $message !== '') {
            $newTicketId = supportCreateTicket($pdo, $subject, $craftmanId, $customerId);
            supportAddMessage($pdo, $newTicketId, 'customer', $customerId, $message);
            header("Location: index.php?page=support&ticket_id=".$newTicketId);
            exit;
        }
    }

    // Répondre dans un ticket
    if ($action === 'reply' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $message = trim($_POST['message'] ?? '');
        if ($ticketId > 0 && $message !== '') {
            $ticket = supportGetTicket($pdo, $ticketId);
            if (!$ticket || (int)$ticket['customer_id'] !== $customerId) {
                die("Ticket introuvable ou non autorisé.");
            }
            supportAddMessage($pdo, $ticketId, 'customer', $customerId, $message);
            header("Location: index.php?page=support&ticket_id=".$ticketId);
            exit;
        }
    }

    // Affichage
    $tickets = supportGetTicketsForCustomer($pdo, $customerId);
    $currentTicket = $ticketId ? supportGetTicket($pdo, $ticketId) : null;
    $messages = ($currentTicket && (int)$currentTicket['customer_id'] === $customerId)
        ? supportGetMessages($pdo, $ticketId)
        : [];

    require "./view/layout/header.php";
    require "./view/pages/support.php";
    require "./view/layout/footer.php";
}
