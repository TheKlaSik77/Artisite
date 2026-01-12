<?php
require_once './model/requests.addProductsCraftman.php';


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

    $name = $_POST["name"];
    $unit_price = $_POST["unit_price"];
    $category_id = $_POST["category_id"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    $craftman_id = $_SESSION["user"]["id"];

    insertProduct($pdo, $name, $category_id, $unit_price, $quantity, $description, $craftman_id);
    header("Location: index.php?page=craftman-products");
    exit;
}



