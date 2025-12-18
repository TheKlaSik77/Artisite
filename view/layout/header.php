<?php
// header.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$loggedIn   = !empty($_SESSION['logged_in']);
$isCraftman = $loggedIn && ($_SESSION['account_type'] ?? '') === 'craftman';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Arti'Site</title>
    <link rel="stylesheet" href="./assets/css/layout/header.css" />
</head>

<body>
<header class="navbar">
    <div class="nav-left">
        <img src="./assets/img/logo_artisite.jpeg" alt="Logo Arti'Site" class="logo" />
    </div>

    <nav class="nav-center">
        <a href="index.php?page=homepage" class="nav-link">Accueil</a>
        <a href="index.php?page=craftmen" class="nav-link">Artisans</a>
        <a href="index.php?page=products" class="nav-link">Produits</a>
        <a href="index.php?page=events" class="nav-link">Événements</a>

        <?php if ($isCraftman): ?>
            <a href="index.php?page=offres" class="nav-link">Mes offres</a>
        <?php endif; ?>
    </nav>

    <div class="nav-right">
        <a href="index.php?page=cart" class="icon-btn">🛒</a>

        <?php if ($loggedIn): ?>
            <a href="index.php?page=profile" class="btn-signup">Profil</a>

            <form action="index.php?page=logout" method="POST" style="display:inline;">
                <button type="submit" class="btn-signin">Déconnexion</button>
            </form>
        <?php else: ?>
            <a href="index.php?page=signin" class="btn-signin">Se connecter</a>
            <a href="index.php?page=signup" class="btn-signup">S'inscrire</a>
        <?php endif; ?>
    </div>
</header>
</body>
</html>
