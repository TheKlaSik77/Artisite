<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Commandes</title>
    <link rel="stylesheet" href="admin-commandes.css">
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
            <a href="admin-produits.html" class="nav-item">Produits</a>
            <a href="admin-commandes.html" class="nav-item active">Commandes</a>
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
            <h1 class="page-title">Commandes</h1>

            <div class="table-wrapper">
                <div class="table-header">
                    <h2>Liste des commandes</h2>
                    <div style="display:flex; gap:8px;">
                        <input type="text" id="searchCommande" placeholder="Rechercher...">
                        <select id="filterCommandeStatut">
                            <option value="all">Tous les statuts</option>
                            <option value="en_cours">En cours</option>
                            <option value="expediee">Expédiée</option>
                            <option value="livree">Livrée</option>
                            <option value="remboursee">Remboursée</option>
                        </select>
                    </div>
                </div>
                <table id="tableCommandes">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Statut</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-statut="en_cours">
                            <td>1024</td>
                            <td>Camille Dupont</td>
                            <td>12/11/2025</td>
                            <td>79 €</td>
                            <td><span class="badge badge-warning">En cours</span></td>
                            <td><button class="btn-table" onclick="openCommande(1024)">Détails</button></td>
                        </tr>
                        <tr data-statut="livree">
                            <td>987</td>
                            <td>Julien Martin</td>
                            <td>02/11/2025</td>
                            <td>45 €</td>
                            <td><span class="badge badge-success">Livrée</span></td>
                            <td><button class="btn-table" onclick="openCommande(987)">Détails</button></td>
                        </tr>
                        <tr data-statut="remboursee">
                            <td>950</td>
                            <td>Anna Rossi</td>
                            <td>28/10/2025</td>
                            <td>39 €</td>
                            <td><span class="badge badge-danger">Remboursée</span></td>
                            <td><button class="btn-table" onclick="openCommande(950)">Détails</button></td>
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

    const searchCommande = document.getElementById("searchCommande");
    const filterCommandeStatut = document.getElementById("filterCommandeStatut");
    const commandeRows = document.querySelectorAll("#tableCommandes tbody tr");

    function applyCommandeFilters() {
        const q = searchCommande.value.toLowerCase();
        const statut = filterCommandeStatut.value;

        commandeRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const rowStatut = row.dataset.statut;
            const matchText = text.includes(q);
            const matchStatut = (statut === "all" || statut === rowStatut);
            row.style.display = (matchText && matchStatut) ? "" : "none";
        });
    }

    searchCommande.addEventListener("input", applyCommandeFilters);
    filterCommandeStatut.addEventListener("change", applyCommandeFilters);

    function openCommande(id) {
        window.location.href = `admin-commande-detail.html?id=${id}`;
    }
</script>
</body>
</html>
