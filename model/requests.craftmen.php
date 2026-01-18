<?php

/* --------------------------------------
            READ FUNCTIONS
----------------------------------------*/

function getAllCraftmen(PDO $pdo): array
{
    $stmt = $pdo->prepare("
        SELECT
            craftman_id,
            company_name,
            profile_image
        FROM craftman
        ORDER BY company_name ASC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCraftmanById(PDO $pdo, int $craftman_id): ?array
{
    $stmt = $pdo->prepare("
        SELECT
            craftman_id,
            siret,
            description,
            company_name,
            profile_image
        FROM craftman
        WHERE craftman_id = ?
        LIMIT 1
    ");
    $stmt->execute([$craftman_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}
