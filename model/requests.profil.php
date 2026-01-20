<?php

/* ===========================
   GET PROFILES
=========================== */

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

/* ===========================
   PROFILE IMAGE
=========================== */

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

/* ===========================
   UPDATE PROFILE INFO
=========================== */

/* ✅ USER (NO DESCRIPTION) */
function updateUserInfo(PDO $pdo, int $user_id, string $username, string $phone_number): bool
{
    $stmt = $pdo->prepare("
        UPDATE `user`
        SET username = ?, phone_number = ?
        WHERE user_id = ?
    ");
    return $stmt->execute([$username, $phone_number, $user_id]);
}

/* ✅ CRAFTMAN (WITH DESCRIPTION) */
function updateCraftmanInfo(PDO $pdo, int $craftman_id, string $company_name, string $siret, string $description): bool
{
    $stmt = $pdo->prepare("
        UPDATE craftman
        SET company_name = ?, siret = ?, description = ?
        WHERE craftman_id = ?
    ");
    return $stmt->execute([$company_name, $siret, $description, $craftman_id]);
}
