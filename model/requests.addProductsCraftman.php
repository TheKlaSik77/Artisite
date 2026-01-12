<?php

function getAllCategories(PDO $pdo)
{
    $stmt = $pdo->prepare("SELECT category_id, category_name FROM category");
    $stmt->execute();
    return $stmt->fetchAll();
}

function insertProduct(PDO $pdo, string $name, int $category_id, string $unit_price, int $quantity, string $description, int $craftman_id)
{
    blockBackslashes([$name, $unit_price, $description]);

    $stmt = $pdo->prepare("
        INSERT INTO product (name, unit_price, category_id, quantity, description, craftman_id)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    return $stmt->execute([
        $name,
        $unit_price,
        $category_id,
        $quantity,
        $description,
        $craftman_id
    ]);
}
