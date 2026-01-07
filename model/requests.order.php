<?php

function createOrder(
    PDO $pdo,
    int $cart_id,
    int $delivery_address_id,
    int $order_sender,
    float $total
) {
    $sql = "
        INSERT INTO customer_order (
            shopping_cart_id,
            delivery_address_id,
            order_sender,
            order_date,
            order_cost,
            status
        )
        VALUES (?, ?, ?, NOW(), ?, 'confirmed')
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $cart_id,
        $delivery_address_id,
        $order_sender,
        $total
    ]);

    return (int) $pdo->lastInsertId();
}



function getUserDeliveryAddress(PDO $pdo, int $user_id)
{
    $sql = "
        SELECT address_id
        FROM address
        WHERE user_id = ?
        ORDER BY address_id ASC
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);

    return $stmt->fetchColumn();
}
