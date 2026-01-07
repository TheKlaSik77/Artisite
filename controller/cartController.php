<?php

require_once './model/requests.cart.php';
require_once './model/requests.product.php';

function cartController(PDO $pdo)
{
    // Utilisateur connecté obligatoire
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=signin');
        exit;
    }

    $user_id = (int) $_SESSION['user']['id'];
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

/* =========================
   AFFICHAGE DU PANIER
========================= */
function cartReadController(PDO $pdo, int $user_id)
{
    $productsOnCart = getCartByUser($pdo, $user_id);
    $totalPrice = getTotalPriceOfCart($pdo, $user_id);

    require "./view/layout/header.php";
    require "./view/pages/cart.php";
    require "./view/layout/footer.php";
}

/* =========================
   AJOUT AU PANIER (SÉCURISÉ)
========================= */
function cartAddController(PDO $pdo, int $user_id)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }

    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $quantity   = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;

    if ($product_id <= 0 || $quantity <= 0) {
        require "./view/pages/404.php";
        return;
    }

    // 🔑 Récupération du produit AVEC stock
    $product = getProductById($pdo, $product_id);

    if (!$product) {
        require "./view/pages/404.php";
        return;
    }

    $stockDisponible = (int) $product['quantity'];

    // ❌ Stock insuffisant
    if ($quantity > $stockDisponible) {
        $_SESSION['error'] = "Stock insuffisant. Disponible : $stockDisponible";
        header("Location: index.php?page=product&id=" . $product_id);
        exit;
    }

    // Panier utilisateur
    $cart_id = getCartIdByUser($pdo, $user_id);
    if (!$cart_id) {
        require "./view/pages/404.php";
        return;
    }

    // Produit déjà dans le panier ?
    $existing = getProductFromCart($pdo, $cart_id, $product_id);

    if ($existing) {
        $newQuantity = (int)$existing['quantity'] + $quantity;

        if ($newQuantity > $stockDisponible) {
            $_SESSION['error'] = "Stock insuffisant pour cette quantité.";
            header("Location: index.php?page=product&id=" . $product_id);
            exit;
        }

        updateProductQuantityOnCart(
            $pdo,
            $cart_id,
            $product_id,
            $newQuantity
        );
    } else {
        insertProductOnCart(
            $pdo,
            $cart_id,
            $product_id,
            $quantity
        );
    }

    header("Location: index.php?page=cart");
    exit;
}

/* =========================
   MODIFIER QUANTITÉ
========================= */
function cartUpdateQuantityController(PDO $pdo, int $user_id)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }

    $product_id = (int)$_POST['product_id'];
    $quantity   = (int)$_POST['quantity'];

    if ($product_id <= 0 || $quantity <= 0) {
        require "./view/pages/404.php";
        return;
    }

    $product = getProductById($pdo, $product_id);
    if (!$product || $quantity > (int)$product['quantity']) {
        $_SESSION['error'] = "Stock insuffisant";
        header("Location: index.php?page=cart");
        exit;
    }

    $cart_id = getCartIdByUser($pdo, $user_id);
    updateProductQuantityOnCart($pdo, $cart_id, $product_id, $quantity);

    header("Location: index.php?page=cart");
    exit;
}

/* =========================
   SUPPRIMER PRODUIT
========================= */
function cartDeleteController(PDO $pdo, int $user_id)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }

    $product_id = (int)$_POST['product_id'];
    $cart_id = getCartIdByUser($pdo, $user_id);

    deleteProductFromCart($pdo, $cart_id, $product_id);

    header("Location: index.php?page=cart");
    exit;
}
