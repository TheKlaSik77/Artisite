<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Artisans</title>
    <link rel="stylesheet" href="./assets/css/pages/admin/admin-craftmen.css">
</head>
<body>
<div class="admin-layout">

    <main class="main">
        <header class="main-header">
            <button id="toggleSidebar" class="btn-icon">☰</button>
            <div class="header-right">
                <span class="admin-name">Admin</span>
                <button class="btn-small-outline">Se déconnecter</button>
            </div>
        </header>

        <section class="main-content">
            <h1 class="page-title">Artisans</h1>

            <div class="table-wrapper">
                <div class="table-header">
                    <h2>Liste des artisans</h2>
                    <div style="display:flex; gap:8px;">
                        <input type="text" id="searchArtisan" placeholder="Rechercher...">
                        <select id="filterStatut">
                            <option value="all">Tous les statuts</option>
                            <option value="valide">Validé</option>
                            <option value="attente">En attente</option>
                            <option value="bloque">Bloqué</option>
                        </select>
                    </div>
                </div>
                <table id="tableArtisans">
                    <thead>
                        <tr>
                            <th>Boutique</th>
                            <th>Artisan</th>
                            <th>Email</th>
                            <th>Produits</th>
                            <th>Statut</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-statut="valide">
                            <td>Atelier des Bois</td>
                            <td>Thomas Dubois</td>
                            <td>thomas@example.com</td>
                            <td>12</td>
                            <td><span class="badge badge-success">Validé</span></td>
                            <td>
                                <button class="btn-table" onclick="openArtisan(1)">Détails</button>
                                <button class="btn-table-danger" onclick="toggleBlock(this)">Bloquer</button>
                            </td>
                        </tr>
                        <tr data-statut="attente">
                            <td>Céramiques de Sophie</td>
                            <td>Sophie Martin</td>
                            <td>sophie@example.com</td>
                            <td>8</td>
                            <td><span class="badge badge-warning">En attente</span></td>
                            <td>
                                <button class="btn-table" onclick="openArtisan(2)">Détails</button>
                                <button class="btn-table" onclick="validerArtisan(this)">Valider</button>
                            </td>
                        </tr>
                        <tr data-statut="bloque">
                            <td>Atelier Métal</td>
                            <td>Lucas Morel</td>
                            <td>lucas@example.com</td>
                            <td>5</td>
                            <td><span class="badge badge-danger">Bloqué</span></td>
                            <td>
                                <button class="btn-table" onclick="openArtisan(3)">Détails</button>
                                <button class="btn-table" onclick="debloquerArtisan(this)">Débloquer</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<script>
    // Sidebar toggle
    document.getElementById("toggleSidebar").addEventListener("click", () => {
        document.querySelector(".sidebar").classList.toggle("sidebar-open");
    });

    const searchInput = document.getElementById("searchArtisan");
    const filterStatut = document.getElementById("filterStatut");
    const rows = document.querySelectorAll("#tableArtisans tbody tr");

    function applyFilters() {
        const q = searchInput.value.toLowerCase();
        const statut = filterStatut.value;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const rowStatut = row.dataset.statut;
            const matchText = text.includes(q);
            const matchStatut = (statut === "all" || statut === rowStatut);

            row.style.display = (matchText && matchStatut) ? "" : "none";
        });
    }

    searchInput.addEventListener("input", applyFilters);
    filterStatut.addEventListener("change", applyFilters);

    function openArtisan(id) {
        window.location.href = `admin-artisan-detail.html?id=${id}`;
    }

    function toggleBlock(btn) {
        alert("Artisan bloqué (simulation).");
        btn.textContent = "Débloquer";
        btn.classList.remove("btn-table-danger");
    }

    function validerArtisan(btn) {
        alert("Artisan validé (simulation).");
        btn.closest("tr").dataset.statut = "valide";
        applyFilters();
    }

    function debloquerArtisan(btn) {
        alert("Artisan débloqué (simulation).");
        btn.closest("tr").dataset.statut = "valide";
        applyFilters();
    }
</script>

</body>
</html>
