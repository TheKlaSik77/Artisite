<?php

function getUserIdByEmail(PDO $pdo, $email)
{
    blockBackslashes([$email]);

    $stmt = $pdo->prepare("
        SELECT user_id FROM `user` WHERE email = ? LIMIT 1
    ");
    $stmt->execute([$email]);

    $user_id = $stmt->fetchColumn();

    return $user_id !== false ? (int)$user_id : null;
}

function getUserHashedPassword(PDO $pdo, string $email): ?string
{
    blockBackslashes([$email]);

    $stmt = $pdo->prepare("
        SELECT hashed_password FROM `user` WHERE email = ? LIMIT 1
    ");
    $stmt->execute([$email]);

    $hash = $stmt->fetchColumn();

    return $hash !== false ? $hash : null;
}

function getCraftmanHashedPassword(PDO $pdo, string $siret): ?string
{
    blockBackslashes([$siret]);

    $stmt = $pdo->prepare("
        SELECT hashed_password FROM craftman WHERE siret = ? LIMIT 1
    ");
    $stmt->execute([$siret]);

    $hash = $stmt->fetchColumn();

    return $hash !== false ? $hash : null;
}

function insertUser(
    PDO $pdo,
    string $username,
    string $last_name,
    string $first_name,
    string $email,
    string $phone_number,
    string $hashed_password
) {
    blockBackslashes([
        $username,
        $last_name,
        $first_name,
        $email,
        $phone_number,
        $hashed_password
    ]);

    /*
    ORIGINAL CODE (before our conversation)

    $stmt = $pdo->prepare("
        INSERT INTO `user` (username, last_name, first_name, email, phone_number, hashed_password)
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
    */

    // FIX: accepted_terms_of_use_id is a NOT NULL foreign key → must be inserted
    $stmt = $pdo->prepare("
        INSERT INTO `user`
        (username, last_name, first_name, email, phone_number, hashed_password, accepted_terms_of_use_id)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    return $stmt->execute([
        $username,
        $last_name,
        $first_name,
        $email,
        $phone_number,
        $hashed_password,
        1 // must exist in `terms_of_use` table
    ]);
}

function insertCraftman(
    PDO $pdo,
    string $company_name,
    string $siret,
    string $description,
    string $hashed_password
) {
    blockBackslashes([
        $company_name,
        $siret,
        $description,
        $hashed_password
    ]);

    $stmt = $pdo->prepare("
        INSERT INTO craftman (company_name, siret, description, hashed_password)
        VALUES (?, ?, ?, ?)
    ");

    return $stmt->execute([
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

    return $stmt->execute([$user_id]);
}

function usernameExists(PDO $pdo, string $username): bool
{
    blockBackslashes([$username]);

    $stmt = $pdo->prepare("SELECT 1 FROM `user` WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    return (bool)$stmt->fetchColumn();
}

function emailExists(PDO $pdo, string $email): bool
{
    blockBackslashes([$email]);

    $stmt = $pdo->prepare("SELECT 1 FROM `user` WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    return (bool)$stmt->fetchColumn();
}

function phoneExists(PDO $pdo, string $phone_number): bool
{
    blockBackslashes([$phone_number]);

    $stmt = $pdo->prepare("SELECT 1 FROM `user` WHERE phone_number = ? LIMIT 1");
    $stmt->execute([$phone_number]);
    return (bool)$stmt->fetchColumn();
}

function siretExists(PDO $pdo, string $siret): bool
{
    blockBackslashes([$siret]);

    $stmt = $pdo->prepare("SELECT 1 FROM craftman WHERE siret = ? LIMIT 1");
    $stmt->execute([$siret]);
    return (bool)$stmt->fetchColumn();
}
