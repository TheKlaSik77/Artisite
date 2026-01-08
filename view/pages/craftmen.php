<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Artisans</title>

    <link rel="stylesheet" href="./assets/css/pages/craftmen.css">
    <link rel="stylesheet" href="./assets/css/pages/products.css">
</head>

<body>
    <main>
        <section class="products-section">

            <h1 class="products-title">Nos Artisans</h1>
            <p class="products-subtitle">
                Découvrez le savoir-faire de nos artisans.
            </p>

            <!-- ================== FILTRES ================== -->
            <div class="filter-card">

                <div class="filter-header">
                    <div class="filter-icon">⭮</div>
                    <div>
                        <h2 class="filter-title">Rechercher et filtrer</h2>
                        <p class="filter-subtitle">Affinez par nom d'artisan ou catégorie.</p>
                    </div>
                </div>

                <!-- Recherche -->
                <div class="filter-row">
                    <div class="filter-input-wrapper">
                        <span class="filter-input-icon">🔍</span>
                        <input
                            type="text"
                            id="productSearch"
                            class="filter-input"
                            placeholder="Rechercher par nom d'artisan..." />
                    </div>
                </div>

                <!-- Catégories -->
                <div class="filter-row">
                    <p class="filter-label">Catégorie :</p>
                    <div class="chip-group" id="categoryChips">
                        <button class="chip chip-active" data-category="Tous">Tous</button>
                        <button class="chip" data-category="Céramique">Céramique</button>
                        <button class="chip" data-category="Bois">Bois</button>
                        <button class="chip" data-category="Textile">Textile</button>
                        <button class="chip" data-category="Métal">Métal</button>
                        <button class="chip" data-category="Cuir">Cuir</button>
                        <button class="chip" data-category="Autre">Autre</button>
                    </div>
                </div>
            </div>

            <!-- ================== LISTE ARTISANS ================== -->
            <div class="craftmen-grid">

                <?php if (empty($craftmen)): ?>
                    <p class="no-results">Aucun artisan trouvé.</p>
                <?php else: ?>
                    <?php foreach ($craftmen as $_craftman): ?>
                        <div class="craftman-card"
                             data-name="<?= strtolower($_craftman['company_name']) ?>"
                             data-category="<?= strtolower($_craftman['category_name']) ?>">

                            <div class="craftman-card-img-wrap">
                                <img src="https://picsum.photos/500/500" alt="Artisan">
                                <div class="img-gradient"></div>
                            </div>

                            <div class="craftman-card-content">
                                <h3><?= htmlspecialchars($_craftman['company_name']) ?></h3>
                                <p><?= htmlspecialchars($_craftman['category_name']) ?></p>

                                <a href="index.php?page=craftman&id=<?= $_craftman['craftman_id'] ?>"
                                   class="btn-discover">
                                    <span>Découvrir</span>
                                    <span class="icon-arrow-right">
                                        <svg width="18" height="18" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" viewBox="0 0 24 24">
                                            <line x1="5" y1="12" x2="19" y2="12" />
                                            <polyline points="12 5 19 12 12 19" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

        </section>
    </main>

    <!-- JS FILTRES ARTISANS -->
    <script src="./assets/js/signup/craftmen-filters.js"></script>
</body>

</html>
