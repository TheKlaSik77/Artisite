<?php

function getAllCategories(PDO $pdo)
{
    $stmt = $pdo->prepare("
        SELECT category_id, category_name
        FROM category
        ORDER BY category_name ASC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
