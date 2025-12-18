<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page = $_GET['page'] ?? 'homepage';

$pages_autorisees = [
    'homepage', 'craftman', 'craftmen', 'products', 'events', 'cart',
    'profile', 'signin', 'signup',
    'offres',
    'logout',
    'cgu', 'contact', 'mentions-legales', 'faq', 'product1'
];

$pages_autorisees_admin = [
    'admin-dashboard', 'admin-craftmen', 'admin-customers', 'admin-products',
    'admin-orders', 'admin-reviews', 'admin-support'
];

$admin = false;

if (!in_array($page, $pages_autorisees) && !in_array($page, $pages_autorisees_admin)) {
    $page = 'homepage';
}

if (in_array($page, $pages_autorisees_admin)) {
    $admin = true;
    $page = "admin/{$page}";
}

if ($page === 'logout') {
    if ($page === 'logout') {
        require __DIR__ . '/model/logout.php';
        exit;
    }
}

if ($page === 'profile') {
    require __DIR__ . '/controller/profile.controller.php';
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Arti'Site</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/variables.css">
</head>

<body>
<?php if ($admin): ?>
    <div class="admin-container">
        <?php include "./view/pages/admin/admin-header.php"; ?>
        <?php include "./view/pages/{$page}.php"; ?>
    </div>
<?php else: ?>
    <?php include "./view/layout/header.php"; ?>
    <?php include "./view/pages/{$page}.php"; ?>
    <?php include "./view/layout/footer.php"; ?>
<?php endif; ?>
</body>
</html>
