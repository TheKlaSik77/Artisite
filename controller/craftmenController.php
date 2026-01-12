<?php

require_once './model/requests.craftmen.php';


function craftmenController($pdo)
{
    $craftmen = getAllCraftmen($pdo); // Modèle
    require "./view/layout/header.php";     // Vue
    require "./view/pages/craftmen.php";
    require "./view/layout/footer.php";
}

function getCraftmanController(PDO $pdo){
    $id = $_GET["id"];
    $craftman = getCraftmanById($pdo, $id)[0] ?? null;
    require "./view/layout/header.php";
    require "./view/pages/craftman.php";
    require "./view/layout/footer.php";
}