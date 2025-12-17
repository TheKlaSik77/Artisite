<?php

require_once './model/requests.products.php';


function productsController($pdo)
{
    $products = getAllProducts($pdo);
    require "./view/layout/header.php";
    require "./view/pages/products.php";
    require "./view/layout/footer.php";
}

function productController($pdo, $id){
    $product = getProductById($pdo,$id)[0] ?? null;
    require "./view/layout/header.php";
    require "./view/pages/product1.php";
    require "./view/layout/footer.php";
}