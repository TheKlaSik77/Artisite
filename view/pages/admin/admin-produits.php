<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Produits</title>
    <link rel="stylesheet" href="admin-produits.css">
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
            <h1 class="page-title">Produits</h1>

            <div class="table-wrapper">
                <div class="table-header">
                    <h2>Tous les produits</h2>
                    <div style="display:flex; gap:8px;">
                        <input type="text" id="searchProduit" placeholder="Rechercher...">
                        <select id="filterProduitStatut">
                            <option value="all">Tous les statuts</option>
                            <option value="en_ligne">En ligne</option>
                            <option value="brouillon">Brouillon</option>
                            <option value="attente">En attente</option>
                        </select>
                    </div>
                </div>
                <table id="tableProduits">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Artisan</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Statut</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-statut="en_ligne">
                            <td>Bol en céramique</td>
                            <td>Sophie Martin</td>
                            <td>Poterie</td>
                            <td>29 €</td>
                            <td><span class="badge badge-success">En ligne</span></td>
                            <td>
                                <button class="btn-table" onclick="openProduit(1)">Détails</button>
                            </td>
                        </tr>
                        <tr data-statut="attente">
                            <td>Lampe en bois flotté</td>
                            <td>Atelier des Bois</td>
                            <td>Décoration</td>
                            <td>89 €</td>
                            <td><span class="badge badge-warning">En attente</span></td>
                            <td>
                                <button class="btn-table" onclick="openProduit(2)">Détails</button>
                            </td>
                        </tr>
                        <tr data-statut="brouillon">
                            <td>Tapis tissé main</td>
                            <td>Textile & Co</td>
                            <td>Décoration</td>
                            <td>120 €</td>
                            <td><span class="badge">Brouillon</span></td>
                            <td>
                                <button class="btn-table" onclick="openProduit(3)">Détails</button>
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

    const searchProduit = document.getElementById("searchProduit");
    const filterProduitStatut = document.getElementById("filterProduitStatut");
    const produitRows = document.querySelectorAll("#tableProduits tbody tr");

    function applyProduitFilters() {
        const q = searchProduit.value.toLowerCase();
        const statut = filterProduitStatut.value;

        produitRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const rowStatut = row.dataset.statut;
            const matchText = text.includes(q);
            const matchStatut = (statut === "all" || statut === rowStatut);
            row.style.display = (matchText && matchStatut) ? "" : "none";
        });
    }

    searchProduit.addEventListener("input", applyProduitFilters);
    filterProduitStatut.addEventListener("change", applyProduitFilters);

    function openProduit(id) {
        window.location.href = `admin-produit-detail.html?id=${id}`;
    }
</script>
</body>
</html>
