<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accueil – Arti'Site</title>
    <link rel="stylesheet" href="./assets/css/pages/homepage.css" />
</head>

<body>
    <main>
        <section class="search">
            <div class="search-overlay"></div>

            <div class="search-inner">
                <h1>Découvrez et soutenez le savoir-faire artisanal français</h1>

                <form class="search-search-bar" method="GET" action="index.php">
                    <input type="text" name="search" placeholder="Recherchez un produit…" required />

                    <input type="hidden" name="page" value="products">

                    <div class="search-actions">
                        <button type="submit" class="btn-primary">
                            Rechercher
                        </button>
                    </div>
                </form>

            </div>
        </section>

        <section class="artisans">
            <p class="section-subtitle">NOTRE SÉLECTION</p>
            <h1 class="section-title">Nos Artisans</h1>
            <p class="section-desc">
                Découvrez les créateurs talentueux qui perpétuent des savoir-faire
                d'excellence et créent des pièces uniques avec passion.
            </p>

            <div class="container">
                <div class="artisans-grid">

                    <?php if (!empty($latestCraftmen)): ?>
                        <?php foreach ($latestCraftmen as $craftman): ?>
                            <div class="artisan-card">
                                <img src="<?= htmlspecialchars($craftman['image_url']) ?>" class="event-img"
                                    alt="<?= htmlspecialchars($craftman['company_name']) ?>">
                                <div class="artisan-content">
                                    <h3 class="artisan-name"><?= htmlspecialchars($craftman['company_name']) ?></h3>
                                    <p class="artisan-job">Artisan</p>
                                    <a href="index.php?page=craftman&id=<?= (int) $craftman['craftman_id'] ?>"
                                        class="artisan-btn">Découvrir →</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun artisan pour le moment.</p>
                    <?php endif; ?>

                </div>

                <div class="artisans-center">
                    <a href="index.php?page=craftmen" class="artisans-all-btn">Voir tous les artisans</a>
                </div>
            </div>
        </section>

        <section class="events">
            <p class="section-subtitle">NOUVEAUTÉS</p>
            <h1 class="section-title">Derniers produits ajoutés</h1>
            <p class="section-desc">
                Découvrez les créations les plus récentes de nos artisans et restez
                à jour avec les nouvelles pièces uniques ajoutées à notre collection.
            </p>

            <div class="events-grid">
                <div class="event-card">
                    <img src="assets/img/poterie.jpg" class="event-img">
                    <div class="event-content">
                        <h3 class="event-name">Atelier poterie traditionnelle</h3>
                        <div class="event-info">
                            <p>📅 15 novembre 2025</p>
                            <p>📍 Paris 11ème</p>
                        </div>
                        <a href="#" class="event-btn">Participer →</a>
                    </div>
                </div>

                <div class="event-card">
                    <img src="assets/img/poterie.jpg" class="event-img">
                    <div class="event-content">
                        <h3 class="event-name">Salon des Métiers d’Art</h3>
                        <div class="event-info">
                            <p>📅 22 novembre 2025</p>
                            <p>📍 Lyon</p>
                        </div>
                        <a href="#" class="event-btn">Participer →</a>
                    </div>
                </div>

                <div class="event-card">
                    <img src="assets/img/poterie.jpg" class="event-img">
                    <div class="event-content">
                        <h3 class="event-name">Exposition de maroquinerie artisanale</h3>
                        <div class="event-info">
                            <p>📅 5 décembre 2025</p>
                            <p>📍 Bordeaux</p>
                        </div>
                        <a href="#" class="event-btn">Participer →</a>
                    </div>
                </div>

            </div>

            <div class="events-center">
                <a href="#" class="events-all-btn">Tous les événements</a>
            </div>
        </section>


    </main>

</body>

</html>
