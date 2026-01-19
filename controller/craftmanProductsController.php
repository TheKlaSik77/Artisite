<?php

require_once "./model/requests.craftmanProducts.php";
function craftmanProductsController($pdo){
    $action = $_GET['action'] ?? 'read';
    $craftman_id = $_SESSION['user']['id'];
    $craftman_products = getAllProductsOfCraftman($pdo, $craftman_id);

    switch ($action) {
            
        case 'update':
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

function editCraftmanProductController(PDO $pdo)
{
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?page=signin");
        exit;
    }

    $craftman_id = $_SESSION['user']['id'];
    $product_id = (int) ($_GET['id'] ?? 0);

    if ($product_id <= 0) {
        header("Location: index.php?page=craftman-products");
        exit;
    }

    require_once "./model/requests.craftmanProducts.php";
    require_once "./model/requests.category.php";

    // POST → sauvegarde des modifications
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        updateCraftmanProduct($pdo, $product_id, $craftman_id, [
            'name' => $_POST['name'],
            'unit_price' => $_POST['unit_price'],
            'quantity' => $_POST['quantity'],
            'description' => $_POST['description'],
            'category_id' => $_POST['category_id']
        ]);

        header("Location: index.php?page=craftman-products");
        exit;
    }

    // GET → affichage du formulaire prérempli
    $product = getCraftmanProductById($pdo, $product_id, $craftman_id);
    $categories = getAllCategories($pdo);

    if (!$product) {
        header("Location: index.php?page=craftman-products");
        exit;
    }

    require "./view/layout/header.php";
    require "./view/pages/edit-product.php";
    require "./view/layout/footer.php";
}
