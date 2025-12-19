<?php



/* --------------------------------------
            READ FONCTIONS
----------------------------------------*/
function getAllProductsOfCraftman(PDO $pdo, int $craftman_id) {
    $stmt = $pdo->prepare("SELECT product.product_id, product.name, category.category_name, product.unit_price, product.description, product.quantity FROM craftman INNER JOIN product ON craftman.craftman_id = product.craftman_id INNER JOIN category ON product.category_id = category.category_id WHERE craftman.craftman_id = ?");
    $stmt -> execute([$craftman_id]);
    return $stmt->fetchAll();
}
