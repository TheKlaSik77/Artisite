<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accueil – Arti'Site</title>
    <link rel="stylesheet" href="./assets/css/layout/header.css" />
</head>

<body>
    <header class="navbar">
        <div class="nav-left">
            <img src="./assets/img/logo_artisite_vf.png" alt="Logo Arti'Site" class="logo" />
        </div>

        <button class="hamburger" id="hamburger" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="nav-center" id="navMenu">
            <a href="index.php?page=homepage" class="nav-link">Accueil</a>
            <?php if (isAdmin()): ?>
                <a href="index.php?page=admin-craftmen" class="nav-link">Admin Dashboard</a>
            <?php endif; ?>
            <a href="index.php?page=craftmen" class="nav-link">Artisans</a>
            <a href="index.php?page=products" class="nav-link">Produits</a>
            <?php if (isCraftman()): ?>
                <a href="index.php?page=craftman-products" class="nav-link">Mes Produits</a>
            <?php endif; ?>
            <?php if (isUser() || isCraftman()): ?>
                <?php if (isCraftman()): ?>
                    <a href="index.php?page=craftman-support" class="nav-link">Support</a>
                <?php else: ?>
                    <a href="index.php?page=support" class="nav-link">Support</a>
                <?php endif; ?>
                <a href="index.php?page=faq" class="nav-link">FAQ</a>
            <?php endif; ?>
        </nav>

        <div class="nav-right">
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="index.php?page=signin" class="btn-signin">Se connecter</a>
                <a href="index.php?page=signup" class="btn-signup">S'inscrire</a>

            <?php elseif (!isAdmin()): ?>
                <a href="index.php?page=profil" class="icon-btn" aria-label="Mon profil">👤</a>
                <?php if (isUser()): ?>
                    <a href="index.php?page=cart" class="icon-btn" aria-label="Panier">🛒</a>
                <?php endif; ?>
                <a href="index.php?page=logout" class="btn-signin logout">Se déconnecter</a>

            <?php else: ?>
                <a href="index.php?page=logout" class="btn-signin logout">Se déconnecter</a>

            <?php endif; ?>
        </div>

    </header>

    <script>
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const navRight = document.querySelector('.nav-right');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
            navRight.classList.toggle('active');
        });

        // Close menu when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
                navRight.classList.remove('active');
            });
        });
    </script>
</body>