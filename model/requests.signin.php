<?php


function getUser(PDO $pdo, string $email)
{
    $stmt = $pdo->prepare("
        SELECT user_id, hashed_password FROM user WHERE email = ? LIMIT 1
    ");

    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user ?: null;

}

function getCraftman(PDO $pdo, string $siret)
{
    $stmt = $pdo->prepare("
        SELECT craftman_id, siret, hashed_password FROM craftman WHERE siret = ? LIMIT 1
    ");

    $stmt->execute([$siret]);

    $craftman = $stmt->fetch(PDO::FETCH_ASSOC);

    return $craftman ?: null;

}