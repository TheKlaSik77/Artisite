<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Arti'Site</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<?php
// page demandée dans l'URL : index.php?page=homepage
$page = $_GET['homepage'] ?? 'homepage';

// SÉCURITÉ : on autorise seulement certaines pages
$pages_autorisees = ['homepage'];

if (!in_array($page, $pages_autorisees)) {
    $page = 'homepage';
}

require './view/header.php';

// On inclut le contenu central
require './view/pages/' . $page . '.php';

require './view/footer.php';

?>