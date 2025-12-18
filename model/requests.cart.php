<?php


/* --------------------------------------
            READ FONCTIONS
----------------------------------------*/

function getCartIdByUser(PDO $pdo, int $user_id): ?int
{
    $stmt = $pdo->prepare("
        SELECT shopping_cart_id
        FROM shopping_cart
        WHERE user_id = ?
        LIMIT 1
    ");

    $stmt->execute([$user_id]);

    $cartId = $stmt->fetchColumn();

    return $cartId !== false ? (int)$cartId : null;
}

function getCartByUser(PDO $pdo, int $user_id){
    $stmt = $pdo->prepare("
    Select product.product_id AS product_id, product.name AS name, craftman.company_name AS company_name, shopping_cart_product.quantity AS quantity, shopping_cart_product.quantity * product.unit_price AS total
    From shopping_cart INNER JOIN shopping_cart_product ON shopping_cart.shopping_cart_id = shopping_cart_product.shopping_cart_id INNER JOIN product ON shopping_cart_product.product_id = product.product_id INNER JOIN craftman ON product.craftman_id = craftman.craftman_id
    Where shopping_cart.user_id = ?
    ");
    $stmt -> execute([$user_id]);
    return $stmt->fetchAll();
}

function getTotalPriceOfCart($pdo, int $user_id){
    $stmt = $pdo->prepare("
        SELECT COALESCE(SUM(shopping_cart_product.quantity * product.unit_price), 0)
        FROM shopping_cart
        INNER JOIN shopping_cart_product
            ON shopping_cart.shopping_cart_id = shopping_cart_product.shopping_cart_id
        INNER JOIN product
            ON shopping_cart_product.product_id = product.product_id
        WHERE shopping_cart.user_id = ?
    ");
    $stmt -> execute([$user_id]);
    return (float) $stmt->fetchColumn();

}

/* --------------------------------------
            CREATE FONCTIONS
----------------------------------------*/

function insertProductOnCart(PDO $pdo, int $shopping_cart_id, int $product_id, int $quantity): bool{
    $stmt = $pdo->prepare("
        INSERT INTO shopping_cart_product (shopping_cart_id, product_id, quantity)
        VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)
    ");

    return $stmt->execute([
        $shopping_cart_id,
        $product_id,
        $quantity 
    ]);
}


/* --------------------------------------
            UPDATE FONCTIONS
----------------------------------------*/
function updateProductQuantityOnCart(PDO $pdo, int $shopping_cart_id, int $product_id, int $new_quantity): bool{
    $stmt = $pdo->prepare("
        UPDATE shopping_cart_product
        SET quantity = ?
        WHERE shopping_cart_id = ? AND product_id = ?
    ");

    return $stmt->execute([$new_quantity, $shopping_cart_id, $product_id]);
}
############################################

/* --------------------------------------
            Delete FONCTIONS
----------------------------------------*/

function deleteProductFromCart(PDO $pdo, int $shopping_cart_id, int $product_id): bool{
    $stmt = $pdo->prepare("
        DELETE FROM shopping_cart_product
        WHERE shopping_cart_id = ? AND product_id = ?
    ");

    $stmt->execute([$shopping_cart_id, $product_id]);
    return $stmt -> rowCount() > 0;
}

# Ajouter un "vider le panier"