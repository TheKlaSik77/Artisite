<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Validation produits</title>
    <link rel="stylesheet" href="admin-produits-validation.css">
</head>
<body>
<div class="admin-layout">
    <aside class="sidebar">
        <div class="sidebar-logo">
            <span>Artisite</span><small>Admin</small>
        </div>
        <nav class="sidebar-nav">
            <a href="admin-dashboard.html" class="nav-item">Dashboard</a>
            <a href="admin-artisans.html" class="nav-item">Artisans</a>
            <a href="admin-clients.html" class="nav-item">Clients</a>
            <a href="admin-produits.html" class="nav-item active">Produits</a>
            <a href="admin-commandes.html" class="nav-item">Commandes</a>
            <a href="admin-avis.html" class="nav-item">Avis</a>
            <a href="admin-support.html" class="nav-item">Support</a>
        </nav>
    </aside>

    <main class="main">
        <header class="main-header">
            <button id="toggleSidebar" class="btn-icon">☰</button>
            <div class="header-right">
                <span class="admin-name">Admin</span>
                <button class="btn-small-outline">Se déconnecter</button>
            </div>
        </header>

        <section class="main-content">
            <h1 class="page-title">Produits en attente de validation</h1>

            <div class="table-wrapper">
                <div class="table-header">
                    <h2>À valider</h2>
                </div>
                <table id="tableValidation">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Artisan</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lampe en bois flotté</td>
                            <td>Atelier des Bois</td>
                            <td>Décoration</td>
                            <td>89 €</td>
                            <td>
                                <button class="btn-table" onclick="valider(this)">Accepter</button>
                                <button class="btn-table-danger" onclick="refuser(this)">Refuser</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Service de 4 bols</td>
                            <td>Céramiques de Sophie</td>
                            <td>Poterie</td>
                            <td>120 €</td>
                            <td>
                                <button class="btn-table" onclick="valider(this)">Accepter</button>
                                <button class="btn-table-danger" onclick="refuser(this)">Refuser</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<script>
    document.getElementById("toggleSidebar").addEventListener("click", () => {
        document.querySelector(".sidebar").classList.toggle("sidebar-open");
    });

    function valider(btn) {
        if (!confirm("Accepter ce produit ?")) return;
        const row = btn.closest("tr");
        alert("Produit accepté (simulation).");
        row.remove();
        checkEmpty();
    }

    function refuser(btn) {
        if (!confirm("Refuser ce produit ?")) return;
        const row = btn.closest("tr");
        alert("Produit refusé (simulation).");
        row.remove();
        checkEmpty();
    }

    function checkEmpty() {
        const tbody = document.querySelector("#tableValidation tbody");
        if (!tbody.children.length) {
            tbody.innerHTML = `<tr><td colspan="5">Aucun produit en attente 🎉</td></tr>`;
        }
    }
</script>
</body>
</html>
