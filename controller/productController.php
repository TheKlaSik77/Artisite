<?php

require_once './model/requests.product.php';

/**
 * Affiche la liste des produits
 */
function productsController(PDO $pdo)
{
    $products = getAllProducts($pdo);

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
