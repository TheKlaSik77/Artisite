<?php

function getAllProducts(PDO $pdo)
{
    $sql = "
        SELECT
            product.product_id,
            product.name,
            product.unit_price,
            product.quantity,
            product.description,
            craftman.company_name,
            category.category_name,
            GROUP_CONCAT(image.image_link ORDER BY image.image_id SEPARATOR '||') AS image_links
        FROM product
        INNER JOIN craftman
            ON product.craftman_id = craftman.craftman_id
        INNER JOIN category
            ON product.category_id = category.category_id
        LEFT JOIN image
            ON image.product_id = product.product_id
        GROUP BY product.product_id
        ORDER BY product.product_id DESC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductById(PDO $pdo, int $id)
{
    $sql = "
        SELECT
            product.product_id,
            product.name,
            product.description,
            product.unit_price,
            product.quantity,
            category.category_name,
            craftman.company_name,
            GROUP_CONCAT(image.image_link ORDER BY image.image_id SEPARATOR '||') AS image_links
        FROM product
        INNER JOIN category
            ON product.category_id = category.category_id
        INNER JOIN craftman
            ON product.craftman_id = craftman.craftman_id
        LEFT JOIN image
            ON image.product_id = product.product_id
        WHERE product.product_id = ?
        GROUP BY product.product_id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function decreaseProductStock(PDO $pdo, int $product_id, int $quantity)
{
    $sql = "
        UPDATE product
        SET quantity = quantity - ?
        WHERE product_id = ? AND quantity >= ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$quantity, $product_id, $quantity]);

    if ($stmt->rowCount() === 0) {
        throw new Exception("Stock insuffisant pour le produit ID $product_id");
    }
}
