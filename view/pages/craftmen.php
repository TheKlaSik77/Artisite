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
                        <h2 class="filter-title">Rechercher</h2>
                        <p class="filter-subtitle">Trouvez un artisan par son nom.</p>
                    </div>
                </div>

                <!-- Recherche -->
                <div class="filter-row">
                    <div class="filter-input-wrapper">
                        <span class="filter-input-icon">🔍</span>
                        <input type="text" id="productSearch" class="filter-input"
                            placeholder="Rechercher par nom d'artisan..." />
                    </div>
                </div>
            </div>

            <!-- ================== LISTE ARTISANS ================== -->
            <div class="craftmen-grid products-grid">

                <?php if (empty($craftmen)): ?>
                    <p class="no-results">Aucun artisan trouvé.</p>
                <?php else: ?>
                    <?php foreach ($craftmen as $_craftman): ?>
                        <?php
                        $img = !empty($_craftman['profile_image_url'])
                            ? $_craftman['profile_image_url']
                            : './assets/img/artisan.jpg';
                        ?>
                        <div class="craftman-card product-card product-appear"
                            data-name="<?= strtolower($_craftman['company_name']) ?>" data-category="tous"
                            data-id="<?= (int) $_craftman['craftman_id'] ?>">

                            <img class="js-product-img" src="<?= htmlspecialchars($img) ?>"
                                data-images='<?= htmlspecialchars(json_encode([$img], JSON_UNESCAPED_SLASHES)) ?>'
                                style="width: 400px; height: 300px;" alt="<?= htmlspecialchars($_craftman['company_name']) ?>">

                            <div class="product-info">
                                <h3 class="product-name">
                                    <?= htmlspecialchars($_craftman['company_name']) ?>
                                </h3>

                                <p class="product-artisan">Artisan</p>

                                <a href="index.php?page=craftman&id=<?= (int) $_craftman['craftman_id'] ?>" class="product-btn">
                                    Découvrir
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

        </section>
    </main>

    <script src="./assets/js/products/image_cycle.js"></script>
    <!-- JS FILTRES ARTISANS -->
    <script src="./assets/js/signup/craftmen-filters.js"></script>
</body>

</html>