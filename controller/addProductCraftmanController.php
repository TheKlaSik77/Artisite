<?php
require_once './model/requests.addProductsCraftman.php';

function blockBackslashes(array $values): void
{
    foreach ($values as $v) {
        if (is_string($v) && strpos($v, '\\') !== false) {
            http_response_code(400);
            die('Backslash interdit');
        }
    }
}

function addProductCraftmanController(PDO $pdo)
{
    $action = $_GET['action'] ?? 'read';
    $categories = getAllCategories($pdo);

    switch ($action) {
        case 'add':
            addProductController($pdo);
            break;

        case 'read':
        default:
            require "./view/layout/header.php";
            require "./view/pages/add-product-craftman.php";
            require "./view/layout/footer.php";
            break;
    }
}

function addProductController(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }

    $name = trim($_POST["name"] ?? '');
    $unit_price = trim($_POST["unit_price"] ?? '');
    $category_id = (int)($_POST["category_id"] ?? 0);
    $quantity = (int)($_POST["quantity"] ?? 0);
    $description = trim($_POST["description"] ?? '');
    $craftman_id = (int)($_SESSION["user"]["id"] ?? 0);

    blockBackslashes([$name, $unit_price, $description]);

    if ($craftman_id <= 0) {
        require "./view/pages/404.php";
        return;
    }

    if ($name === '' || $description === '' || $category_id <= 0) {
        die("Champs invalides");
    }

    insertProduct($pdo, $name, $category_id, $unit_price, $quantity, $description, $craftman_id);

    header("Location: index.php?page=craftman-products");
    exit;
}
