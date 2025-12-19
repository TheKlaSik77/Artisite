<?php

require_once './model/requests.cart.php';


function cartController(PDO $pdo)
{
    // Sécurité
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }

    $user_id = $_SESSION['user']['id'];
    $action = $_GET['action'] ?? 'read';

    switch ($action) {
        case 'add':
            cartAddController($pdo, $user_id);
            break;

        case 'delete':
            cartDeleteController($pdo, $user_id);
            break;

        case 'update':
            cartUpdateQuantityController($pdo, $user_id);
            break;

        default:
            cartReadController($pdo, $user_id);
            break;
    }
}
function cartReadController(PDO $pdo, int $user_id)
{

    $productsOnCart = getCartByUser($pdo, $user_id);
    $totalPrice = getTotalPriceOfCart($pdo, $user_id);
    require "./view/layout/header.php";
    require "./view/pages/cart.php";
    require "./view/layout/footer.php";
}

function cartAddController(PDO $pdo, int $user_id)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }

    $product_id = (int) $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];

    $shopping_cart_id = getCartIdByUser($pdo, $user_id);
    if ($shopping_cart_id != null) {
        insertProductOnCart($pdo, $shopping_cart_id, $product_id, $quantity);
    }
    header("Location: index.php?page=cart");
    exit;
}

function cartUpdateQuantityController(PDO $pdo, int $user_id){
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }
    
    $product_id = $_POST["product_id"];
    $new_quantity = $_POST["quantity"];
    $shopping_cart_id = getCartIdByUser($pdo, $user_id);

    if ($shopping_cart_id != null) {
        updateProductQuantityOnCart($pdo, $shopping_cart_id, $product_id, $new_quantity);
    }
    header("Location: index.php?page=cart");
    exit;
}

function cartDeleteController(PDO $pdo, int $user_id)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }
    
    $product_id = $_POST["product_id"];
    $shopping_cart_id = getCartIdByUser($pdo, $user_id);
    if ($shopping_cart_id != null) {
        deleteProductFromCart($pdo, $shopping_cart_id, $product_id);
    }
    header("Location: index.php?page=cart");
    exit;

}