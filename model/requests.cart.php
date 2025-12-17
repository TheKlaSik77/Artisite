<?php

require "./model/utils/connexion.php";

/* --------------------------------------
            READ FONCTIONS
----------------------------------------*/

# Return 
function getCartByUser(PDO $pdo, int $user_id){
    $stmt = $pdo->prepare("
    Select product.product_id, product.name, product.quantity, product.quantity * product.unit_price AS prix_total
    From shopping_cart_id INNER JOIN shopping_cart_product ON shopping_cart.shopping_cart_id = shopping_cart_product.shopping_cart_id INNER JOIN product ON shopping_cart_product.product_id = product.product_id
    Where shopping_cart_id.user_id = ?
    ");
    $stmt -> execute([$user_id]);
    return $stmt->fetchAll();
}

/* --------------------------------------
            CREATE FONCTIONS
----------------------------------------*/

function insertProductOnCart(PDO $pdo, int $shopping_cart_id, int $product_id, int $quantity): bool{
    $stmt = $pdo->prepare("
        INSERT INTO shopping_cart_product (shopping_cart_id, product_id, quantity)
        VALUES (?, ?, ?)
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

function updateProductName(PDO $pdo, int $product_id, string $name): bool
{
    $stmt = $pdo->prepare("
        UPDATE product
        SET name = ?
        WHERE product_id = ?
    ");

    return $stmt->execute([$name, $product_id]);
}

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

# MODIFIER CA PAR SUPPRIMER TOUS LES ITEMS DU PANIER
function deleteProductOnCart(PDO $pdo, int $shopping_cart_id, int $product_id): bool{
    $stmt = $pdo->prepare("
        DELETE FROM shopping_cart_product
        WHERE shopping_cart_id = ? AND product_id = ?
    ");

    $stmt->execute([$shopping_cart_id, $product_id]);
    return $stmt -> rowCount() > 0;
}