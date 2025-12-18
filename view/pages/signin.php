<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="./assets/css/pages/signin_signup.css">
</head>

<body>
  <main>
    <div class="login-card">
      <p class="subtitle">BON RETOUR</p>
      <h1>Connexion</h1>
      <p class="description">Accédez à votre espace personnel</p>

      <!-- TYPE DE COMPTE (same as signup) -->
      <label>Type de compte</label>
      <div class="account-types">
        <div class="account-option selected" id="customerBtn" role="button" tabindex="0">
          <div class="icon">👤</div>
          <h3>Client</h3>
          <p>Accéder à mon compte</p>
          <span class="circle active"></span>
        </div>

        <div class="account-option" id="craftmanBtn" role="button" tabindex="0">
          <div class="icon">🎁</div>
          <h3>Artisan</h3>
          <p>Accéder à mon espace</p>
          <span class="circle"></span>
        </div>
      </div>

      <form method="POST" action="/artisite/model/requests.signin.php" id="signinForm">
        <!-- will be used by backend -->
        <input type="hidden" name="account_type" id="accountType" value="customer">

        <!-- CUSTOMER fields -->
        <div id="customerFields">
          <label>Adresse email</label>
          <div class="input-group">
            <span class="icon">📧</span>
            <input type="email" name="email" placeholder="Votre@email.fr">
          </div>
        </div>

        <!-- CRAFTMAN fields -->
        <div id="craftmanFields" style="display:none;">
          <label>Numéro SIRET</label>
          <div class="input-group">
            <span class="icon">🏷️</span>
            <input type="text" name="siret" placeholder="SIRET">
          </div>
        </div>

        <!-- COMMON field -->
        <label>Mot de passe</label>
        <div class="input-group">
          <span class="icon">🔒</span>
          <input type="password" name="password" required>
          <span class="icon eye">👁️</span>
        </div>

        <div class="options">
          <label><input type="checkbox" name="remember_me" value="1"> Se souvenir de moi</label>
          <a href="#" class="forgot">Mot de passe oublié ?</a>
        </div>

        <button type="submit" class="login-btn">Se connecter</button>
      </form>

      <p class="signup-text">
        Vous n'avez pas de compte ? <a href="index.php?page=signup" class="signup">S’inscrire</a>
      </p>

      <div class="divider"></div>
      <p class="continue">Ou continuer avec</p>


    </div>

    <script src="./assets/js/signin/switch_craftman_user_signin.js"></script>
  </main>
</body>

</html>
