<?php

require_once './model/requests.product.php';

/**
 * Affiche la liste des produits
 */
function productsController(PDO $pdo)
{
    $search   = trim($_GET['search'] ?? '');
    $category = $_GET['category'] ?? 'Tous';
    $material = $_GET['material'] ?? 'Tous';

    $products = filterProducts($pdo, $search, $category, $material);

    require './view/layout/header.php';
    require './view/pages/products.php';
    require './view/layout/footer.php';
}


/**
 * Affiche la page d’un produit
 */
function productController(PDO $pdo, int $id)
{
    // Sécurité ID
    if ($id <= 0) {
        require './view/pages/404.php';
        return;
    }

    // Récupération du produit
    $product = getProductById($pdo, $id);

    if (!$product) {
        require './view/pages/404.php';
        return;
    }

    require './view/layout/header.php';
    require './view/pages/product.php';
    require './view/layout/footer.php';
}
