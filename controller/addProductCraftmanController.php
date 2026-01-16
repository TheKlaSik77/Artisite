<?php

require_once './model/requests.addProductsCraftman.php';

function blockBackslashes(array $values): void
{
    foreach ($values as $v) {
        if (is_string($v) && strpos($v, '\\') !== false) {
            http_response_code(400);
            die('Backslash interdit');
        }
    }
}

function addProductCraftmanController(PDO $pdo)
{
    $action = $_GET['action'] ?? 'read';
    $categories = getAllCategories($pdo);

    switch ($action) {
        case 'add':
            addProductController($pdo);
            break;

        case 'read':
        default:
            require "./view/layout/header.php";
            require "./view/pages/add-product-craftman.php";
            require "./view/layout/footer.php";
            break;
    }
}

function addProductController(PDO $pdo)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }

    $name = trim($_POST["name"] ?? '');
    $unit_price = trim($_POST["unit_price"] ?? '');
    $category_id = (int)($_POST["category_id"] ?? 0);
    $quantity = (int)($_POST["quantity"] ?? 0);
    $description = trim($_POST["description"] ?? '');
    $craftman_id = (int)($_SESSION["user"]["id"] ?? 0);

    blockBackslashes([$name, $unit_price, $description]);

    if ($craftman_id <= 0) {
        require "./view/pages/404.php";
        return;
    }

    if ($name === '' || $description === '' || $category_id <= 0) {
        die("Champs invalides");
    }


    if (!isset($_FILES['images'])) {
        die("Images manquantes");
    }

    $files = $_FILES['images'];

    $names = array_filter($files['name'] ?? [], fn($n) => trim($n) !== '');
    $count = count($names);

    if ($count < 1 || $count > 6) {
        die("Veuillez sélectionner entre 1 et 6 images.");
    }

    $allowedMime = ['image/jpeg', 'image/png', 'image/webp'];
    $maxSizeBytes = 5 * 1024 * 1024; 
    $finfo = new finfo(FILEINFO_MIME_TYPE);

    try {
        $pdo->beginTransaction();

        $product_id = insertProduct($pdo, $name, $category_id, $unit_price, $quantity, $description, $craftman_id);
        if ($product_id <= 0) {
            throw new RuntimeException("Erreur insertion produit");
        }


        $baseDir = __DIR__ . "/../uploads/products/" . $product_id;

        if (!is_dir($baseDir)) {
            if (!mkdir($baseDir, 0755, true)) {
                throw new RuntimeException("Impossible de créer le dossier d'upload");
            }
        }

        for ($i = 0; $i < count($files['name']); $i++) {
            if (trim($files['name'][$i] ?? '') === '') {
                continue;
            }

            $err = $files['error'][$i] ?? UPLOAD_ERR_NO_FILE;
            if ($err !== UPLOAD_ERR_OK) {
                throw new RuntimeException("Erreur upload fichier : " . ($files['name'][$i] ?? ''));
            }

            $tmp = $files['tmp_name'][$i];
            $size = (int)($files['size'][$i] ?? 0);

            if ($size <= 0 || $size > $maxSizeBytes) {
                throw new RuntimeException("Fichier trop gros (max 5MB) : " . ($files['name'][$i] ?? ''));
            }

            $mime = $finfo->file($tmp);
            if (!in_array($mime, $allowedMime, true)) {
                throw new RuntimeException("Type interdit : " . ($files['name'][$i] ?? ''));
            }

            $ext = match ($mime) {
                'image/jpeg' => 'jpg',
                'image/png'  => 'png',
                'image/webp' => 'webp',
                default      => 'bin',
            };

            $unique = bin2hex(random_bytes(16));
            $filename = $unique . "." . $ext;

            $destAbs = $baseDir . "/" . $filename;

            if (!move_uploaded_file($tmp, $destAbs)) {
                throw new RuntimeException("Impossible de déplacer le fichier : " . ($files['name'][$i] ?? ''));
            }

            $relativePath = "uploads/products/" . $product_id . "/" . $filename;

            $ok = insertProductImage($pdo, $product_id, $relativePath, null);
            if (!$ok) {
                throw new RuntimeException("Erreur insertion image en DB");
            }
        }

        $pdo->commit();

        header("Location: index.php?page=craftman-products");
        exit;

    } catch (Throwable $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        die("Erreur: " . htmlspecialchars($e->getMessage()));
    }
}
