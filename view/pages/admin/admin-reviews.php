<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Avis</title>
    <link rel="stylesheet" href="./assets/css/pages/admin/admin-reviews.css">
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
            <h1 class="page-title">Avis</h1>

            <div class="table-wrapper">
                <div class="table-header">
                    <h2>Avis clients</h2>
                    <div style="display:flex; gap:8px;">
                        <input type="text" id="searchAvis" placeholder="Rechercher...">
                        <select id="filterAvisStatut">
                            <option value="all">Tous les statuts</option>
                            <option value="visible">Visible</option>
                            <option value="masque">Masqué</option>
                            <option value="signale">Signalé</option>
                        </select>
                    </div>
                </div>
                <table id="tableAvis">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Client</th>
                            <th>Note</th>
                            <th>Aperçu</th>
                            <th>Statut</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-statut="visible">
                            <td>Bol en céramique</td>
                            <td>Camille</td>
                            <td>5/5</td>
                            <td>Très joli bol, conforme aux photos...</td>
                            <td><span class="badge badge-success">Visible</span></td>
                            <td>
                                <button class="btn-table" onclick="masquerAvis(this)">Masquer</button>
                            </td>
                        </tr>
                        <tr data-statut="signale">
                            <td>Planche en bois massif</td>
                            <td>Marc</td>
                            <td>1/5</td>
                            <td>Avis signalé par plusieurs utilisateurs...</td>
                            <td><span class="badge badge-warning">Signalé</span></td>
                            <td>
                                <button class="btn-table-danger" onclick="supprimerAvis(this)">Supprimer</button>
                                <button class="btn-table" onclick="rendreVisible(this)">Rendre visible</button>
                            </td>
                        </tr>
                        <tr data-statut="masque">
                            <td>Vase en grès</td>
                            <td>Sarah</td>
                            <td>3/5</td>
                            <td>Avis masqué pour vérifier le contenu...</td>
                            <td><span class="badge badge-danger">Masqué</span></td>
                            <td>
                                <button class="btn-table" onclick="rendreVisible(this)">Rendre visible</button>
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

    const searchAvis = document.getElementById("searchAvis");
    const filterAvisStatut = document.getElementById("filterAvisStatut");
    const avisRows = document.querySelectorAll("#tableAvis tbody tr");

    function applyAvisFilters() {
        const q = searchAvis.value.toLowerCase();
        const statut = filterAvisStatut.value;

        avisRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const rowStatut = row.dataset.statut;
            const matchText = text.includes(q);
            const matchStatut = (statut === "all" || statut === rowStatut);
            row.style.display = (matchText && matchStatut) ? "" : "none";
        });
    }

    searchAvis.addEventListener("input", applyAvisFilters);
    filterAvisStatut.addEventListener("change", applyAvisFilters);

    function masquerAvis(btn) {
        if (!confirm("Masquer cet avis ?")) return;
        const row = btn.closest("tr");
        row.dataset.statut = "masque";
        const badge = row.querySelector(".badge");
        badge.className = "badge badge-danger";
        badge.textContent = "Masqué";
        btn.remove(); // on enlève le bouton "Masquer"
        applyAvisFilters();
    }

    function rendreVisible(btn) {
        if (!confirm("Rendre cet avis visible ?")) return;
        const row = btn.closest("tr");
        row.dataset.statut = "visible";
        const badge = row.querySelector(".badge");
        badge.className = "badge badge-success";
        badge.textContent = "Visible";
        applyAvisFilters();
    }

    function supprimerAvis(btn) {
        if (!confirm("Supprimer définitivement cet avis ?")) return;
        const row = btn.closest("tr");
        row.remove();
        applyAvisFilters();
    }
</script>
</body>
</html>
