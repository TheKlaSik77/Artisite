<main class="content">
    <div class="deconnexion">
        <button class="btn-small" onclick="window.location.href='index.php?page=home'">Revenir à l'accueil</button>
        <button class="btn-small" onclick="window.location.href='index.php?page=logout'">Se déconnecter</button>
    </div>

    <div class="table-div">
        <div class="table-header">
            <h1>
                Liste des Produits
            </h1>

            <input type="text" id="searchInput" placeholder="Rechercher un produit...">

        </div>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Artisan</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Gérer</th>
                </tr>
            </thead>
            <tbody id="table-content">

            </tbody>
        </table>

    </div>
</main>

<script>
    let products = <?= json_encode($products, JSON_UNESCAPED_UNICODE) ?>;
    document.addEventListener("DOMContentLoaded", () => {
        renderTable(products);
    });

</script>

<script src="./assets/js/admin/admin_products.js"></script>