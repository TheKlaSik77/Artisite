<?php

/**
 * Get one craftman by id (includes profile image)
 */
function getCraftmanProfileById(PDO $pdo, int $craftman_id): ?array
{
    $stmt = $pdo->prepare("
        SELECT
            craftman_id,
            company_name,
            siret,
            email,
            description,
            profile_image
        FROM craftman
        WHERE craftman_id = ?
        LIMIT 1
    ");
    $stmt->execute([$craftman_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row ?: null;
}

/**
 * Get products for one craftman + images (same logic as products page)
 * image_links = 'path1||path2||...'
 */
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
