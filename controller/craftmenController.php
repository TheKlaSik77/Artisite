<?php

require_once './model/requests.products.php';


function craftmenController($pdo)
{
    $craftmen = getAllCraftmen($pdo); // Modèle
    require "./view/layout/header.php";     // Vue
    require "./view/pages/craftmen.php";
    require "./view/layout/footer.php";
}

function getCraftmanController($pdo, $id){
    $product = getCraftmanById($pdo,$id)[0] ?? null;
    require "./view/layout/header.php";
    require "./view/pages/product.php";
    require "./view/layout/footer.php";
}