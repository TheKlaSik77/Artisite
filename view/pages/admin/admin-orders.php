<main class="content">
    <div class="deconnexion">
        <button class="btn-small" onclick="window.location.href='index.php?page=home'">Revenir à l'accueil</button>
        <button class="btn-small" onclick="window.location.href='index.php?page=logout'">Se déconnecter</button>
    </div>

    <div class="table-div">
        <div class="table-header">
            <h1>
                Liste des Commandes
            </h1>

            <select name="filter" id="statusFilter">
                <option value="">Tous les statuts</option>
                <option value="confirmed">Confirmée</option>
                <option value="shipped">Expédiée</option>
                <option value="delivered">Livrée</option>
                <option value="cancelled">Annulée</option>
            </select>

        </div>
        <table>
            <thead>
                <tr>
                    <th>N° Commande</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Gérer</th>
                </tr>
            </thead>
            <tbody id="table-content">

            </tbody>
        </table>

    </div>
</main>

<script>
    let orders = <?= json_encode($orders, JSON_UNESCAPED_UNICODE) ?>;
    document.addEventListener("DOMContentLoaded", () => {
        renderTable(orders);
    });

</script>

<script src="./assets/js/admin/admin_orders.js"></script>