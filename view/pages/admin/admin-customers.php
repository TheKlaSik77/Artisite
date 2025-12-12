<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Clients</title>
    <link rel="stylesheet" href="./assets/css/pages/admin/admin-customers.css">
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
            <h1 class="page-title">Clients</h1>

            <div class="table-wrapper">
                <div class="table-header">
                    <h2>Liste des clients</h2>
                    <div style="display:flex; gap:8px;">
                        <input type="text" id="searchClient" placeholder="Rechercher...">
                        <select id="filterClientStatut">
                            <option value="all">Tous les statuts</option>
                            <option value="actif">Actif</option>
                            <option value="bloque">Bloqué</option>
                        </select>
                    </div>
                </div>
                <table id="tableClients">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Commandes</th>
                            <th>Statut</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-statut="actif">
                            <td>Camille Dupont</td>
                            <td>camille@example.com</td>
                            <td>5</td>
                            <td><span class="badge badge-success">Actif</span></td>
                            <td>
                                <button class="btn-table" onclick="openClient(1)">Détails</button>
                                <button class="btn-table-danger" onclick="blockClient(this)">Bloquer</button>
                            </td>
                        </tr>
                        <tr data-statut="actif">
                            <td>Julien Martin</td>
                            <td>julien@example.com</td>
                            <td>2</td>
                            <td><span class="badge badge-success">Actif</span></td>
                            <td>
                                <button class="btn-table" onclick="openClient(2)">Détails</button>
                                <button class="btn-table-danger" onclick="blockClient(this)">Bloquer</button>
                            </td>
                        </tr>
                        <tr data-statut="bloque">
                            <td>Anna Rossi</td>
                            <td>anna@example.com</td>
                            <td>1</td>
                            <td><span class="badge badge-danger">Bloqué</span></td>
                            <td>
                                <button class="btn-table" onclick="openClient(3)">Détails</button>
                                <button class="btn-table" onclick="unblockClient(this)">Débloquer</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<script>
    // Toggle sidebar
    document.getElementById("toggleSidebar").addEventListener("click", () => {
        document.querySelector(".sidebar").classList.toggle("sidebar-open");
    });

    const searchClient = document.getElementById("searchClient");
    const filterClientStatut = document.getElementById("filterClientStatut");
    const clientRows = document.querySelectorAll("#tableClients tbody tr");

    function applyClientFilters() {
        const q = searchClient.value.toLowerCase();
        const statut = filterClientStatut.value;

        clientRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const rowStatut = row.dataset.statut;
            const matchText = text.includes(q);
            const matchStatut = (statut === "all" || statut === rowStatut);
            row.style.display = (matchText && matchStatut) ? "" : "none";
        });
    }

    searchClient.addEventListener("input", applyClientFilters);
    filterClientStatut.addEventListener("change", applyClientFilters);

    function openClient(id) {
        window.location.href = `admin-client-detail.html?id=${id}`;
    }

    function blockClient(btn) {
        if (!confirm("Bloquer ce client ?")) return;
        const row = btn.closest("tr");
        row.dataset.statut = "bloque";
        row.querySelector(".badge").className = "badge badge-danger";
        row.querySelector(".badge").textContent = "Bloqué";
        btn.textContent = "Débloquer";
        btn.classList.remove("btn-table-danger");
        btn.onclick = () => unblockClient(btn);
        applyClientFilters();
    }

    function unblockClient(btn) {
        if (!confirm("Débloquer ce client ?")) return;
        const row = btn.closest("tr");
        row.dataset.statut = "actif";
        row.querySelector(".badge").className = "badge badge-success";
        row.querySelector(".badge").textContent = "Actif";
        btn.textContent = "Bloquer";
        btn.classList.add("btn-table-danger");
        btn.onclick = () => blockClient(btn);
        applyClientFilters();
    }
</script>
</body>
</html>
