<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Dashboard</title>
    <link rel="stylesheet" href="admin-dashboard.css">
</head>
<body>

<div class="admin-layout">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <span>Artisite</span>
            <small>Admin</small>
        </div>
        <nav class="sidebar-nav">
            <a href="admin-dashboard.html" class="nav-item active">Dashboard</a>
            <a href="admin-artisans.html" class="nav-item">Artisans</a>
            <a href="admin-clients.html" class="nav-item">Clients</a>
            <a href="admin-produits.html" class="nav-item">Produits</a>
            <a href="admin-commandes.html" class="nav-item">Commandes</a>
            <a href="admin-avis.html" class="nav-item">Avis</a>
            <a href="admin-support.html" class="nav-item">Support</a>
        </nav>
    </aside>

    <!-- CONTENU PRINCIPAL -->
    <main class="main">
        <header class="main-header">
            <button id="toggleSidebar" class="btn-icon">☰</button>
            <div class="header-right">
                <span class="admin-name">Admin</span>
                <button class="btn-small-outline">Se déconnecter</button>
            </div>
        </header>

        <section class="main-content">
            <h1 class="page-title">Tableau de bord</h1>

            <!-- Cartes statistiques -->
            <div class="cards-row">
                <article class="card">
                    <p class="card-label">Artisans actifs</p>
                    <p class="card-value" id="statArtisans">32</p>
                </article>
                <article class="card">
                    <p class="card-label">Clients</p>
                    <p class="card-value" id="statClients">214</p>
                </article>
                <article class="card">
                    <p class="card-label">Commandes du mois</p>
                    <p class="card-value" id="statCommandes">87</p>
                </article>
                <article class="card">
                    <p class="card-label">CA estimé (mois)</p>
                    <p class="card-value" id="statCA">4 320 €</p>
                </article>
            </div>

            <!-- Activité récente -->
            <section class="panel">
                <div class="panel-header">
                    <h2>Activité récente</h2>
                    <select id="rangeSelect">
                        <option value="7">7 derniers jours</option>
                        <option value="30">30 derniers jours</option>
                    </select>
                </div>
                <div class="panel-body">
                    <ul class="activity-list" id="activityList">
                        <li>🧑‍🎨 Nouvel artisan inscrit : <strong>Atelier des Bois</strong></li>
                        <li>🛒 Nouvelle commande passée par <strong>Camille D.</strong></li>
                        <li>⭐ Nouvel avis sur <strong>Bol en céramique</strong></li>
                        <li>❗ Avis signalé sur <strong>Planche en bois massif</strong></li>
                    </ul>
                </div>
            </section>
        </section>
    </main>
</div>

<script>
    // Toggle sidebar en mobile
    const toggleSidebarBtn = document.getElementById("toggleSidebar");
    const sidebar = document.querySelector(".sidebar");

    toggleSidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("sidebar-open");
    });

    // Petit JS pour simuler un changement de période
    const rangeSelect = document.getElementById("rangeSelect");
    const activityList = document.getElementById("activityList");

    rangeSelect.addEventListener("change", () => {
        const value = rangeSelect.value;
        activityList.innerHTML = "";
        if (value === "7") {
            activityList.innerHTML = `
                <li>🧑‍🎨 Nouvel artisan inscrit : <strong>Atelier des Bois</strong></li>
                <li>🛒 Nouvelle commande passée par <strong>Camille D.</strong></li>
                <li>⭐ Nouvel avis sur <strong>Bol en céramique</strong></li>
            `;
        } else {
            activityList.innerHTML = `
                <li>🧑‍🎨 4 nouveaux artisans inscrits</li>
                <li>🛒 87 commandes passées</li>
                <li>⭐ 42 avis publiés</li>
                <li>❗ 3 avis signalés</li>
            `;
        }
    });
</script>

</body>
</html>
