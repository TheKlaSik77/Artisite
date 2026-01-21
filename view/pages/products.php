<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Nos Produits – Marketplace Artisans</title>
    <link rel="stylesheet" href="./assets/css/pages/products.css">
</head>
<script src="./assets/js/products/image_cycle.js"></script>

<body>

    <main class="products-section">

        <h1 class="products-title">Nos Produits Artisanaux</h1>
        <p class="products-subtitle">
            Découvrez des pièces uniques créées par nos artisans.
        </p>

        <!-- ================== FILTRES ================== -->
        <div class="filter-card">

            <div class="filter-header">
                <div class="filter-icon">⭮</div>
                <div>
                    <h2 class="filter-title">Rechercher et filtrer</h2>
                    <p class="filter-subtitle">Affinez par produit, artisan, catégorie ou matière.</p>
                </div>
            </div>

            <!-- Recherche texte -->
            <div class="filter-row">
                <div class="filter-input-wrapper">
                    <span class="filter-input-icon">🔍</span>
                    <input type="text" name="search" class="filter-input"
                        placeholder="Rechercher par produit ou artisan..."
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" />
                </div>
            </div>

            <!-- Catégorie -->
            <div class="filter-row">
                <p class="filter-label">Catégorie :</p>
                <div class="chip-group" id="categoryChips">
                    <button type="button"
                        class="chip <?= ($_GET['category'] ?? 'Tous') === 'Tous' ? 'chip-active' : '' ?>"
                        data-value="Tous">
                        Tous
                    </button>
                    <?php foreach ($categories as $cat): ?>
                        <button type="button"
                            class="chip <?= ($_GET['category'] ?? 'Tous') === $cat['category_name'] ? 'chip-active' : '' ?>"
                            data-value="<?= htmlspecialchars($cat['category_name']) ?>">
                            <?= htmlspecialchars($cat['category_name']) ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Tri -->
            <div class="filter-row">
                <p class="filter-label">Trier par :</p>
                <div class="chip-group" id="sortChips">
                    <button type="button"
                        class="chip <?= ($_GET['sort'] ?? 'newest') === 'newest' ? 'chip-active' : '' ?>"
                        data-value="newest">
                        Ordre d'ajout
                    </button>
                    <button type="button"
                        class="chip <?= ($_GET['sort'] ?? 'newest') === 'price_asc' ? 'chip-active' : '' ?>"
                        data-value="price_asc">
                        Prix croissant
                    </button>
                    <button type="button"
                        class="chip <?= ($_GET['sort'] ?? 'newest') === 'price_desc' ? 'chip-active' : '' ?>"
                        data-value="price_desc">
                        Prix décroissant
                    </button>
                </div>
            </div>

        </div>

        <!-- ================== RÉSULTATS ================== -->
        <?php if (empty($products)): ?>

            <p class="no-results">
                Aucun produit ne correspond à vos filtres.
            </p>

        <?php else: ?>

            <div class="products-grid">

                <?php foreach ($products as $product): ?>
                    <div class="product-card product-appear"
                        data-category="<?= htmlspecialchars($product['category_name'] ?? 'Autre') ?>"
                        data-price="<?= htmlspecialchars($product['unit_price']) ?>"
                        data-id="<?= htmlspecialchars($product['product_id']) ?>">

                        <?php
                        $links = [];
                        if (!empty($product['image_links'])) {
                            $rawLinks = array_values(array_filter(explode('||', $product['image_links'])));
                            foreach ($rawLinks as $link) {
                                // Use relative path from index.php
                                $links[] = './' . ltrim($link, '/');
                            }
                        }
                        $first = $links[0] ?? './assets/img/placeholder.png';
                        ?>

                        <img class="js-product-img" src="<?= htmlspecialchars($first) ?>"
                            data-images='<?= htmlspecialchars(json_encode($links, JSON_UNESCAPED_SLASHES)) ?>'
                            style="width: 400px; height: 300px;" alt="<?= htmlspecialchars($product['name']) ?>">

                        <div class="product-info">
                            <h3 class="product-name">
                                <?= htmlspecialchars($product['name']) ?>
                            </h3>

                            <p class="product-artisan">
                                <?= htmlspecialchars($product['company_name']) ?>
                            </p>

                            <p class="product-price">
                                <?= number_format($product['unit_price'], 2, ',', ' ') ?> €
                            </p>

                            <a href="index.php?page=product&id=<?= $product['product_id'] ?>" class="product-btn">
                                Acheter
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </main>

    <script src="./assets/js/products/products.js"></script>

</body>

</html>