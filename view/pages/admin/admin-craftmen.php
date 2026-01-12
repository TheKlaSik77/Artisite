<main class="content">
    <div class="deconnexion">
        <button class="btn-small">Revenir à l'accueil</button>
        <button class="btn-small">Se déconnecter</button>
    </div>

    <div class="table-div">
        <div class="table-header">
            <h1>
                Liste des Artisans inscrits
            </h1>
            <select id="statusFilter">
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
                    <th>Status</th>
                    <th>Gérer</th>
                </tr>
            </thead>
            <tbody id="craftmenBody">

            </tbody>
        </table>
        <script>
            // Récupérer les éléments
            const select = document.getElementById('statusFilter');

            // Écouter le changement de valeur
            select.addEventListener('change', function () {
                // Mettre à jour le contenu
                resultat.textContent = this.value || 'Aucune';
            });

        </script>
    </div>
</main>