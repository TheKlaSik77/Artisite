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

require "./model/utils/connexion.php";

// On récupère la valeur de page dans l'url (ex d'url http://localhost/artisite/index.php?page=cart). Si pas de page précisée, on fixe l'attribut à homepage pour renvoyer automatiquement sur la page d'accueil.
$page = $_GET['page'] ?? 'homepage';

// Par sécurité, on précise une "white-list" de page dont l'accès est autorisé.
$pages_autorisees = ['homepage', 'craftman', 'craftmen', 'products', 'events', 'cart', 'profil', 'signin', 'signup', 'cgu', 'contact', 'mentions-legales', 'faq', 'product1'];

$pages_autorisees_admin = ['admin-dashboard', 'admin-craftmen', 'admin-customers', 'admin-products', 'admin-orders', 'admin-reviews', 'admin-support'];

$admin = false;

// Si page non autorisée, on renvoie vers homepage en fixant l'attribut page à homepage
if (!in_array($page, $pages_autorisees)) {
    $page = 'homepage';
    
}
if (in_array($page, $pages_autorisees_admin)) {
    $admin = true;
    $page = "admin/{$page}";
}
?>



<?php if ($admin == true): ?>

    <div class="admin-container">  
        <?php include "./view/pages/admin/admin-header.php"; ?>
        <?php include "./view/pages/{$page}.php"; ?>
    </div>

<?php else: ?>

    <?php include "./view/layout/header.php"; ?>
    <?php include "./view/pages/{$page}.php"; ?>
    <?php include "./view/layout/footer.php"; ?>
<?php endif; ?>