<?php

/* --------------------------------------
            READ FONCTIONS
----------------------------------------*/

function getAllOrders(PDO $pdo)
{
    $sql = "
        SELECT 
            co.order_id,
            co.order_date,
            co.order_cost,
            co.status,
            u.username,
            u.email
        FROM customer_order co
        INNER JOIN shopping_cart sc ON co.shopping_cart_id = sc.shopping_cart_id
        INNER JOIN user u ON sc.user_id = u.user_id
        ORDER BY co.order_date DESC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getOrderDetails(PDO $pdo, int $orderId)
{
    $sql = "
        SELECT 
            co.order_id,
            co.order_date,
            co.order_cost,
            co.status,
            u.username,
            u.email
        FROM customer_order co
        INNER JOIN shopping_cart sc ON co.shopping_cart_id = sc.shopping_cart_id
        INNER JOIN user u ON sc.user_id = u.user_id
        WHERE co.order_id = ?
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$orderId]);
    return $stmt->fetch();
}

function getOrderProducts(PDO $pdo, int $orderId)
{
    $sql = "
        SELECT 
            p.product_id,
            p.name,
            op.unit_price,
            op.quantity
        FROM order_product op
        INNER JOIN product p ON op.product_id = p.product_id
        WHERE op.order_id = ?
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$orderId]);
    return $stmt->fetchAll();
}

function insertOrderProducts(PDO $pdo, int $orderId, array $products)
{
    $sql = "
        INSERT INTO order_product (order_id, product_id, quantity, unit_price)
        VALUES (?, ?, ?, ?)
    ";
    $stmt = $pdo->prepare($sql);
    
    foreach ($products as $product) {
        $stmt->execute([
            $orderId,
            $product['product_id'],
            $product['quantity'],
            $product['unit_price']
        ]);
    }
}

/* --------------------------------------
            CREATE FONCTIONS
----------------------------------------*/

function createOrder(
    PDO $pdo,
    int $cart_id,
    int $delivery_address_id,
    float $total
) {
    $sql = "
        INSERT INTO customer_order (
            shopping_cart_id,
            delivery_address_id,
            order_date,
            order_cost,
            status
        )
        VALUES (?, ?, NOW(), ?, 'confirmed')
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $cart_id,
        $delivery_address_id,
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
/* --------------------------------------
            DELETE FONCTIONS
----------------------------------------*/

function deleteOrder(PDO $pdo, int $orderId): bool
{
    $stmt = $pdo->prepare("
        DELETE FROM customer_order
        WHERE order_id = ?
    ");

    return $stmt->execute([$orderId]);
}