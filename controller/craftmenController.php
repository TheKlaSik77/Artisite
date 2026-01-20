<?php

require_once './model/requests.craftmen.php';

/**
 * Returns the web-visible "base path" of the app.
 * Example:
 * - /Artisite/index.php -> /Artisite
 * - /index.php -> ""
 */
function buildBasePath(): string
{
    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    return ($base === '/' ? '' : $base);
}

/**
 * Build a public URL for craftman profile images (or fallback).
 * DB stores: uploads/profiles/craftman/<id>/file.jpg
 */
function buildCraftmanImageUrl(?string $dbPath): string
{
    $base = buildBasePath();

    if (!empty($dbPath)) {
        return $base . '/' . ltrim($dbPath, '/') . '?v=' . time(); // cache-buster
    }

    // fallback image (change if you want)
    return $base . '/assets/img/logo_artisite.jpeg';
}

function craftmenController(PDO $pdo): void
{
    $craftmen = getAllCraftmen($pdo);

    // Add a computed URL for each craftman
    foreach ($craftmen as &$c) {
        $c['profile_image_url'] = buildCraftmanImageUrl($c['profile_image'] ?? null);
    }
    unset($c);

    require "./view/layout/header.php";
    require "./view/pages/craftmen.php";
    require "./view/layout/footer.php";
}

function getCraftmanController(PDO $pdo): void
{
    $id = (int)($_GET["id"] ?? 0);
    if ($id <= 0) {
        http_response_code(400);
        die("ID artisan invalide");
    }

    $craftman = getCraftmanById($pdo, $id);

    if (!$craftman) {
        http_response_code(404);
        die("Artisan introuvable");
    }

    $craftman['profile_image_url'] = buildCraftmanImageUrl($craftman['profile_image'] ?? null);

    require "./view/layout/header.php";
    require "./view/pages/craftman.php";
    require "./view/layout/footer.php";
}
function getProductsWithImagesByCraftmanId(PDO $pdo, int $craftman_id): array
{
    $stmt = $pdo->prepare("
        SELECT
            product.*,
            craftman.company_name,
            GROUP_CONCAT(image.image_link ORDER BY image.image_id SEPARATOR '||') AS image_links
        FROM product
        INNER JOIN craftman ON product.craftman_id = craftman.craftman_id
        LEFT JOIN image ON image.product_id = product.product_id
        WHERE product.craftman_id = ?
        GROUP BY product.product_id
        ORDER BY product.product_id DESC
    ");
    $stmt->execute([$craftman_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
}
