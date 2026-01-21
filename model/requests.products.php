<?php

/* --------------------------------------
            READ FONCTIONS
----------------------------------------*/
function getAllProducts(PDO $pdo)
{
    $stmt = $pdo->prepare("
        SELECT
            product.*,
            craftman.company_name,
            GROUP_CONCAT(image.image_link ORDER BY image.image_id SEPARATOR '||') AS image_links
        FROM product
        INNER JOIN craftman ON product.craftman_id = craftman.craftman_id
        LEFT JOIN image ON image.product_id = product.product_id
        GROUP BY product.product_id
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

function getProductById(PDO $pdo, int $id)
{
    $stmt = $pdo->prepare("
        SELECT
            product.*,
            craftman.company_name,
            category.category_name,
            GROUP_CONCAT(image.image_link ORDER BY image.image_id SEPARATOR '||') AS image_links
        FROM category
        INNER JOIN product ON category.category_id = product.category_id
        INNER JOIN craftman ON product.craftman_id = craftman.craftman_id
        LEFT JOIN image ON image.product_id = product.product_id
        WHERE product.product_id = ?
        GROUP BY product.product_id
    ");
    $stmt->execute([$id]);
    return $stmt->fetchAll();
}

function getProductsByCategory(PDO $pdo, string $category_name)
{
    $stmt = $pdo->prepare("
        SELECT
            product.*,
            craftman.company_name,
            GROUP_CONCAT(image.image_link ORDER BY image.image_id SEPARATOR '||') AS image_links
        FROM product
        INNER JOIN category ON product.category_id = category.category_id
        INNER JOIN craftman ON product.craftman_id = craftman.craftman_id
        LEFT JOIN image ON image.product_id = product.product_id
        WHERE category_name = ?
        GROUP BY product.product_id
    ");
    $stmt->execute([$category_name]);
    return $stmt->fetchAll();
}

function getProductsBySearch(PDO $pdo, string $search)
{
    $stmt = $pdo->prepare("
        Select product.*, craftman.company_name 
        FROM product INNER JOIN craftman ON product.craftman_id = craftman.craftman_id
        WHERE description LIKE '%?%' OR product_name LIKE '%?%'
    ");
    $stmt->execute([$search]);
    return $stmt->fetchAll();
}

function getNbProductsOfCraftman(PDO $pdo, int $craftman_id)
{
    $stmt = $pdo->prepare("
    Select COUNT(*) FROM Products WHERE craftman_id = ?
    ");
    $stmt->execute([$craftman_id]);
    return (int) $stmt->fetchColumn();
}

function getThreeLatestProducts(PDO $pdo)
{
    $stmt = $pdo->prepare("
        SELECT
            product.*,
            craftman.company_name,
            GROUP_CONCAT(image.image_link ORDER BY image.image_id SEPARATOR '||') AS image_links
        FROM product
        INNER JOIN craftman ON product.craftman_id = craftman.craftman_id
        LEFT JOIN image ON image.product_id = product.product_id
        GROUP BY product.product_id
        ORDER BY product.product_id DESC
        LIMIT 3
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

/* --------------------------------------
            CREATE FONCTIONS
----------------------------------------*/

# Insère un produit et met à null description et craft
function insertProduct(PDO $pdo, string $name, int $quantity, int $unit_price, int $category_id, int $craftman_id): bool
{
    $stmt = $pdo->prepare("
        INSERT INTO product (name, quantity, unit_price, category_id, craftman_id)
        VALUES (?, ?, ?, ?, ?)
    ");

    return $stmt->execute([
        $name,
        $quantity,
        $unit_price,
        $category_id,
        $craftman_id,
    ]);
}

/* --------------------------------------
            UPDATE FONCTIONS
----------------------------------------*/

function updateProductName(PDO $pdo, int $product_id, string $name): bool
{
    $stmt = $pdo->prepare("
        UPDATE product
        SET name = ?
        WHERE product_id = ?
    ");

    return $stmt->execute([$name, $product_id]);
}

function updateProductQuantity(PDO $pdo, int $product_id, int $newQuantity): bool
{
    $stmt = $pdo->prepare("
        UPDATE product
        SET quantity = ?
        WHERE product_id = ?
    ");

    return $stmt->execute([$newQuantity, $product_id]);
}

function updateProductUnitPrice(PDO $pdo, int $product_id, int $new_unit_price): bool
{
    $stmt = $pdo->prepare("
        UPDATE product
        SET unit_price = ?
        WHERE product_id = ?
    ");

    return $stmt->execute([$new_unit_price, $product_id]);
}

function updateProductDescription(PDO $pdo, int $product_id, int $new_description): bool
{
    $stmt = $pdo->prepare("
        UPDATE product
        SET description = ?
        WHERE product_id = ?
    ");

    return $stmt->execute([$new_description, $product_id]);
}

function updateProductCategory(PDO $pdo, int $product_id, int $category_id): bool
{
    $stmt = $pdo->prepare("
        UPDATE product
        SET category_id = ?
        WHERE product_id = ?
    ");

    return $stmt->execute([$category_id, $product_id]);
}

/* --------------------------------------
            Delete FONCTIONS
----------------------------------------*/

function deleteProduct(PDO $pdo, int $productId): bool
{
    $stmt = $pdo->prepare("
        DELETE FROM product
        WHERE product_id = ?
    ");

    return $stmt->execute([$productId]);
}
