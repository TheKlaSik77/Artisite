<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="./assets/css/pages/cart.css">
</head>

<body>
    <main>
        <div class="container">
            <div class="cart-card">

                <p class="subtitle">VOTRE SÉLECTION</p>
                <h1>Panier</h1>
                <p class="description">Retrouvez ici les articles que vous souhaitez acheter</p>



                <?php foreach ($productsOnCart as $_product): ?>
                    <!-- PRODUIT 1 -->
                    <div class="cart-item">
                        <img src="https://picsum.photos/200/300" class="cart-img">

                        <div class="cart-info">
                            <h3>
                                <?= htmlspecialchars($_product['name']) ?>
                            </h3>
                            <p class="craftsman">
                                <?= htmlspecialchars($_product['company_name']) ?>
                            </p>

                            <div class="cart-bottom">
                                <?= number_format($_product['total'], 2, ',', ' ') ?> €


                                <div class="qty-box">
                                    <form method="POST" action="index.php?page=cart&action=update">
                                        <input type="hidden" name="product_id" value="<?= $_product['product_id'] ?>">
                                        <input type="hidden" name="quantity" value="<?= $_product['quantity'] - 1 ?>">
                                        <button type="submit" <?= $_product['quantity'] <= 1 ? 'disabled' : '' ?>>−</button>
                                    </form>

                                    <input type="text" value="<?= $_product['quantity'] ?>" readonly>

                                    <form method="POST" action="index.php?page=cart&action=update">
                                        <input type="hidden" name="product_id" value="<?= $_product['product_id'] ?>">
                                        <input type="hidden" name="quantity" value="<?= $_product['quantity'] + 1 ?>">
                                        <button type="submit">+</button>
                                    </form>
                                </div>


                            </div>
                        </div>
                        <form method="POST" action="index.php?page=cart&action=delete">
                            <input type="hidden" name="product_id" value="<?= $_product["product_id"] ?>">
                            <button type="submit" class="remove-btn">×</button>
                        </form>

                    </div>
                <?php endforeach; ?>

                <!-- RÉSUMÉ -->
                <div class="summary">
                    <div class="row-s">
                        <span>Sous-total :</span>
                        <span id="subtotal"><?= number_format($totalPrice, 2, ',', ' ') ?> €</span>
                    </div>

                    <div class="row-s">
                        <span>Livraison :</span>
                        <span id="shipping">5,90 €</span>
                    </div>

                    <div class="divider"></div>

                    <div class="row-s total">
                        <span>Total :</span>
                        <span id="total"><?= number_format($totalPrice + 5.90, 2, ',', ' ') ?> €</span>
                    </div>

                    <a class="order-btn" href="index.php?page=order-success">
                        Passer la commande
                    </a>
                    <!-- Ajouter un Vider le panier ici -->


                </div>

            </div>
        </div>
    </main>
</body>

</html>