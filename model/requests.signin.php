<?php

function getUser(PDO $pdo, string $email)
{
    blockBackslashes([$email]);

    $stmt = $pdo->prepare("
        SELECT user_id, email, hashed_password
        FROM `user`
        WHERE email = ?
        LIMIT 1
    ");

    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user ?: null;
}

function getAdmin(PDO $pdo, string $email)
{
    blockBackslashes([$email]);

    $stmt = $pdo->prepare("
        SELECT admin_id, email, hashed_password
        FROM administrator
        WHERE email = ?
        LIMIT 1
    ");

    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    return $admin ?: null;
}

function getCraftman(PDO $pdo, string $siret)
{
    blockBackslashes([$siret]);

    $stmt = $pdo->prepare("
        SELECT craftman_id, siret, hashed_password
        FROM craftman
        WHERE siret = ?
        LIMIT 1
    ");

    $stmt->execute([$siret]);
    $craftman = $stmt->fetch(PDO::FETCH_ASSOC);

    return $craftman ?: null;
}
