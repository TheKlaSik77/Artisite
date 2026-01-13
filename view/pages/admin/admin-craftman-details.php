<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Admin – Détail Artisan</title>
    <link rel="stylesheet" href="../../assets/css/pages/admin/admin-craftman-details.css">
</head>

<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-logo">
                <span>Artisite</span><small>Admin</small>
            </div>
            <nav class="sidebar-nav">
                <a href="index.php?page=admin-dashboard" class="nav-item">Dashboard</a>
                <a href="index.php?page=admin-craftmen" class="nav-item active">Artisans</a>
                <a href="index.php?page=admin-customers" class="nav-item">Clients</a>
                <a href="index.php?page=admin-products" class="nav-item">Produits</a>
                <a href="index.php?page=admin-orders" class="nav-item">Commandes</a>
                <a href="index.php?page=admin-reviews" class="nav-item">Avis</a>
                <a href="index.php?page=admin-support" class="nav-item">Support</a>
            </nav>
        </aside>

        <main class="main">
            <header class="main-header">
                <button id="toggleSidebar" class="btn-icon">☰</button>
                <div class="header-right">
                    <span class="admin-name">Admin</span>
                    <button class="btn-small">Se déconnecter</button>
                </div>
            </header>

            <section class="main-content">
                <button class="btn-small" onclick="history.back()">← Retour</button>
                <h1 class="page-title" id="artisanNameTitle">Atelier des Bois – Thomas Dubois</h1>

                <div class="cards-row">
                    <article class="card">
                        <p class="card-label">Produits</p>
                        <p class="card-value">12</p>
                    </article>
                    <article class="card">
                        <p class="card-label">Note moyenne</p>
                        <p class="card-value">4.6</p>
                    </article>
                    <article class="card">
                        <p class="card-label">Commandes</p>
                        <p class="card-value">54</p>
                    </article>
                </div>

                <section class="panel">
                    <div class="panel-header">
                        <h2>Informations artisan</h2>
                        <select id="statutSelect">
                            <option value="valide">Validé</option>
                            <option value="attente">En attente</option>
                            <option value="bloque">Bloqué</option>
                        </select>
                    </div>
                    <div class="panel-body">
                        <p><strong>Boutique :</strong> Atelier des Bois</p>
                        <p><strong>Nom complet :</strong> Thomas Dubois</p>
                        <p><strong>Email :</strong> thomas@example.com</p>
                        <p><strong>Date d’inscription :</strong> 12/10/2025</p>
                    </div>
                </section>

                <div class="table-wrapper" style="margin-top:20px;">
                    <div class="table-header">
                        <h2>Produits de l’artisan</h2>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Planche en bois massif</td>
                                <td>Décoration</td>
                                <td>45€</td>
                                <td><span class="badge badge-success">En ligne</span></td>
                            </tr>
                            <tr>
                                <td>Tablette murale</td>
                                <td>Décoration</td>
                                <td>79€</td>
                                <td><span class="badge badge-success">En ligne</span></td>
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

        const statutSelect = document.getElementById("statutSelect");
        statutSelect.addEventListener("change", () => {
            alert("Changement de statut sauvegardé (simulation) : " + statutSelect.value);
        });

        // Récupération de l’ID dans l’URL pour plus tard (backend)
        const params = new URLSearchParams(window.location.search);
        const artisanId = params.get("id");
        console.log("Artisan ID:", artisanId);
    </script>
</body>

</html>