<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Nos Produits – Marketplace Artisans</title>
    <link rel="stylesheet" href="./assets/css/pages/products.css">
</head>

<body>

<main class="products-section">

    <h1 class="products-title">Nos Produits Artisanaux</h1>
    <p class="products-subtitle">
        Découvrez des pièces uniques créées par nos artisans.
    </p>

    <!-- ================== FILTRES ================== -->
    <form method="GET" action="index.php" class="filter-card">

        <input type="hidden" name="page" value="products">
        <input type="hidden" name="category" id="categoryInput" value="<?= htmlspecialchars($_GET['category'] ?? 'Tous') ?>">
        <input type="hidden" name="material" id="materialInput" value="<?= htmlspecialchars($_GET['material'] ?? 'Tous') ?>">

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
                <input
                    type="text"
                    name="search"
                    class="filter-input"
                    placeholder="Rechercher par produit ou artisan..."
                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                />
            </div>
        </div>

        <!-- Catégorie -->
        <div class="filter-row">
            <p class="filter-label">Catégorie :</p>
            <div class="chip-group" id="categoryChips">
                <?php foreach (['Tous','Poterie','Vêtements','Décoration','Accessoires','Autre'] as $cat): ?>
                    <button
                        type="button"
                        class="chip <?= ($_GET['category'] ?? 'Tous') === $cat ? 'chip-active' : '' ?>"
                        data-value="<?= $cat ?>"
                    >
                        <?= $cat ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Matière -->
        <div class="filter-row">
            <p class="filter-label">Matière :</p>
            <div class="chip-group" id="materialChips">
                <?php foreach (['Tous','Céramique','Bois','Cuir','Textile','Métal','Verre','Papier','Autre'] as $mat): ?>
                    <button
                        type="button"
                        class="chip <?= ($_GET['material'] ?? 'Tous') === $mat ? 'chip-active' : '' ?>"
                        data-value="<?= $mat ?>"
                    >
                        <?= $mat ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

    </form>

    <!-- ================== RÉSULTATS ================== -->
    <?php if (empty($products)): ?>

        <p class="no-results">
            Aucun produit ne correspond à vos filtres.
        </p>

    <?php else: ?>

        <div class="products-grid">

            <?php foreach ($products as $product): ?>
                <div class="product-card product-appear">

                    <img src="https://picsum.photos/500/300" alt="Produit artisanal">

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

<script src="./assets/js/signup/products.js"></script>

</body>
</html>
