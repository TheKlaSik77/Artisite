<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Artisan – Mes produits</title>

    <link rel="stylesheet" href="./assets/css/pages/craftman-products.css">
</head>
<script src="./assets/js/products/image_cycle.js"></script>

<body>
    <main class="products-section craftman-products">
        <div class="container">

            <header class="header header-split">
                <div>
                    <h1>Mes produits</h1>
                    <p class="muted">Gérez vos produits : modifier, supprimer, surveiller le stock.</p>
                </div>

                <div class="header-actions">
                    <a class="btn-outline" href="index.php?page=home">← Retour</a>
                    <a class="btn-primary" href="index.php?page=add-product-craftman">+ Ajouter un produit</a>
                </div>
            </header>

            <!-- Toolbar -->
            <div class="toolbar">
                <div class="toolbar-left">
                    <div class="searchbox">
                        <span class="search-ico">🔍</span>
                        <input id="searchInput" type="text" placeholder="Rechercher par nom, catégorie, statut..." />
                    </div>

                    <select id="statusFilter" class="select">
                        <option value="all">Tous statuts</option>
                        <option value="published">Publié</option>
                        <option value="pending">En validation</option>
                        <option value="draft">Brouillon</option>
                    </select>

                    <select id="stockFilter" class="select">
                        <option value="all">Tous stocks</option>
                        <option value="low">Stock faible (≤ 5)</option>
                        <option value="out">Rupture (0)</option>
                    </select>
                </div>

                <div class="toolbar-right">
                    <div id="count" class="count-pill">
                        <span><?= htmlspecialchars(count($craftman_products)) ?> Produit(s)</span>
                    </div>
                </div>
            </div>

            <!-- Liste -->
            <div id="productsList" class="products-list">
                <div class="products-grid">
                    <?php foreach ($craftman_products as $product): ?>
                        <div class="product-card product-appear">
                            <article class="product-row" data-id="1" data-title="Bol en céramique" data-category="Poterie"
                                data-status="published" data-stock="12">
                                <div class="prod-left">
                                    <div class="prod-thumb">
                                        <img src="<?= htmlspecialchars($product['image_link'] ?? 'https://picsum.photos/200/300') ?>"
                                            alt="<?= htmlspecialchars($product['name']) ?>">
                                    </div>

                                    <div class="prod-meta">
                                        <h3 class="prod-title"><?= htmlspecialchars($product['name']) ?></h3>
                                        <div class="prod-sub">
                                            <span
                                                class="badge cat"><?= htmlspecialchars($product['category_name']) ?></span>
                                            <span class="price"><?= number_format($product['unit_price'], 2, ',', ' ') ?>
                                                €</span>
                                        </div>
                                        <p class="prod-desc"><?= htmlspecialchars($product['description']) ?></p>
                                    </div>
                                </div>

                                <div class="prod-right">
                                    <div class="qty-box">
                                        <form method="POST" action="index.php?page=craftman-products&action=updateQuantity">
                                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                            <input type="hidden" name="quantity" value="<?= $product['quantity'] - 1 ?>">
                                            <button type="submit" <?= $product['quantity'] <= 1 ? 'disabled' : '' ?>>−</button>
                                        </form>

                                        <input type="text" value="<?= $product['quantity'] ?>" readonly>

                                        <form method="POST" action="index.php?page=craftman-products&action=updateQuantity">
                                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                            <input type="hidden" name="quantity" value="<?= $product['quantity'] + 1 ?>">
                                            <button type="submit">+</button>
                                        </form>
                                    </div>

                                    <div class="row-actions">
                                        <a class="btn-outline small"
                                            href="index.php?page=edit-product&id=<?= $product['product_id'] ?>">
                                            Modifier
                                        </a>

                                        <form method="POST" action="index.php?page=craftman-products&action=delete">
                                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                            <button class="btn-danger small" type="submit">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </main>
</body>

</html>