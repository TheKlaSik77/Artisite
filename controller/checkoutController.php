<?php

require_once "./model/requests.cart.php";
require_once "./model/requests.address.php";
require_once "./model/requests.order.php";
require_once "./model/requests.product.php";

function checkoutController(PDO $pdo)
{
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?page=signin");
        exit;
    }

    $user_id = (int) $_SESSION['user']['id'];

    //  AFFICHAGE DU FORMULAIRE
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $cart_id = getCartIdByUser($pdo, $user_id);
        $products = getCartByUser($pdo, $user_id);

        if (!$cart_id || empty($products)) {
            header("Location: index.php?page=cart");
            exit;
        }

        require "./view/layout/header.php";
        require "./view/pages/checkout.php";
        require "./view/layout/footer.php";
        exit;
    }

    //  TRAITEMENT DU FORMULAIRE
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $street  = trim($_POST['street'] ?? '');
        $city    = trim($_POST['city'] ?? '');
        $zip     = trim($_POST['zip_code'] ?? '');
        $country = trim($_POST['country'] ?? '');

        if (!$street || !$city || !$zip || !$country) {
            die("Tous les champs sont obligatoires.");
        }

        try {
            $pdo->beginTransaction();

            // Créer l’adresse
            $address_id = createAddress(
                $pdo,
                $street,
                $city,
                $zip,
                $country,
                $user_id
            );

            // 2️ Créer la commande
            $cart_id = getCartIdByUser($pdo, $user_id);
            $products = getCartByUser($pdo, $user_id);

            $total = 0;
            foreach ($products as $product) {
                $total += $product['total'];
            }

            $order_sender = getOrderSenderFromCart($pdo, $cart_id);

            if (!$order_sender) {
                throw new Exception("Impossible de déterminer l’artisan de la commande.");
            }

            $order_id = createOrder(
                $pdo,
                $cart_id,
                $address_id,
                $order_sender,
                $total
            );  


            // 3️ Décrémenter le stock
            foreach ($products as $product) {
                decreaseProductStock(
                    $pdo,
                    $product['product_id'],
                    $product['quantity']
                );
            }

            // 4️ Vider le panier
            clearCart($pdo, $cart_id);

            $pdo->commit();

            $_SESSION['last_order_id'] = $order_id;

            header("Location: index.php?page=order-success");
            exit;

        } catch (Exception $e) {
            $pdo->rollBack();
            die("Erreur checkout : " . $e->getMessage());
        }
    }
}
