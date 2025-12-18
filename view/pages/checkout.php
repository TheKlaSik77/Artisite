<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Finaliser la commande – Arti'Site</title>
  <link rel="stylesheet" href="./assets/css/pages/checkout.css" />
</head>

<body>
  <!-- ================= CHECKOUT ================= -->
  <main class="checkout-page">
    <div class="checkout-container">

      <!-- FORMULAIRE -->
      <div class="checkout-card">
        <h1>Finaliser la commande</h1>
        <p class="muted">Renseignez vos informations pour valider votre commande.</p>

        <form class="checkout-form">

          <div class="grid">
            <div class="field">
              <label>Prénom</label>
              <input type="text" placeholder="Ex : Ahmed" required>
            </div>

            <div class="field">
              <label>Nom</label>
              <input type="text" placeholder="Ex : Ali" required>
            </div>
          </div>

          <div class="field">
            <label>Email</label>
            <input type="email" placeholder="exemple@mail.com" required>
          </div>

          <div class="field">
            <label>Adresse</label>
            <input type="text" placeholder="Rue, numéro..." required>
          </div>

          <div class="grid">
            <div class="field">
              <label>Code postal</label>
              <input type="text" placeholder="75000" required>
            </div>

            <div class="field">
              <label>Ville</label>
              <input type="text" placeholder="Paris" required>
            </div>
          </div>

          <div class="actions">
            <a href="cart.html" class="btn-outline">← Retour au panier</a>
            <button type="submit" class="btn-primary">Payer et confirmer</button>
          </div>

        </form>
      </div>

      <!-- RÉSUMÉ -->
      <aside class="checkout-summary">
        <h2>Résumé</h2>

        <div class="sum-row"><span>Sous-total</span><span>77,00 €</span></div>
        <div class="sum-row"><span>Livraison</span><span>5,90 €</span></div>
        <div class="sum-divider"></div>
        <div class="sum-row total"><span>Total</span><span>82,90 €</span></div>

        <p class="small-note">
          En cliquant sur “Payer et confirmer”, vous acceptez nos conditions.
        </p>
      </aside>

    </div>
  </main>

  <!-- ================= JS REDIRECTION ================= -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const form = document.querySelector(".checkout-form");

      form.addEventListener("submit", (e) => {
        e.preventDefault(); // empêche rechargement
        window.location.href = "./order-success.html";
      });
    });
  </script>

</body>

</html>