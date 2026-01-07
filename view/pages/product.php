<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?> - Artisite</title>
    <link rel="stylesheet" href="./assets/css/pages/product.css">
</head>

<body>

<main class="product-page">

    <!-- ================== FIL D’ARIANE ================== -->
    <div class="breadcrumb">
        <a href="index.php">Accueil</a> /
        <a href="index.php?page=products">Produits</a> /
        <span><?= htmlspecialchars($product['name']) ?></span>
    </div>

    <!-- ================== PRODUIT ================== -->
    <section class="product-hero">

        <!-- Image -->
        <div class="product-gallery">
            <img src="https://picsum.photos/400/300" alt="<?= htmlspecialchars($product['name']) ?>">
        </div>

        <!-- Infos produit -->
        <div class="product-info">

            <p class="product-category">
                <?= htmlspecialchars($product['category_name']) ?>
            </p>

            <h1 class="product-title">
                <?= htmlspecialchars($product['name']) ?>
            </h1>

            <p class="product-artisan">
                <?= htmlspecialchars($product['company_name']) ?>
            </p>

            <p class="product-price">
                <?= number_format($product['unit_price'], 2, ',', ' ') ?> €
            </p>

            <!-- ====== STOCK ====== -->
            <p class="product-stock">
                Stock disponible :
                <strong><?= (int)$product['quantity'] ?></strong>
            </p>

            <?php if ((int)$product['quantity'] === 0): ?>
                <p class="product-out-of-stock">
                    Produit actuellement en rupture de stock
                </p>
            <?php endif; ?>

            <!-- ====== AJOUT AU PANIER ====== -->
            <form method="POST" action="index.php?page=cart&action=add">

                <input type="hidden" name="product_id"
                       value="<?= (int)$product['product_id'] ?>">

                <div class="quantity">
                    <label for="qty">Quantité</label>
                    <input
                        id="qty"
                        name="quantity"
                        type="number"
                        min="1"
                        max="<?= (int)$product['quantity'] ?>"
                        value="1"
                        <?= (int)$product['quantity'] === 0 ? 'disabled' : '' ?>
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="btn-primary"
                    <?= (int)$product['quantity'] === 0 ? 'disabled' : '' ?>
                >
                    Ajouter au panier
                </button>

            </form>

        </div>
    </section>

    <!-- ================== DESCRIPTION ================== -->
    <section class="product-description">
        <h2>Description</h2>
        <p>
            <?= nl2br(htmlspecialchars($product['description'])) ?>
        </p>
    </section>

</main>

</body>
</html>
