<?php

function getAllCategories(PDO $pdo)
{
    $stmt = $pdo->prepare("SELECT category_id, category_name FROM category");
    $stmt->execute();
    return $stmt->fetchAll();
}


function insertProduct(
    PDO $pdo,
    string $name,
    int $category_id,
    string $unit_price,
    int $quantity,
    string $description,
    int $craftman_id
): int {
    blockBackslashes([$name, $unit_price, $description]);

    $stmt = $pdo->prepare("
        INSERT INTO product (name, unit_price, category_id, quantity, description, craftman_id)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $ok = $stmt->execute([
        $name,
        $unit_price,
        $category_id,
        $quantity,
        $description,
        $craftman_id
    ]);

    if (!$ok) {
        return 0;
    }

    return (int)$pdo->lastInsertId();
}

function insertProductImage(PDO $pdo, int $product_id, string $image_link, ?string $placeholder = null): bool
{
    blockBackslashes([$image_link, (string)$placeholder]);

    $stmt = $pdo->prepare("
        INSERT INTO image (image_link, placeholder, product_id)
        VALUES (?, ?, ?)
    ");

    return $stmt->execute([$image_link, $placeholder, $product_id]);
}
