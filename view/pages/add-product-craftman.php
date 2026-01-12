<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Artisan – Ajouter un produit</title>
    <link rel="stylesheet" href="./assets/css/pages/add-product-craftman.css">
</head>

<body>

    <div class="container">

        <header class="header">
            <h1>Ajouter un nouveau produit</h1>
            <a class="btn-outline" href="index.php?page=craftman-products">← Retour</a>
        </header>

        <form method="POST" class="form" action="index.php?page=add-product-craftman&action=add" id="productForm" enctype="multipart/form-data">
            
            <!-- Infos principales -->
            <div class="field">
                <label for="title">Nom du produit</label>
                <input id="title" name="name" type="text" placeholder="" required>
            </div>

            <div class="row">
                <div class="field">
                    <label for="price">Prix (€)</label>
                    <input id="price" name="unit_price" type="number" step="0.01" min="0.01" required>
                </div>
                <div class="field">
                    <label for="stock">Stock</label>
                    <input id="stock" name="quantity" type="number" min="0" required>
                </div>
            </div>

            <div class="row">
                <div class="field">
                    <label for="category">Catégorie</label>
                    <select id="category" name="category_id" required>
                        <option value="" disabled selected>— Choisissez une catégorie —</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['category_id'] ?>">
                                <?= htmlspecialchars($category['category_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>


            </div>

            <div class="field">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" placeholder="Décris ton produit..."
                    required></textarea>
            </div>

            <!-- Images -->
            <div class="field">
                <label for="images">Images (3 à 6)</label>
                <input id="images" name="images[]" type="file" multiple accept="image/jpeg,image/png,image/webp"
                    >
                <div id="preview" class="preview"></div>
            </div>

            <div class="actions">
                <button type="submit" class="btn-primary">Envoyer</button>
            </div>

        </form>
    </div>

    


</body>

</html>