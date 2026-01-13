<main class="content">
    <div class="deconnexion">
        <button class="btn-small" onclick="window.location.href='index.php?page=home'">Revenir à l'accueil</button>
        <button class="btn-small" onclick="window.location.href='index.php?page=logout'">Se déconnecter</button>
    </div>

    <div class="table-div">
        <div class="table-header">
            <h1>
                Liste des Artisans inscrits
            </h1>

            <select name="filter" id="statusFilter">
                <option value="">Tous les statuts</option>
                <option value="validated">Actif</option>
                <option value="pending">En attente de validation</option>
            </select>

        </div>
        <table>
            <thead>
                <tr>
                    <th>Artisan</th>
                    <th>Email</th>
                    <th>Validateur</th>
                    <th>Gérer</th>
                </tr>
            </thead>
            <tbody id="table-content">

            </tbody>
        </table>

    </div>
</main>
<script>
    let craftmen = <?= json_encode($craftmen, JSON_UNESCAPED_UNICODE) ?>;;
</script>

<script src="./assets/js/admin/admin_craftmen.js"></script>