<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>

    <link rel="stylesheet" href="../../styles.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="cart-card">

            <p class="subtitle">VOTRE SÉLECTION</p>
            <h1>Panier</h1>
            <p class="description">Retrouvez ici les articles que vous souhaitez acheter</p>

            <!-- PRODUIT 1 -->
            <div class="cart-item">
                <img src="https://picsum.photos/200/300" class="cart-img">

                <div class="cart-info">
                    <h3>Bol artisanal en céramique</h3>
                    <p class="craftsman">par Élodie – Céramiste</p>

                    <div class="cart-bottom">
                        <span class="price">32,00 €</span>

                        <div class="qty-box">
                            <button onclick="changeQty(this, -1)">-</button>
                            <input type="text" value="1" readonly>
                            <button onclick="changeQty(this, 1)">+</button>
                        </div>
                    </div>
                </div>

                <button class="remove-btn" onclick="removeItem(this)">×</button>
            </div>

            <!-- PRODUIT 2 -->
            <div class="cart-item">
                <img src="https://picsum.photos/200/300" class="cart-img">

                <div class="cart-info">
                    <h3>Planche en bois sculptée</h3>
                    <p class="craftsman">par Lucas – Ébéniste</p>

                    <div class="cart-bottom">
                        <span class="price">45,00 €</span>

                        <div class="qty-box">
                            <button onclick="changeQty(this, -1)">-</button>
                            <input type="text" value="1" readonly>
                            <button onclick="changeQty(this, 1)">+</button>
                        </div>
                    </div>
                </div>

                <button class="remove-btn" onclick="removeItem(this)">×</button>
            </div>

            <!-- RÉSUMÉ -->
            <div class="summary">
                <div class="row-s">
                    <span>Sous-total :</span>
                    <span id="subtotal">77,00 €</span>
                </div>

                <div class="row-s">
                    <span>Livraison :</span>
                    <span id="shipping">5,90 €</span>
                </div>

                <div class="divider"></div>

                <div class="row-s total">
                    <span>Total :</span>
                    <span id="total">82,90 €</span>
                </div>

                <button class="login-btn" style="margin-top:20px;">Passer la commande</button>
            </div>

        </div>
    </div>

</body>

</html>