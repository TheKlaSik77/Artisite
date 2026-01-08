<?php

function getAllProducts(PDO $pdo)
{
    $sql = "
        SELECT
            product.product_id,
            product.name,
            product.unit_price,
            product.quantity,
            craftman.company_name
        FROM product
        INNER JOIN craftman
            ON product.craftman_id = craftman.craftman_id
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
            craftman.company_name
        FROM product
        INNER JOIN category
            ON product.category_id = category.category_id
        INNER JOIN craftman
            ON product.craftman_id = craftman.craftman_id
        WHERE product.product_id = ?
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
