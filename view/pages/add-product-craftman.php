<?php
declare(strict_types=1);
session_start();

/**
 * DEMO AUTH :
 * On suppose que tu as déjà connecté l'artisan et stocké son user_id en session.
 * Exemple: $_SESSION['user_id'] = 12;
 */
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit("Accès refusé. Connecte-toi.");
}

$userId = (int)$_SESSION['user_id'];

// =========================
// CONFIG DB (PDO)
// =========================
$DB_HOST = "localhost";
$DB_NAME = "artisite";
$DB_USER = "root";
$DB_PASS = "";

$dsn = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4";
$pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// =========================
// Récupérer l'artisan_id lié au user connecté
// =========================
$stmt = $pdo->prepare("
    SELECT a.id, a.status
    FROM artisans a
    JOIN users u ON u.id = a.user_id
    WHERE a.user_id = :user_id AND u.role = 'artisan'
    LIMIT 1
");
$stmt->execute([':user_id' => $userId]);
$artisan = $stmt->fetch();

if (!$artisan) {
    http_response_code(403);
    exit("Compte artisan introuvable.");
}
if ($artisan['status'] === 'blocked') {
    http_response_code(403);
    exit("Compte artisan bloqué.");
}

$artisanId = (int)$artisan['id'];

// =========================
// Catégories (pour le select)
// =========================
$categories = $pdo->query("SELECT id, name FROM categories WHERE is_active = 1 ORDER BY name ASC")->fetchAll();

// =========================
// Helpers
// =========================
function h(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

$errors = [];
$success = null;

// =========================
// TRAITEMENT POST
// =========================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim((string)($_POST['title'] ?? ''));
    $description = trim((string)($_POST['description'] ?? ''));
    $price = trim((string)($_POST['price'] ?? ''));
    $stock = trim((string)($_POST['stock'] ?? ''));
    $categoryId = $_POST['category_id'] ?? null;
    $action = $_POST['action'] ?? 'submit'; // draft | submit

    // Validation simple
    if ($title === '' || mb_strlen($title) < 3) $errors[] = "Nom du produit invalide (min 3 caractères).";
    if ($description === '' || mb_strlen($description) < 10) $errors[] = "Description invalide (min 10 caractères).";

    if (!is_numeric($price) || (float)$price <= 0) $errors[] = "Prix invalide.";
    if (!ctype_digit((string)$stock)) $errors[] = "Stock invalide.";
    $stockInt = (int)$stock;

    // category nullable
    $categoryIdInt = null;
    if ($categoryId !== null && $categoryId !== '') {
        if (!ctype_digit((string)$categoryId)) {
            $errors[] = "Catégorie invalide.";
        } else {
            $categoryIdInt = (int)$categoryId;
        }
    }

    // Convertir en centimes
    $priceCents = (int) round(((float)$price) * 100);

    // Définir status
    $status = ($action === 'draft') ? 'draft' : 'pending'; // admin validera ensuite

    // Upload images
    $uploadedPaths = [];
    $uploadDir = __DIR__ . "/uploads/products/";
    $publicBase = "uploads/products/"; // URL relative

    if (!is_dir($uploadDir)) {
        @mkdir($uploadDir, 0775, true);
    }

    if (!empty($_FILES['images']) && is_array($_FILES['images']['name'])) {
        $count = count($_FILES['images']['name']);

        for ($i = 0; $i < $count; $i++) {
            if ($_FILES['images']['error'][$i] === UPLOAD_ERR_NO_FILE) continue;

            if ($_FILES['images']['error'][$i] !== UPLOAD_ERR_OK) {
                $errors[] = "Erreur upload image #" . ($i + 1);
                continue;
            }

            $tmp = $_FILES['images']['tmp_name'][$i];
            $origName = (string)$_FILES['images']['name'][$i];

            // Vérif mime (simple)
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($tmp);
            $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];

            if (!isset($allowed[$mime])) {
                $errors[] = "Format non autorisé pour {$origName} (jpg/png/webp uniquement).";
                continue;
            }

            // Nom unique
            $ext = $allowed[$mime];
            $newName = "p_" . $artisanId . "_" . bin2hex(random_bytes(8)) . "." . $ext;
            $dest = $uploadDir . $newName;

            if (!move_uploaded_file($tmp, $dest)) {
                $errors[] = "Impossible d'enregistrer l'image {$origName}.";
                continue;
            }

            $uploadedPaths[] = $publicBase . $newName;
        }
    }

    // Si pas d’images, tu peux choisir d'obliger ou non :
    // Ici je n'oblige pas, mais tu peux décommenter :
    // if (count($uploadedPaths) === 0) $errors[] = "Ajoute au moins 1 image.";

    if (!$errors) {
        // =========================
        // TRANSACTION : insert product + images
        // =========================
        $pdo->beginTransaction();
        try {
            // INSERT PRODUCT
            $stmt = $pdo->prepare("
                INSERT INTO products (artisan_id, category_id, title, description, price_cents, stock, status)
                VALUES (:artisan_id, :category_id, :title, :description, :price_cents, :stock, :status)
            ");
            $stmt->execute([
                ':artisan_id' => $artisanId,
                ':category_id' => $categoryIdInt,
                ':title' => $title,
                ':description' => $description,
                ':price_cents' => $priceCents,
                ':stock' => $stockInt,
                ':status' => $status
            ]);

            $productId = (int)$pdo->lastInsertId();

            // INSERT IMAGES
            if (!empty($uploadedPaths)) {
                $stmtImg = $pdo->prepare("
                    INSERT INTO product_images (product_id, image_url, sort_order)
                    VALUES (:product_id, :image_url, :sort_order)
                ");

                $order = 0;
                foreach ($uploadedPaths as $path) {
                    $stmtImg->execute([
                        ':product_id' => $productId,
                        ':image_url' => $path,
                        ':sort_order' => $order++
                    ]);
                }
            }

            $pdo->commit();
            $success = ($status === 'draft')
                ? "Brouillon enregistré (ID #{$productId})."
                : "Produit envoyé en validation admin (ID #{$productId}).";

            // Reset champs après succès (option)
            $_POST = [];
        } catch (Throwable $e) {
            $pdo->rollBack();
            $errors[] = "Erreur DB: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Artisan – Ajouter un produit</title>
    <link rel="stylesheet" href="artisan_aj_product.css">
</head>
<body>

<div class="container">
    <header class="header">
        <h1>Ajouter un nouveau produit</h1>
        <a class="btn-outline" href="javascript:history.back()">← Retour</a>
    </header>

    <?php if ($success): ?>
        <div class="alert success"><?= h($success) ?></div>
    <?php endif; ?>

    <?php if ($errors): ?>
        <div class="alert danger">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= h($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form class="form" method="POST" enctype="multipart/form-data" id="productForm">
        <div class="field">
            <label for="title">Nom du produit</label>
            <input id="title" name="title" type="text" required value="<?= h((string)($_POST['title'] ?? '')) ?>" placeholder="Ex : Bol en céramique">
        </div>

        <div class="row">
            <div class="field">
                <label for="price">Prix (€)</label>
                <input id="price" name="price" type="number" step="0.01" min="0.01" required value="<?= h((string)($_POST['price'] ?? '')) ?>" placeholder="29.00">
            </div>
            <div class="field">
                <label for="stock">Stock</label>
                <input id="stock" name="stock" type="number" min="0" required value="<?= h((string)($_POST['stock'] ?? '0')) ?>">
            </div>
        </div>

        <div class="field">
            <label for="category_id">Catégorie</label>
            <select id="category_id" name="category_id">
                <option value="">— (optionnel)</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= (int)$cat['id'] ?>" <?= ((string)($cat['id']) === (string)($_POST['category_id'] ?? '')) ? 'selected' : '' ?>>
                        <?= h($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="field">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" required placeholder="Décris ton produit..."><?= h((string)($_POST['description'] ?? '')) ?></textarea>
        </div>

        <div class="field">
            <label for="images">Images (jpg/png/webp)</label>
            <input id="images" name="images[]" type="file" accept="image/jpeg,image/png,image/webp" multiple>
            <div id="preview" class="preview"></div>
        </div>

        <div class="actions">
            <button type="submit" name="action" value="draft" class="btn-secondary">Enregistrer brouillon</button>
            <button type="submit" name="action" value="submit" class="btn-primary">Envoyer en validation</button>
        </div>
    </form>
</div>

<script>
    // Preview images
    const input = document.getElementById("images");
    const preview = document.getElementById("preview");

    input.addEventListener("change", () => {
        preview.innerHTML = "";
        const files = Array.from(input.files || []);
        files.forEach(file => {
            const url = URL.createObjectURL(file);
            const img = document.createElement("img");
            img.src = url;
            img.alt = file.name;
            preview.appendChild(img);
        });
    });
</script>

</body>
</html>
