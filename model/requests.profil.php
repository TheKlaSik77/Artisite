<?php

function getUserProfileById(PDO $pdo, int $user_id): ?array
{
    $stmt = $pdo->prepare("
        SELECT
            user_id,
            username,
            last_name,
            first_name,
            email,
            phone_number,
            description,
            profile_image
        FROM `user`
        WHERE user_id = ?
        LIMIT 1
    ");
    $stmt->execute([$user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row ?: null;
}

function getCraftmanProfileById(PDO $pdo, int $craftman_id): ?array
{
    $stmt = $pdo->prepare("
        SELECT
            craftman_id,
            company_name,
            siret,
            description,
            profile_image
        FROM craftman
        WHERE craftman_id = ?
        LIMIT 1
    ");
    $stmt->execute([$craftman_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row ?: null;
}

function updateUserProfileImage(PDO $pdo, int $user_id, string $relativePath): bool
{
    $stmt = $pdo->prepare("
        UPDATE `user`
        SET profile_image = ?
        WHERE user_id = ?
    ");
    return $stmt->execute([$relativePath, $user_id]);
}

function updateCraftmanProfileImage(PDO $pdo, int $craftman_id, string $relativePath): bool
{
    $stmt = $pdo->prepare("
        UPDATE craftman
        SET profile_image = ?
        WHERE craftman_id = ?
    ");
    return $stmt->execute([$relativePath, $craftman_id]);
}
