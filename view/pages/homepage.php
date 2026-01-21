<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accueil – Arti'Site</title>
    <link rel="stylesheet" href="./assets/css/pages/homepage.css" />
    <link rel="stylesheet" href="./assets/css/pages/products.css" />
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
                <div class="products-grid">

                    <?php if (!empty($latestCraftmen)): ?>
                        <?php foreach ($latestCraftmen as $craftman): ?>
                            <?php $artisanImg = $craftman['image_url']; ?>
                            <div class="product-card product-appear" data-id="<?= (int) $craftman['craftman_id'] ?>">
                                <img class="js-product-img" src="<?= htmlspecialchars($artisanImg) ?>"
                                    data-images='<?= htmlspecialchars(json_encode([$artisanImg], JSON_UNESCAPED_SLASHES)) ?>'
                                    style="width: 320px; height: 240px;"
                                    alt="<?= htmlspecialchars($craftman['company_name']) ?>">

                                <div class="product-info">
                                    <h3 class="product-name">
                                        <?= htmlspecialchars($craftman['company_name']) ?>
                                    </h3>

                                    <p class="product-artisan">Artisan</p>

                                    <a href="index.php?page=craftman&id=<?= (int) $craftman['craftman_id'] ?>"
                                        class="product-btn">
                                        Découvrir
                                    </a>
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

            <div class="products-grid">
                <?php if (empty($latestProducts)): ?>
                    <p class="no-results">Aucun produit disponible pour le moment.</p>
                <?php else: ?>
                    <?php foreach ($latestProducts as $product): ?>
                        <div class="product-card product-appear"
                            data-category="<?= htmlspecialchars($product['category_name'] ?? 'Autre') ?>"
                            data-price="<?= htmlspecialchars($product['unit_price'] ?? ($product['price'] ?? 0)) ?>"
                            data-id="<?= htmlspecialchars($product['product_id']) ?>">

                            <?php
                            $links = [];
                            if (!empty($product['image_links'])) {
                                $rawLinks = array_values(array_filter(explode('||', $product['image_links'])));
                                foreach ($rawLinks as $link) {
                                    $links[] = '/Artisite/' . ltrim($link, '/');
                                }
                            }
                            $first = $links[0] ?? 'https://picsum.photos/500/300';
                            ?>

                            <img class="js-product-img" src="<?= htmlspecialchars($first) ?>"
                                data-images='<?= htmlspecialchars(json_encode($links, JSON_UNESCAPED_SLASHES)) ?>'
                                style="width: 400px; height: 300px;" alt="<?= htmlspecialchars($product['name']) ?>">

                            <div class="product-info">
                                <h3 class="product-name">
                                    <?= htmlspecialchars($product['name']) ?>
                                </h3>

                                <p class="product-artisan">
                                    <?= htmlspecialchars($product['company_name'] ?? '') ?>
                                </p>

                                <p class="product-price">
                                    <?= number_format(($product['unit_price'] ?? ($product['price'] ?? 0)), 2, ',', ' ') ?> €
                                </p>

                                <a href="index.php?page=product&id=<?= (int) $product['product_id'] ?>" class="product-btn">
                                    Acheter
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="events-center">
                <a href="index.php?page=products" class="events-all-btn">Tous les produits</a>
            </div>
        </section>


    </main>

    <script src="./assets/js/products/image_cycle.js"></script>

</body>

</html>