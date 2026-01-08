<?php

require_once './model/requests.craftmen.php';

function craftmenController(PDO $pdo)
{
    $search = trim($_GET['search'] ?? '');

    if ($search !== '') {
        $craftmen = searchCraftmen($pdo, $search);
    } else {
        $craftmen = getAllCraftmen($pdo);
    }

    require "./view/layout/header.php";
    require "./view/pages/craftmen.php";
    require "./view/layout/footer.php";
}

function getCraftmanController(PDO $pdo)
{
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        require "./view/pages/404.php";
        return;
    }

    $craftman = getCraftmanById($pdo, (int) $_GET['id']);
    $craftman = $craftman[0] ?? null;

    require "./view/layout/header.php";
    require "./view/pages/craftman.php";
    require "./view/layout/footer.php";
}
