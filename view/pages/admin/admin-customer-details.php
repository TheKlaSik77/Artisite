<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Détail client</title>
    <link rel="stylesheet" href="./assets/css/pages/admin/admin-client-detail.css">
</head>
<body>
<div class="admin-layout">
    <aside class="sidebar">
        <div class="sidebar-logo">
            <span>Artisite</span><small>Admin</small>
        </div>
        <nav class="sidebar-nav">
            <a href="admin-dashboard.html" class="nav-item">Dashboard</a>
            <a href="admin-craftmen.html" class="nav-item">Artisans</a>
            <a href="admin-customers.html" class="nav-item active">Clients</a>
            <a href="admin-products.html" class="nav-item">Produits</a>
            <a href="admin-orders.html" class="nav-item">Commandes</a>
            <a href="admin-reviews.html" class="nav-item">Avis</a>
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
            <button class="btn-small-outline" onclick="history.back()">← Retour</button>
            <h1 class="page-title" id="clientTitle">Camille Dupont</h1>

            <div class="cards-row">
                <article class="card">
                    <p class="card-label">Commandes</p>
                    <p class="card-value">5</p>
                </article>
                <article class="card">
                    <p class="card-label">Montant total</p>
                    <p class="card-value">320 €</p>
                </article>
                <article class="card">
                    <p class="card-label">Avis laissés</p>
                    <p class="card-value">3</p>
                </article>
            </div>

            <section class="panel" style="margin-top:16px;">
                <div class="panel-header">
                    <h2>Informations client</h2>
                    <select id="clientStatus">
                        <option value="actif">Actif</option>
                        <option value="bloque">Bloqué</option>
                    </select>
                </div>
                <div class="panel-body">
                    <p><strong>Nom :</strong> Camille Dupont</p>
                    <p><strong>Email :</strong> camille@example.com</p>
                    <p><strong>Inscription :</strong> 04/10/2025</p>
                </div>
            </section>

            <div class="table-wrapper" style="margin-top:20px;">
                <div class="table-header">
                    <h2>Dernières commandes</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1024</td>
                            <td>12/11/2025</td>
                            <td>79 €</td>
                            <td><span class="badge badge-success">Livrée</span></td>
                        </tr>
                        <tr>
                            <td>987</td>
                            <td>02/11/2025</td>
                            <td>45 €</td>
                            <td><span class="badge badge-success">Livrée</span></td>
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

    const clientStatus = document.getElementById("clientStatus");
    clientStatus.addEventListener("change", () => {
        alert("Statut client mis à jour (simulation) : " + clientStatus.value);
    });

    const params = new URLSearchParams(window.location.search);
    const clientId = params.get("id");
    console.log("Client ID:", clientId);
</script>
</body>
</html>
