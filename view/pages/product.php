<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name'] ?? 'Produit') ?> - Artisite</title>

    <link rel="stylesheet" href="./assets/css/pages/product.css">

    <!-- Product page JS (gallery + reviews) -->
    <script src="./assets/js/products/image.js" defer></script>
</head>

<body>

    <main class="product-page">

        <!-- ================== FIL D’ARIANE ================== -->
        <div class="breadcrumb">
            <a href="index.php">Accueil</a> /
            <a href="index.php?page=products">Produits</a> /
            <span><?= htmlspecialchars($product['name'] ?? 'Produit') ?></span>
        </div>

        <?php
        // Build images array from GROUP_CONCAT result
        $images = [];

        if (!empty($product['image_links'])) {
            $images = explode('||', $product['image_links']);
            $images = array_values(array_filter($images, fn($v) => trim($v) !== ''));
        }

        // fallback if no image
        $mainImage = $images[0] ?? './assets/img/placeholder.png';
        ?>

        <!-- ================== BLOC PRODUIT ================== -->
        <section class="product-hero">

            <!-- Image -->
            <div class="product-gallery">

                <!-- Main image -->
                <div class="product-main-image">
                    <img
                        id="mainProductImage"
                        src="<?= htmlspecialchars($mainImage) ?>"
                        alt="<?= htmlspecialchars($product['name'] ?? 'Produit') ?>">
                </div>

                <!-- Thumbnails -->
                <?php if (!empty($images)): ?>
                    <div class="product-thumbs">
                        <?php foreach ($images as $index => $imgPath): ?>
                            <button
                                type="button"
                                class="thumb <?= $index === 0 ? 'thumb-active' : '' ?>"
                                data-img="<?= htmlspecialchars($imgPath) ?>"
                                aria-label="Voir image <?= $index + 1 ?>">
                                <img
                                    src="<?= htmlspecialchars($imgPath) ?>"
                                    alt="<?= htmlspecialchars($product['name'] ?? 'Produit') ?> - Vue <?= $index + 1 ?>">
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Infos produit -->
            <div class="product-info">

                <p class="product-category">
                    <?= htmlspecialchars($product['category_name'] ?? '') ?>
                </p>

                <h1 class="product-title">
                    <?= htmlspecialchars($product['name'] ?? '') ?>
                </h1>

                <p class="product-artisan">
                    <?= htmlspecialchars($product['company_name'] ?? '') ?>
                </p>

                <p class="product-price">
                    <?= isset($product['unit_price'])
                        ? number_format((float)$product['unit_price'], 2, ',', ' ')
                        : '' ?> €
                </p>

                <!-- ====== STOCK ====== -->
                <p class="product-stock">
                    Stock disponible :
                    <strong><?= (int) $product['quantity'] ?></strong>
                </p>

                <?php if ((int) $product['quantity'] === 0): ?>
                    <p class="product-out-of-stock">
                        Produit actuellement en rupture de stock
                    </p>
                <?php endif; ?>

                <div class="product-actions">

                    <form method="POST" action="index.php?page=cart&action=add">

                        <div class="quantity">
                            <label for="qty">Quantité</label>
                            <div class="quantity-input">
                                <input id="qty" name="quantity" type="number" min="1" value="1">
                            </div>
                        </div>

                        <input type="hidden" name="product_id" value="<?= (int)($product['product_id'] ?? 0) ?>">

                        <button type="submit" class="btn-primary">
                            Ajouter au panier
                        </button>
                    </form>
                </div>

                <div class="product-extra">
                    <p>🚚 Livraison estimée : 3 à 5 jours ouvrés</p>
                    <p>🔄 Retours possibles sous 14 jours (hors personnalisation).</p>
                </div>
            </div>
        </section>

        <!-- ================== DESCRIPTION DÉTAILLÉE ================== -->
        <section class="product-description">
            <div>
                <h2>Description détaillée</h2>
                <p>
                    <?= htmlspecialchars($product['description'] ?? '') ?>
                </p>
            </div>
        </section>
    </main>

</body>
</html>
