<?php

function getAllUsers(PDO $pdo)
{
    $stmt = $pdo->prepare("
        SELECT 
            user_id,
            username,
            last_name,
            first_name,
            email,
            phone_number,
            hashed_password,
            accepted_terms_of_use_id
        FROM 
            user
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

function deleteUser(PDO $pdo, int $user_id): bool
{
    $stmt = $pdo->prepare("
        DELETE FROM user
        WHERE user_id = ?
    ");

    return $stmt->execute([$user_id]);
}