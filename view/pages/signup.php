<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="./assets/css/pages/signup.css">
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
            <form method="POST" action="index.php?page=signup&action=add&type=user" class="form-visible"
                id="customerForm">

                <label>Nom d'utilisateur</label>
                <div class="input-group">
                    <span class="icon">📧</span>
                    <input type="text" name="username" placeholder="" required>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Prénom</label>
                        <input class="input-simple" type="text" name="first_name" placeholder="Jean" required>
                    </div>

                    <div class="col">
                        <label>Nom</label>
                        <input class="input-simple" type="text" name="last_name" placeholder="Dupont" required>
                    </div>
                </div>

                <label>Adresse email</label>
                <div class="input-group">
                    <span class="icon">📧</span>
                    <input type="email" name="email" placeholder="votre@email.fr" required>
                </div>
                <label>Telephone</label>
                <div class="input-group">
                    <span class="icon">📧</span>
                    <input type="text" name="phone_number" placeholder="" required>
                </div>

                <label>Mot de passe</label>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" name="password" value="" required>
                    <span class="icon eye">👁️</span>
                </div>

                <label>Confirmer le mot de passe</label>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" name="password_confirm" value="" required>
                    <span class="icon eye">👁️</span>
                </div>

                <!-- CONDITIONS -->
                <div class="checkbox">
                    <input type="checkbox" id="cgu_user" name="cgu" required>
                    <label for="cgu_user" >
                        J'accepte les
                        <a href="#">conditions générales d'utilisation</a>
                        et la
                        <a href="#">politique de confidentialité</a>
                    </label>
                </div>

                <button type="submit" class="login-btn">Créer mon compte</button>

            </form>


            <!-- Formulaire Craftman -->
            <form method="POST" action="index.php?page=signup&action=add&type=craftman" class="form-hidden"
                id="craftmanForm">

                <label>Adresse email</label>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Votre@email.fr">
                </div>

                <label>Numéro SIRET (Facultatif)</label>
                <div class="input-group">
                    <input type="text" name="siret" placeholder="">
                </div>

                <label>Nom de votre entreprise (Vous pouvez aussi insérez votre Prenom-Nom)</label>
                <div class="input-group">
                    <input type="text" name="company_name" placeholder="">
                </div>

                <label>Mot de passe</label>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" name="password" value="">
                    <span class="icon eye">👁️</span>
                </div>

                <label>Confirmer le mot de passe</label>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" name="password_confirm" value="">
                    <span class="icon eye">👁️</span>
                </div>

                <label>Description de votre activité</label>
                <div class="textarea-group">
                    <textarea type="text" class="textarea-simple" name="description"> </textarea>
                </div>
                <label class="description-warning">(Cette description sera utilisée pour votre profil, soyez donc le
                    plus clair possible sur votre activité)</label>

                <div class="checkbox">
                    <input type="checkbox" id="cgu_craftman" name="cgu" required>
                    <label for="cgu_craftman" >
                        J'accepte les
                        <a href="#">conditions générales d'utilisation</a>
                        et la
                        <a href="#">politique de confidentialité</a>
                    </label>
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