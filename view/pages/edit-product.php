<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Artisan – Modifier un produit</title>
    <link rel="stylesheet" href="./assets/css/pages/add-product-craftman.css">
</head>

<body>

<div class="container">

    <header class="header">
        <h1>Modifier le produit</h1>
        <a class="btn-outline" href="index.php?page=craftman-products">← Retour</a>
    </header>

    <form method="POST" class="form">

        <div class="field">
            <label for="title">Nom du produit</label>
            <input id="title" name="name" type="text"
                   value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>

        <div class="row">
            <div class="field">
                <label for="price">Prix (€)</label>
                <input id="price" name="unit_price" type="number" step="0.01" min="0.01"
                       value="<?= $product['unit_price'] ?>" required>
            </div>
            <div class="field">
                <label for="stock">Stock</label>
                <input id="stock" name="quantity" type="number" min="0"
                       value="<?= $product['quantity'] ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <label for="category">Catégorie</label>
                <select id="category" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['category_id'] ?>"
                            <?= $category['category_id'] == $product['category_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['category_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="field">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" required><?= htmlspecialchars($product['description']) ?></textarea>
        </div>

        <div class="actions">
            <button type="submit" class="btn-primary">Modifier</button>
        </div>

    </form>
</div>

</body>
</html>
