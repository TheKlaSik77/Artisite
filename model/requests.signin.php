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

function getAdmin($pdo, $email){
    $stmt = $pdo->prepare("
        SELECT admin_id, email, hashed_password FROM administrator WHERE email = ? LIMIT 1
    ");

    $stmt->execute([$email]);

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    return $admin ?: null;
}

function getCraftman(PDO $pdo, string $email)
{
    $stmt = $pdo->prepare("
        SELECT craftman_id, email, siret, validator_id, hashed_password FROM craftman WHERE email = ? LIMIT 1
    ");

    $stmt->execute([$email]);

    $craftman = $stmt->fetch(PDO::FETCH_ASSOC);

    return $craftman ?: null;

}