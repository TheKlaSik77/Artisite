<?php

function getAllCraftmen(PDO $pdo)
{
    $sql = "
        SELECT
            craftman.craftman_id,
            craftman.company_name,
            category.category_name
        FROM craftman
        INNER JOIN category
            ON craftman.category_id = category.category_id
        ORDER BY craftman.company_name ASC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCraftmanById(PDO $pdo, int $craftman_id)
{
    $sql = "
        SELECT
            craftman.craftman_id,
            craftman.company_name,
            craftman.description,
            craftman.siret,
            category.category_name
        FROM craftman
        INNER JOIN category
            ON craftman.category_id = category.category_id
        WHERE craftman.craftman_id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$craftman_id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
