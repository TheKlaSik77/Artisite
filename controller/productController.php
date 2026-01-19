<?php

require_once './model/requests.product.php';
require_once './model/requests.category.php';

/**
 * Affiche la liste des produits
 */
function productsController(PDO $pdo)
{
    $search = trim($_GET['search'] ?? '');
    $category = $_GET['category'] ?? 'Tous';
    $sort = $_GET['sort'] ?? 'newest';

    $products = filterProducts($pdo, $search, $category, $sort);
    $categories = getAllCategories($pdo);

    require './view/layout/header.php';
    require './view/pages/products.php';
    require './view/layout/footer.php';
}


/**
 * Affiche la page d’un produit
 */
function productController(PDO $pdo, int $id)
{
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
