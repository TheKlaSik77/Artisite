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

// On récupère la valeur de page dans l'url (ex d'url http://localhost/artisite/index.php?page=cart). Si pas de page précisée, on fixe l'attribut à homepage pour renvoyer automatiquement sur la page d'accueil.
$page = $_GET['page'] ?? 'homepage';

// Par sécurité, on précise une "white-list" de page dont l'accès est autorisé.
$pages_autorisees = ['homepage', 'cart', 'profil', 'signin', 'signup','cgu','contact','mentions-legales','faq','products'];

// Si page non autorisée, on renvoie vers homepage en fixant l'attribut page à homepage
if (!in_array($page, $pages_autorisees)) {
    $page = 'homepage';
}

// On construit la page, on ajoute d'abord le header, puis le contenu principal correspondant à la page demandée et enfin le footer
require './view/layout/header.php';

require "./view/pages/{$page}.php";        // Le {$nom_attribut} permet d'insérer la valeur de l'attribut page en string.

require "./view/layout/footer.php";

?>