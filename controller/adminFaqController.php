<?php
require_once "./model/requests.faq.php";

function adminFaqController(PDO $pdo)
{
    $action = $_GET['action'] ?? 'read';

    // Option B : l'ID admin peut être NULL
    $adminId = (int)($_SESSION['user']['id'] ?? 0);

    if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $question = trim($_POST['question'] ?? '');
        $answer   = trim($_POST['answer'] ?? '');

        if ($question !== '' && $answer !== '') {
            faqCreate($pdo, $question, $answer, $adminId);
        }

        $action = 'read';
    }

    if ($action === 'delete') {
        faqDelete($pdo, (int)($_GET['id'] ?? 0));
        $action = 'read';
    }

    $faqs = faqGetAllAdmin($pdo);

    require "./view/layout/admin-layout-start.php";
    require "./view/pages/admin/admin-faq.php";
    require "./view/layout/admin-layout-end.php";
}
