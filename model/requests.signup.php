<?php


/* --------------------------------------
            READ FONCTIONS
----------------------------------------*/

function getUserIdByEmail(PDO $pdo, $email){
    $stmt = $pdo->prepare("
        SELECT user_id FROM user WHERE email = ? LIMIT 1
    ");
    $stmt->execute([$email]);

    $user_id = $stmt->fetchColumn();

    return $user_id !== false ? (int)$user_id : null;
}
function getUserHashedPassword(PDO $pdo, string $email): ?string
{
    $stmt = $pdo->prepare("
        SELECT hashed_password FROM user WHERE email = ? LIMIT 1
    ");

    $stmt->execute([$email]);

    $hash = $stmt->fetchColumn();

    return $hash !== false ? $hash : null;

}

function getCraftmanHashedPassword(PDO $pdo, string $siret): ?string
{
    $stmt = $pdo->prepare("
        SELECT hashed_password FROM craftman WHERE siret = ? LIMIT 1
    ");

    $stmt->execute([$siret]);

    $hash = $stmt->fetchColumn();

    return $hash !== false ? $hash : null;

}



/* --------------------------------------
            CREATE FONCTIONS
----------------------------------------*/

function insertUser(PDO $pdo, string $username, string $last_name, string $first_name, string $email, string $phone_number, string $hashed_password)
{
    $stmt = $pdo->prepare("
        INSERT INTO user (username, last_name, first_name, email,  phone_number, hashed_password)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    return $stmt->execute([
        $username,
        $last_name,
        $first_name,
        $email,
        $phone_number,
        $hashed_password
    ]);
}

function insertCraftman(PDO $pdo, string $email, string $company_name, string $siret, string $description, string $hashed_password)
{
    $stmt = $pdo->prepare("
        INSERT INTO craftman (email, company_name, siret, description, hashed_password)
        VALUES (?, ?, ?, ?, ?)
    ");

    return $stmt->execute([
        $email,
        $company_name,
        $siret,
        $description,
        $hashed_password,
    ]);
}

function CreateCartForUser(PDO $pdo, int $user_id)
{
    $stmt = $pdo->prepare("
        INSERT INTO shopping_cart (user_id)
        VALUES (?)
    ");

    return $stmt->execute([
        $user_id
    ]);
}

/* --------------------------------------
            UPDATE FONCTIONS
----------------------------------------*/


/* --------------------------------------
            Delete FONCTIONS
----------------------------------------*/

