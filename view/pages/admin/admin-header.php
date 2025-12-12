<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accueil – Arti'Site Admin</title>
    <link rel="stylesheet" href="./assets/css/pages/admin/admin-header.css" />
</head>


<body>
    <main class="sidebar">
        <aside class="sidebar">
            <div class="sidebar-logo">
                <span>Artisite</span><small>Admin</small>
            </div>

            <nav class="sidebar-nav">
                <a href="index.php?page=admin-dashboard"
                    class="nav-item <?php echo ($_GET['page'] === 'admin-dashboard') ? 'active' : ''; ?>">Dashboard</a>
                <a href="index.php?page=admin-craftmen"
                    class="nav-item <?php echo ($_GET['page'] === 'admin-craftmen') ? 'active' : ''; ?>">Artisans</a>
                <a href="index.php?page=admin-customers"
                    class="nav-item <?php echo ($_GET['page'] === 'admin-customers') ? 'active' : ''; ?>">Clients</a>
                <a href="index.php?page=admin-products"
                    class="nav-item <?php echo ($_GET['page'] === 'admin-products') ? 'active' : ''; ?>">Produits</a>
                <a href="index.php?page=admin-orders"
                    class="nav-item <?php echo ($_GET['page'] === 'admin-orders') ? 'active' : ''; ?>">Commandes</a>
                <a href="index.php?page=admin-reviews"
                    class="nav-item <?php echo ($_GET['page'] === 'admin-reviews') ? 'active' : ''; ?>">Avis</a>
                <a href="index.php?page=admin-support"
                    class="nav-item <?php echo ($_GET['page'] === 'admin-support') ? 'active' : ''; ?>">Support</a>
            </nav>
        </aside>
    </main>
</body>