<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin – Détail commande</title>
    <link rel="stylesheet" href="admin-commande-detail.css">
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
            <button class="btn-small-outline" onclick="history.back()">← Retour</button>
            <h1 class="page-title" id="commandeTitle">Commande #1024</h1>

            <div class="cards-row">
                <article class="card">
                    <p class="card-label">Client</p>
                    <p class="card-value">Camille Dupont</p>
                </article>
                <article class="card">
                    <p class="card-label">Montant</p>
                    <p class="card-value">79 €</p>
                </article>
                <article class="card">
                    <p class="card-label">Date</p>
                    <p class="card-value">12/11/2025</p>
                </article>
            </div>

            <section class="panel" style="margin-top:16px;">
                <div class="panel-header">
                    <h2>Détails commande</h2>
                    <select id="commandeStatus">
                        <option value="en_cours">En cours</option>
                        <option value="expediee">Expédiée</option>
                        <option value="livree">Livrée</option>
                        <option value="remboursee">Remboursée</option>
                    </select>
                </div>
                <div class="panel-body">
                    <p><strong>Adresse de livraison :</strong></p>
                    <p>10 Rue des Fleurs, 75000 Paris, France</p>
                    <p style="margin-top:8px;"><strong>Méthode de paiement :</strong> Carte bancaire</p>
                </div>
            </section>

            <div class="table-wrapper" style="margin-top:20px;">
                <div class="table-header">
                    <h2>Articles</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Artisan</th>
                            <th>Qté</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bol en céramique</td>
                            <td>Sophie Martin</td>
                            <td>1</td>
                            <td>29 €</td>
                            <td>29 €</td>
                        </tr>
                        <tr>
                            <td>Planche en bois massif</td>
                            <td>Atelier des Bois</td>
                            <td>1</td>
                            <td>50 €</td>
                            <td>50 €</td>
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

    const commandeStatus = document.getElementById("commandeStatus");
    commandeStatus.addEventListener("change", () => {
        alert("Statut de la commande mis à jour (simulation) : " + commandeStatus.value);
    });

    const params = new URLSearchParams(window.location.search);
    const commandeId = params.get("id");
    console.log("Commande ID:", commandeId);
</script>
</body>
</html>
