<?php

/* =========================
   PANIER UTILISATEUR
========================= */

/**
 * Récupère l’ID du panier d’un utilisateur
 */
function getCartIdByUser(PDO $pdo, int $user_id)
{
    $sql = "SELECT shopping_cart_id FROM shopping_cart WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
}

/**
 * Récupère un produit déjà présent dans le panier
 */
function getProductFromCart(PDO $pdo, int $cart_id, int $product_id)
{
    $sql = "
        SELECT quantity
        FROM shopping_cart_product
        WHERE shopping_cart_id = ? AND product_id = ?
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cart_id, $product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Ajoute un produit au panier
 */
function insertProductOnCart(PDO $pdo, int $cart_id, int $product_id, int $quantity)
{
    $sql = "
        INSERT INTO shopping_cart_product (shopping_cart_id, product_id, quantity)
        VALUES (?, ?, ?)
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cart_id, $product_id, $quantity]);
}

/**
 * Met à jour la quantité d’un produit dans le panier
 */
function updateProductQuantityOnCart(PDO $pdo, int $cart_id, int $product_id, int $quantity)
{
    $sql = "
        UPDATE shopping_cart_product
        SET quantity = ?
        WHERE shopping_cart_id = ? AND product_id = ?
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$quantity, $cart_id, $product_id]);
}

/**
 * Supprime un produit du panier
 */
function deleteProductFromCart(PDO $pdo, int $cart_id, int $product_id)
{
    $sql = "
        DELETE FROM shopping_cart_product
        WHERE shopping_cart_id = ? AND product_id = ?
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cart_id, $product_id]);
}

/**
 * Récupère le contenu du panier avec le prix total par produit
 */
function getCartByUser(PDO $pdo, int $user_id)
{
    $sql = "
        SELECT
            product.product_id,
            product.name,
            craftman.company_name,
            product.unit_price,
            shopping_cart_product.quantity,
            (product.unit_price * shopping_cart_product.quantity) AS total
        FROM shopping_cart
        INNER JOIN shopping_cart_product
            ON shopping_cart.shopping_cart_id = shopping_cart_product.shopping_cart_id
        INNER JOIN product
            ON shopping_cart_product.product_id = product.product_id
        INNER JOIN craftman
            ON product.craftman_id = craftman.craftman_id
        WHERE shopping_cart.user_id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



/**
 * Prix total du panier
 */
function getTotalPriceOfCart(PDO $pdo, int $user_id)
{
    $sql = "
        SELECT SUM(product.unit_price * shopping_cart_product.quantity)
        FROM shopping_cart
        JOIN shopping_cart_product
            ON shopping_cart.shopping_cart_id = shopping_cart_product.shopping_cart_id
        JOIN product
            ON shopping_cart_product.product_id = product.product_id
        WHERE shopping_cart.user_id = ?
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    return (float) $stmt->fetchColumn();
}

function clearCart(PDO $pdo, int $cart_id)
{
    $sql = "DELETE FROM shopping_cart_product WHERE shopping_cart_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cart_id]);
}
