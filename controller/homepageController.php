<?php

function homepageController($pdo)
{
    require_once "./model/requests.craftmen.php";
    require_once "./model/requests.products.php";

    // Récupérer les 3 derniers artisans validés
    $latestCraftmen = getThreeLatestsValidatedCraftmen($pdo);
    // Préparer les URLs des images
    foreach ($latestCraftmen as &$craftman) {
        if (!empty($craftman['profile_image'])) {
            $craftman['image_url'] = './' . ltrim($craftman['profile_image'], '/');
        } else {
            $craftman['image_url'] = './assets/img/artisan.jpg';
        }
    }

    // Récupérer les 3 derniers produits ajoutés
    $latestProducts = getThreeLatestProducts($pdo);
    // Préparer les URLs des images
    foreach ($latestProducts as &$product) {
        if (!empty($product['image_links'])) {
            $images = explode('||', $product['image_links']);
            $product['image_url'] = './' . ltrim($images[0], '/');
        } else {
            $product['image_url'] = './assets/img/produit.jpg';
        }
    }

    require "./view/layout/header.php";
    require "./view/pages/homepage.php";
    require "./view/layout/footer.php";
}
