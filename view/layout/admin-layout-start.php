<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Arti'Site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/layout/admin-layout.css">
    <link rel="stylesheet" href="./assets/css/layout/admin-header.css">

    <?php if (($_GET['page'] ?? '') === 'admin-dashboard'): ?>
        <link rel="stylesheet" href="./assets/css/pages/admin/admin-dashboard.css">
    <?php endif; ?>

</head>
<body class="admin-layout">
