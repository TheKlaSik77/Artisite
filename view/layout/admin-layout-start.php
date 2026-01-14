<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Admin – Arti'Site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/layout/admin-layout.css">
    <link rel="stylesheet" href="./assets/css/layout/admin-header.css">

    <?php if (($_GET['page'] ?? '') === 'admin-craftmen'): ?>
        <link rel="stylesheet" href="./assets/css/pages/admin/admin-craftmen.css">
    <?php elseif (($_GET['page'] ?? '') === 'admin-customers'): ?>
        <link rel="stylesheet" href="./assets/css/pages/admin/admin-customers.css">
    <?php elseif (($_GET['page'] ?? '') === 'admin-orders'): ?>
        <link rel="stylesheet" href="./assets/css/pages/admin/admin-orders.css">
    <?php elseif (($_GET['page'] ?? '') === 'admin-reviews'): ?>
        <link rel="stylesheet" href="./assets/css/pages/admin/admin-reviews.css">
    <?php elseif (($_GET['page'] ?? '') === 'admin-support'): ?>
        <link rel="stylesheet" href="./assets/css/pages/admin/admin-support.css">
    <?php elseif (($_GET['page'] ?? '') === 'admin-faq'): ?>
        <link rel="stylesheet" href="./assets/css/pages/admin/admin-faq.css">
    <?php endif; ?>

</head>

<body class="admin-layout">
    <nav>
        <a href="index.php?page=admin-craftmen" class="nav-item">Artisans</a>
        <a href="index.php?page=admin-customers" class="nav-item">Clients</a>
        <a href="index.php?page=admin-products" class="nav-item">Produits</a>
        <a href="index.php?page=admin-orders" class="nav-item">Commandes</a>
        <a href="index.php?page=admin-reviews" class="nav-item">Avis</a>
        <a href="index.php?page=admin-support" class="nav-item">Support</a>
        <a href="index.php?page=admin-faq" class="nav-item">FAQ</a>
    </nav>