<?php 
function getAllCategories(PDO $pdo) {
    $stmt = $pdo->prepare("SELECT category_id, category_name From category");
    $stmt -> execute();
    return $stmt->fetchAll();
}


function insertProduct(PDO $pdo, string $name, int $category_id, string $unit_price, int $quantity, string $description, $craftman_id)
{
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