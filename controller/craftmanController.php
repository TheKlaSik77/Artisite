<?php

require_once __DIR__ . '/../model/requests.craftman.php';

/**
 * Returns the web-visible base path of the app.
 * Example:
 * - /Artisite/index.php -> /Artisite
 * - /index.php -> ""
 */
function basePath(): string
{
    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    return ($base === '/' ? '' : $base);
}

/**
 * Builds a public image URL from a DB path like:
 * uploads/profiles/craftman/1/profile_xxx.jpg
 */
function buildPublicImageUrl(?string $dbPath): string
{
    $base = basePath();
    if (!empty($dbPath)) {
        return $base . '/' . ltrim($dbPath, '/') . '?v=' . time();
    }
    return $base . '/assets/img/logo_artisite.jpeg';
}

function craftmanController(PDO $pdo): void
{
    $id = (int)($_GET['id'] ?? 0);
    if ($id <= 0) {
        http_response_code(400);
        die("ID artisan invalide");
    }

    // ✅ Craftman profile
    $craftman = getCraftmanProfileById($pdo, $id);
    if (!$craftman) {
        http_response_code(404);
        die("Artisan introuvable");
    }

    // ✅ Craftman products
    $products = getProductsWithImagesByCraftmanId($pdo, $id);

    // ✅ Craftman profile image URL
    $craftmanImageUrl = buildPublicImageUrl($craftman['profile_image'] ?? null);

    require __DIR__ . '/../view/layout/header.php';
    require __DIR__ . '/../view/pages/craftman.php';
    require __DIR__ . '/../view/layout/footer.php';
}
