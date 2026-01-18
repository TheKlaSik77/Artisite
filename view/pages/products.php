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
                    <input type="text" id="productSearch" class="filter-input"
                        placeholder="Rechercher par produit ou artisan..." />
                </div>
            </div>

            <!-- Catégorie -->
            <div class="filter-row">
                <p class="filter-label">Catégorie :</p>
                <div class="chip-group" id="categoryChips">
                    <button class="chip chip-active" data-category="Tous">Tous</button>
                    <button class="chip" data-category="Poterie">Poterie</button>
                    <button class="chip" data-category="Vêtements">Vêtements</button>
                    <button class="chip" data-category="Décoration">Décoration</button>
                    <button class="chip" data-category="Accessoires">Accessoires</button>
                    <button class="chip" data-category="Autre">Autre</button>
                </div>
            </div>

            <!-- Matière -->
            <div class="filter-row">
                <p class="filter-label">Matière :</p>
                <div class="chip-group" id="materialChips">
                    <button class="chip chip-active" data-material="Tous">Tous</button>
                    <button class="chip" data-material="Céramique">Céramique</button>
                    <button class="chip" data-material="Bois">Bois</button>
                    <button class="chip" data-material="Cuir">Cuir</button>
                    <button class="chip" data-material="Textile">Textile</button>
                    <button class="chip" data-material="Métal">Métal</button>
                    <button class="chip" data-material="Verre">Verre</button>
                    <button class="chip" data-material="Papier">Papier</button>
                    <button class="chip" data-material="Autre">Autre</button>
                </div>
            </div>
        </div>

        <!-- Message aucun résultat -->
        <?php if (empty($products)): ?>
            <p id="noResults" class="no-results">
                Aucun produit ne correspond à vos filtres.
            </p>
        <?php else: ?>

            <!-- ================== GRILLE PRODUITS ================== -->
            <div class="products-grid">

                <?php foreach ($products as $product): ?>
                    <div class="product-card product-appear">

                        <?php
                        $links = [];
                        if (!empty($product['image_links'])) {
                            $rawLinks = array_values(array_filter(explode('||', $product['image_links'])));
                            // Ajouter le préfixe /Artisite/ pour chaque lien
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

        <?php endif ?>
    </main>

</body>

</html>