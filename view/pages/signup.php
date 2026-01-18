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

            <form method="POST" action="index.php?page=signup&action=add&type=user" class="form-visible"
                id="customerForm">

                <?php if (!empty($_SESSION['signup_error'])): ?>
                    <p class="form-error-text">
                        <?= htmlspecialchars($_SESSION['signup_error'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <?php unset($_SESSION['signup_error']); ?>
                <?php endif; ?>

                <label>Pseudo</label>
                <div class="input-group">
                    <span class="icon">📧</span>
                    <input type="text" id="username" name="username" placeholder="" required>
                </div>
                <small id="username-msg" class="field-msg"></small>

                <div class="row">
                    <div class="col">
                        <label>Prénom</label>
                        <input class="input-simple" type="text" id="first_name" name="first_name" placeholder="Jean"
                            required>
                        <small id="first_name-msg" class="field-msg"></small>
                    </div>

                    <div class="col">
                        <label>Nom</label>
                        <input class="input-simple" type="text" id="last_name" name="last_name" placeholder="Dupont"
                            required>
                        <small id="last_name-msg" class="field-msg"></small>
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
                    <input type="password" id="password" name="password" value="" required>
                    <span class="icon eye">👁️</span>
                </div>

                <label>Confirmer le mot de passe</label>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" id="password_confirm" name="password_confirm" value="" required>
                    <span class="icon eye">👁️</span>
                </div>
                <small id="password_confirm-msg" class="field-msg"></small>

                <!-- CONDITIONS -->
                <div class="checkbox">
                    <input type="checkbox" id="cgu_user" name="cgu" required>
                    <label for="cgu_user">
                        J'accepte les
                        <a href="#">conditions générales d'utilisation</a>
                        et la
                        <a href="#">politique de confidentialité</a>
                    </label>
                </div>

                <button type="submit" class="login-btn">Créer mon compte</button>

            </form>

            <form method="POST" action="index.php?page=signup&action=add&type=craftman" class="form-hidden"
                id="craftmanForm">

                <?php if (!empty($_SESSION['signup_error'])): ?>
                    <p class="form-error-text">
                        <?= htmlspecialchars($_SESSION['signup_error'], ENT_QUOTES, 'UTF-8') ?>
                    </p>
                    <?php unset($_SESSION['signup_error']); ?>
                <?php endif; ?>

                <label>Adresse email</label>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Votre@email.fr">
                </div>

                <label>Numéro SIRET (Facultatif)</label>
                <div class="input-group">
                    <input type="text" id="siret" name="siret" placeholder="" required>
                </div>
                <small id="siret-msg" class="field-msg"></small>

                <label>Nom de votre entreprise (Vous pouvez aussi insérez votre Prenom-Nom)</label>
                <div class="input-group">
                    <input type="text" id="company_name" name="company_name" placeholder="" required>
                </div>
                <small id="company_name-msg" class="field-msg"></small>

                <label>Mot de passe</label>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" id="password_craft" name="password" value="" required>
                    <span class="icon eye">👁️</span>
                </div>

                <label>Confirmer le mot de passe</label>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" id="password_confirm_craft" name="password_confirm" value="" required>
                    <span class="icon eye">👁️</span>
                </div>
                <small id="password_confirm_craft-msg" class="field-msg"></small>

                <label>Description de votre activité</label>
                <div class="textarea-group">
                    <textarea class="textarea-simple" id="description" name="description" required></textarea>
                </div>
                <small id="description-msg" class="field-msg"></small>

                <label class="description-warning">(Cette description sera utilisée pour votre profil, soyez
                    donc le plus clair possible sur votre activité)</label>

                <div class="checkbox">
                    <input type="checkbox" id="cgu_craftman" name="cgu" required>
                    <label for="cgu_craftman">
                        J'accepte les
                        <a href="#">conditions générales d'utilisation</a>
                        et la
                        <a href="#">politique de confidentialité</a>
                    </label>
                </div>

                <button type="submit" class="login-btn">Créer mon compte</button>
            </form>

            <p class="signup-text">
                Vous avez déjà un compte ?
                <a href="login.html" class="signup">Se connecter</a>
            </p>
        </div>
    </main>

    <script src="./assets/js/signup/switch_craftman_user_signup.js"></script>
    <script src="./assets/js/signup/ajax_verif.js"></script>
    <script src="./assets/js/signup/form_validation.js"></script>

</body>

</html>