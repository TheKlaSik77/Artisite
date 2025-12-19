<?php

require_once "./model/requests.craftmanProducts.php";
function craftmanProductsController($pdo){
    $action = $_GET['action'] ?? 'read';
    $craftman_id = $_SESSION['user']['id'];
    $craftman_products = getAllProductsOfCraftman($pdo, $craftman_id);

    switch ($action) {
            

        case 'read':
        default:
            require "./view/layout/header.php";
            require "./view/pages/craftman-products.php";
            require "./view/layout/footer.php";
            break;
    }
}