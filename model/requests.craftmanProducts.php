<?php



/* --------------------------------------
            READ FONCTIONS
----------------------------------------*/
function getAllProductsOfCraftman(PDO $pdo, int $craftman_id) {
    $stmt = $pdo->prepare("SELECT product.product_id, product.name, craftman.company_name, category.category_name, product.unit_price, product.description, product.quantity FROM craftman INNER JOIN product ON craftman.craftman_id = product.craftman_id INNER JOIN category ON product.category_id = category.category_id WHERE craftman.craftman_id = ?");
    $stmt -> execute([$craftman_id]);
    return $stmt->fetchAll();
}


function updateCraftmanProductsQuantity(PDO $pdo, int $product_id, int $new_quantity){
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        return;
    }

    $product_id = $_POST["product_id"];
    $new_quantity = $_POST["quantity"];

    if ($product_id != null) {
        $stmt = $pdo->prepare("
        UPDATE product
        SET quantity = ?
        WHERE product_id = ?
    ");

        return $stmt->execute([$new_quantity, $product_id]);
    }
    header("Location: index.php?page=craftman-products");
    exit;
}

function deleteProduct(PDO $pdo, int $product_id): bool{
    $stmt = $pdo->prepare("
        DELETE FROM product
        WHERE product_id = ?
    ");

    $stmt->execute([$product_id]);
    return $stmt -> rowCount() > 0;
}

function getCraftmanProductById(PDO $pdo, int $product_id, int $craftman_id)
{
    $stmt = $pdo->prepare("
        SELECT product_id, name, unit_price, quantity, description, category_id
        FROM product
        WHERE product_id = ? AND craftman_id = ?
    ");
    $stmt->execute([$product_id, $craftman_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateCraftmanProduct(PDO $pdo, int $product_id, int $craftman_id, array $data)
{
    $stmt = $pdo->prepare("
        UPDATE product
        SET
            name = ?,
            unit_price = ?,
            quantity = ?,
            description = ?,
            category_id = ?
        WHERE product_id = ? AND craftman_id = ?
    ");

    return $stmt->execute([
        $data['name'],
        $data['unit_price'],
        $data['quantity'],
        $data['description'],
        $data['category_id'],
        $product_id,
        $craftman_id
    ]);
}
