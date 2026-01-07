<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Finalisation de la commande – Arti’Site</title>

    <!-- CSS spécifique à la page checkout -->
    <link rel="stylesheet" href="./assets/css/pages/checkout.css">
</head>

<body>

<main class="checkout-section">

    <div class="container">

        <div class="checkout-card">

            <p class="subtitle">FINALISATION</p>

            <h1>Adresse de livraison</h1>

            <p class="description">
                Veuillez renseigner votre adresse pour finaliser votre commande.
            </p>

            <form method="POST" action="index.php?page=checkout" class="checkout-form">

                <div class="form-row">
                    <label for="street">Adresse</label>
                    <input
                        type="text"
                        id="street"
                        name="street"
                        placeholder="12 rue de la Paix"
                        required
                    >
                </div>

                <div class="form-row">
                    <label for="city">Ville</label>
                    <input
                        type="text"
                        id="city"
                        name="city"
                        placeholder="Paris"
                        required
                    >
                </div>

                <div class="form-row">
                    <label for="zip_code">Code postal</label>
                    <input
                        type="text"
                        id="zip_code"
                        name="zip_code"
                        placeholder="75002"
                        required
                    >
                </div>

                <div class="form-row">
                    <label for="country">Pays</label>
                    <input
                        type="text"
                        id="country"
                        name="country"
                        value="France"
                        required
                    >
                </div>

                <div class="checkout-actions">
                    <button type="submit" class="btn-primary">
                        Valider la commande
                    </button>
                </div>

            </form>

        </div>

    </div>

</main>

</body>
</html>
