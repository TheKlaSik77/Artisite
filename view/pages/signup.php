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

            <form method="POST" action="index.php?page=signup&action=add&type=user" class="form-visible" id="customerForm">

                <label>Pseudo</label>
                <div class="input-group">
                    <span class="icon">📧</span>
                    <input type="text" id="username" name="username" placeholder="" required>
                </div>
                <small id="username-msg" class="field-msg"></small>

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
                    <input type="email" id="email" name="email" placeholder="votre@email.fr" required>
                </div>
                <small id="email-msg" class="field-msg"></small>

                <label>Telephone</label>
                <div class="input-group">
                    <span class="icon">📧</span>
                    <input type="text" id="phone_number" name="phone_number" placeholder="" required>
                </div>
                <small id="phone_number-msg" class="field-msg"></small>

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

                <div class="checkbox-row">
                    <input type="checkbox" required>
                    <p>
                        J'accepte les
                        <a href="#">conditions générales d'utilisation</a>
                        et la
                        <a href="#">politique de confidentialité</a>
                    </p>
                </div>

                <button type="submit" class="login-btn">Créer mon compte</button>

            </form>

            <form method="POST" action="index.php?page=signup&action=add&type=craftman" class="form-hidden" id="craftmanForm">
                <label>Numéro SIRET (Celui-ci vous servira à vous connecter)</label>
                <div class="input-group">
                    <input type="text" id="siret" name="siret" placeholder="">
                </div>
                <small id="siret-msg" class="field-msg"></small>

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
                <label class="description-warning">(Cette description sera utilisée pour votre profil, soyez donc le plus clair possible sur votre activité)</label>
                <div class="checkbox-row">
                    <input type="checkbox" required>
                    <p>
                        J'accepte les
                        <a href="#">conditions générales d'utilisation</a>
                        et la
                        <a href="#">politique de confidentialité</a>
                    </p>
                </div>

                <button type="submit" class="login-btn">Créer mon compte</button>
            </form>

            <p class="signup-text">
                Vous avez déjà un compte ?
                <a href="login.html" class="signup">Se connecter</a>
            </p>

        </div>

        <script src="./assets/js/signup/switch_craftman_user_signup.js"></script>
        <script src="./assets/js/signup/ajax_verif.js"></script>
    </main>
</body>

</html>
