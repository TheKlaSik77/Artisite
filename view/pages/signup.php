<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inscription</title>
  <link rel="stylesheet" href="./assets/css/pages/signup.css" />
</head>

<body>
  <main>
    <div class="login-card">
      <p class="subtitle">REJOIGNEZ-NOUS</p>
      <h1>Inscription</h1>
      <p class="description">Créez votre compte et découvrez nos artisans</p>

      <!-- TYPE DE COMPTE -->
      <label>Type de compte</label>
      <div class="account-types">
        <div class="account-option selected" id="customerBtn">
          <div class="icon">👤</div>
          <h3>Client</h3>
          <p>Découvrir et acheter</p>
          <span class="circle active"></span>
        </div>

        <div class="account-option" id="craftmanBtn">
          <div class="icon">🎁</div>
          <h3>Artisan</h3>
          <p>Vendre mes créations</p>
          <span class="circle"></span>
        </div>
      </div>

      <!-- FORMULAIRE Customer -->
      <form class="form-visible" id="customerForm" method="POST" action="/artisite/model/requests.signup.php">
        <input type="hidden" name="account_type" value="customer" />

        <div class="row">
          <div class="col">
            <label>Prénom</label>
            <input class="input-simple" name="first_name" type="text" placeholder="Jean" required />
          </div>

          <div class="col">
            <label>Nom</label>
            <input class="input-simple" name="last_name" type="text" placeholder="Dupont" required />
          </div>
        </div>

        <div class="row">
          <div class="col">
            <label>Nom d'utilisateur</label>
            <input class="input-simple" name="username" type="text" placeholder="JeanD1956" required />
          </div>

          <div class="col">
            <label>Numéro de téléphone</label>
            <input class="input-simple" name="phone_number" type="text" placeholder="06 55 52 52 52" required />
          </div>
        </div>

        <label>Adresse email</label>
        <div class="input-group">
          <span class="icon">📧</span>
          <input type="email" name="email" placeholder="votre@email.fr" required />
        </div>

        <label>Mot de passe</label>
        <div class="input-group">
          <span class="icon">🔒</span>
          <input type="password" name="password" required />
          <span class="icon eye">👁️</span>
        </div>

        <label>Confirmer le mot de passe</label>
        <div class="input-group">
          <span class="icon">🔒</span>
          <input type="password" name="password_confirm" required />
          <span class="icon eye">👁️</span>
        </div>

        <!-- CONDITIONS -->
        <div class="checkbox-row">
          <input type="checkbox" name="accepted_terms" value="1" required />
          <p>
            J'accepte les
            <a href="#">conditions générales d'utilisation</a>
            et la
            <a href="#">politique de confidentialité</a>
          </p>
        </div>

        <button type="submit" class="login-btn">Créer mon compte</button>
      </form>

      <!-- FORMULAIRE Craftman (Artisan) -->
      <form class="form-hidden" id="craftmanForm" method="POST" action="/artisite/model/requests.signup.php">
        <input type="hidden" name="account_type" value="craftman" />

        <label>Numéro SIRET</label>
        <div class="input-group">
          <input class="input-simple" type="text" name="siret" placeholder="SIRET" required />
        </div>

        <label>Nom de votre entreprise (Vous pouvez aussi insérez votre Prenom-Nom)</label>
        <div class="input-group">
          <input class="input-simple" type="text" name="company_name" placeholder="Nom de votre entreprise" required />
        </div>

        <label>Mot de passe</label>
        <div class="input-group">
          <span class="icon">🔒</span>
          <input type="password" name="password" required />
          <span class="icon eye">👁️</span>
        </div>

        <label>Confirmer le mot de passe</label>
        <div class="input-group">
          <span class="icon">🔒</span>
          <input type="password" name="password_confirm" required />
          <span class="icon eye">👁️</span>
        </div>

        <label>Description de votre activité</label>
        <div class="textarea-group">
          <textarea class="textarea-simple" name="description" placeholder="Décrivez votre activité en quelques phrases..." required></textarea>
        </div>
        <label class="description-warning">
          (Cette description sera utilisée pour la validation de votre compte par un administrateur, soyez donc le plus clair possible sur votre activité)
        </label>

        <!-- CONDITIONS -->
        <div class="checkbox-row">
          <input type="checkbox" name="accepted_terms" value="1" required />
          <p>
            J'accepte les
            <a href="#">conditions générales d'utilisation</a>
            et la
            <a href="#">politique de confidentialité</a>
          </p>
        </div>

        <button type="submit" class="login-btn">Créer mon compte</button>
      </form>

      <!-- Bouton Renvoyant sur connexion -->
      <p class="signup-text">
        Vous avez déjà un compte ?
        <a href="login.html" class="signup">Se connecter</a>
      </p>
    </div>

    <script src="./assets/js/signup/switch_craftman_user_signup.js"></script>
  </main>
</body>

</html>
