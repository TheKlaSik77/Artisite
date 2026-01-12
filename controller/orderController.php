<?php

require_once "./model/requests.cart.php";
require_once "./model/requests.product.php";
require_once "./model/requests.order.php";

function orderController(PDO $pdo)
{
    // Sécurité : utilisateur connecté
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?page=signin");
        exit;
    }

    // Sécurité : POST uniquement
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        require "./view/pages/404.php";
        exit;
    }

    $user_id = (int) $_SESSION['user']['id'];

    // Récupérer le panier
    $cart_id = getCartIdByUser($pdo, $user_id);
    $products = getCartByUser($pdo, $user_id);

    if (!$cart_id || empty($products)) {
        header("Location: index.php?page=cart");
        exit;
    }

    try {
        // TRANSACTION
        $pdo->beginTransaction();

        // Calcul du total
        $total = 0;
        foreach ($products as $product) {
            $total += $product['total'];
        }

        // Créer la commande
        $delivery_address_id = getUserDeliveryAddress($pdo, $user_id);

        if (!$delivery_address_id) {
            throw new Exception("Aucune adresse de livraison trouvée pour cet utilisateur.");
        }

        $order_id = createOrder($pdo, $cart_id, $delivery_address_id, $total);

        //  Décrémenter le stock
        foreach ($products as $product) {
            decreaseProductStock(
                $pdo,
                $product['product_id'],
                $product['quantity']
            );
        }

        // Vider le panier
        clearCart($pdo, $cart_id);

        // Valider
        $pdo->commit();

        // Sauvegarder l’ID de commande
        $_SESSION['last_order_id'] = $order_id;

        // Redirection succès
        header("Location: index.php?page=order-success");
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        die("Erreur lors de la commande : " . $e->getMessage());
    }
}
