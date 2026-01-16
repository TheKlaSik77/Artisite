<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Commande confirmée – Arti'Site</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/pages/order-success.css">
</head>

<body>
  <main class="success-page">
    <div class="success-card">

      <div class="success-icon">✅</div>

      <h1>Votre commande est finalisée</h1>

      <p class="success-text">
        Merci pour votre achat sur <strong>Arti'Site</strong>.<br>
        Votre commande a bien été enregistrée et sera préparée par l’artisan.
      </p>

      <!-- ✅ Numéro de commande -->
      <div class="order-number">
        <span>Numéro de commande</span>
        <strong id="orderNumber">#<?= $_SESSION['last_order_id'] ?? '—' ?></strong>
      </div>

      <p class="success-subtext">
        📦 Vous recevrez votre commande très prochainement.<br>
        📧 Un email de confirmation vous sera envoyé.
      </p>

      <div class="success-actions">
        <a href="index.php?page=homepage" class="btn-primary">
          Retour à l’accueil
        </a>
        <a href="index.php?page=products" class="btn-outline">
          Continuer mes achats
        </a>
      </div>

    </div>
  </main>

  <script>
    // Nettoyer l'ID de commande de la session après affichage
    <?php unset($_SESSION['last_order_id']); ?>
  </script>

</body>

</html>