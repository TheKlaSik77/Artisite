<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Arti'Site</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Intègre toutes les variables css nécéssaires aux autres fichiers css -->
    <link rel="stylesheet" href="./assets/css/variables.css">
</head>

<?php

require_once "./model/utils/connexion.php";
require_once "./controller/controller.php";

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case "home":
        require "./view/layout/header.php";
        require "./view/pages/homepage.php";
        require "./view/layout/footer.php";
        break;

    case "products":
        productsController($pdo);
        break;

    case "product":
        $id = $_GET['id'];
        productController($pdo,$id);
        break;


}
