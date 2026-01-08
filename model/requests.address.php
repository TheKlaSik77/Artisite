<?php

function createAddress(
    PDO $pdo,
    string $street,
    string $city,
    string $zip,
    string $country,
    string $additionnal_information,
    int $user_id
) {
    $sql = "
        INSERT INTO address (
            street,
            city,
            zip_code,
            country,
            additionnal_information,
            user_id
        ) VALUES (?, ?, ?, ?, ?, ?)
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$street, $city, $zip, $country, $additionnal_information, $user_id]);

    return (int) $pdo->lastInsertId();
}
