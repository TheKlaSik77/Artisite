<?php

function createAddress(
    PDO $pdo,
    string $street,
    string $city,
    string $zip,
    string $country,
    int $user_id
) {
    $sql = "
        INSERT INTO address (
            street,
            city,
            zip_code,
            country,
            user_id
        )
        VALUES (?, ?, ?, ?, ?)
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$street, $city, $zip, $country, $user_id]);

    return (int) $pdo->lastInsertId();
}
