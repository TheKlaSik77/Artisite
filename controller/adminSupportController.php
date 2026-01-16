<?php
require_once "./model/requests.support.php";
require_once "./model/utils/auth.php";

function adminSupportController(PDO $pdo)
{
    if (!isAdmin()) {
        die("Accès refusé.");
    }

    $action = $_GET['action'] ?? 'read';
    $ticketId = (int)($_GET['ticket_id'] ?? 0);

    // id admin (peut être 0 dans ton cas → on accepte NULL comme pour FAQ)
    $adminId = (int)($_SESSION['user']['id'] ?? 0);

    // Répondre
    if ($action === 'reply' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $message = trim($_POST['message'] ?? '');
        if ($ticketId > 0 && $message !== '') {
            supportAddMessage($pdo, $ticketId, 'admin', $adminId > 0 ? $adminId : null, $message);
            header("Location: index.php?page=admin-support&ticket_id=".$ticketId);
            exit;
        }
    }

    // Changer statut
    if ($action === 'status' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $status = $_POST['status'] ?? 'nouveau';
        if ($ticketId > 0) {
            supportUpdateStatus($pdo, $ticketId, $status);
            header("Location: index.php?page=admin-support&ticket_id=".$ticketId);
            exit;
        }
    }

    // Filtre
    $filter = $_GET['status'] ?? null;
    $tickets = supportGetAllTickets($pdo, $filter);

    $currentTicket = $ticketId ? supportGetTicket($pdo, $ticketId) : null;
    $messages = $currentTicket ? supportGetMessages($pdo, $ticketId) : [];

    require "./view/layout/admin-layout-start.php";
    require "./view/pages/admin/admin-support.php";
    require "./view/layout/admin-layout-end.php";
}
