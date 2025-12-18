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
# Ajouter liste de page autorisées pour sécurité

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case "home":
        require "./view/layout/header.php";
        require "./view/pages/homepage.php";
        require "./view/layout/footer.php";
        break;

    case "products":
        require_once "./controller/productController.php";
        productsController($pdo);
        break;

    case "product":
        require_once "./controller/productController.php";
        $id = $_GET['id'];
        productController($pdo, $id);
        break;

    case "cart":
        require_once "./controller/cartController.php";
        $action = $_GET['action'] ?? "read";
        $user_id = 1;
        switch ($action) {
            case "add":
                cartAddController($pdo, $user_id);
                break;
            
            case "delete":
                cartDeleteController($pdo, $user_id);
                break;

            case "update":
                cartUpdateQuantityController($pdo,$user_id);
                break;

            case "read":
                cartReadController($pdo, $user_id);
                break;
        }

    default:
        require "./view/layout/header.php";
        require "./view/pages/{$page}.php";
        require "./view/layout/footer.php";
        break;


}
