<?php

require_once "./model/requests.craftmanProducts.php";
function craftmanProductsController($pdo){
    $action = $_GET['action'] ?? 'read';
    $craftman_id = $_SESSION['user']['id'];
    $craftman_products = getAllProductsOfCraftman($pdo, $craftman_id);

    switch ($action) {
            
        case 'updateQuantity':
            updateCraftmanProductsQuantityController($pdo);
            break;
            
        case 'delete':
            deleteCraftmanProductsController($pdo);
            break;

        case 'read':
        default:
            require "./view/layout/header.php";
            require "./view/pages/craftman-products.php";
            require "./view/layout/footer.php";
            break;
    }
}

function updateCraftmanProductsQuantityController($pdo){
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }
    
    $product_id = $_POST["product_id"];
    $new_quantity = $_POST["quantity"];

    if ($product_id != null) {
        updateCraftmanProductsQuantity($pdo, $product_id, $new_quantity);
    }
    header("Location: index.php?page=craftman-products");
    exit;
}

function deleteCraftmanProductsController(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }
    
    $product_id = $_POST["product_id"];
    if ($product_id != null) {
        deleteProduct($pdo, $product_id);
    }
    header("Location: index.php?page=craftman-products");
    exit;

}