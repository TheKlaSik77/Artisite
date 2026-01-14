<main class="content">
    <div class="deconnexion">
        <button class="btn-small" onclick="window.location.href='index.php?page=home'">Revenir à l'accueil</button>
        <button class="btn-small" onclick="window.location.href='index.php?page=logout'">Se déconnecter</button>
    </div>

    <div class="table-div">
        <div class="table-header">
            <h1>
                Liste des Utilisateurs inscrits
            </h1>

        </div>
        <table>
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Gérer</th>
                </tr>
            </thead>
            <tbody id="table-content">

            </tbody>
        </table>

    </div>
</main>

<script>
    let customers = <?= json_encode($customers, JSON_UNESCAPED_UNICODE) ?>;
    document.addEventListener("DOMContentLoaded", () => {
        renderTable(customers);
    });

</script>

<script src="./assets/js/admin/admin_customers.js"></script>