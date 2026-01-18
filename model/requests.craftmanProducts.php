<?php

function getAllProductsOfCraftman(PDO $pdo, int $craftman_id): array
{
    $stmt = $pdo->prepare("
        SELECT
            p.product_id,
            p.name,
            p.quantity,
            p.unit_price,
            p.description,
            c.category_name,
            i.image_link
        FROM product p
        JOIN category c ON c.category_id = p.category_id
        LEFT JOIN (
            SELECT product_id, MIN(image_id) AS min_image_id
            FROM image
            GROUP BY product_id
        ) first_img ON first_img.product_id = p.product_id
        LEFT JOIN image i ON i.image_id = first_img.min_image_id
        WHERE p.craftman_id = ?
        ORDER BY p.product_id DESC
    ");
    $stmt->execute([$craftman_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateCraftmanProductsQuantity(PDO $pdo, int $product_id, int $new_quantity): bool
{
    $stmt = $pdo->prepare("UPDATE product SET quantity = ? WHERE product_id = ?");
    return $stmt->execute([$new_quantity, $product_id]);
}

function deleteProduct(PDO $pdo, int $product_id): bool
{
    $stmt = $pdo->prepare("DELETE FROM product WHERE product_id = ?");
    return $stmt->execute([$product_id]);
}
