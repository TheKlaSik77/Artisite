<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="./assets/css/pages/signin_signup.css">
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
                <div class="account-option selected" id="clientBtn" onclick="selectType('client')">
                    <div class="icon">👤</div>
                    <h3>Client</h3>
                    <p>Découvrir et acheter</p>
                    <span class="circle active"></span>
                </div>

                <div class="account-option" id="artisanBtn" onclick="selectType('artisan')">
                    <div class="icon">🎁</div>
                    <h3>Artisan</h3>
                    <p>Vendre mes créations</p>
                    <span class="circle"></span>
                </div>
            </div>

            <!-- FORMULAIRE -->
            <form name="myForm">

                <div class="row">
                    <div class="col">
                        <label>Prénom</label>
                        <input class="input-simple" type="text" placeholder="Jean">
                    </div>

                    <div class="col">
                        <label>Nom</label>
                        <input class="input-simple" type="text" placeholder="Dupont">
                    </div>
                </div>

                <label>Adresse email</label>
                <div class="input-group">
                    <span class="icon">📧</span>
                    <input type="email" name="EMail" placeholder="votre@email.fr">
                </div>

                <!-- Champ métier (affiché seulement si Artisan est sélectionné) -->
                <div id="metierField" style="display:none;">
                    <label>Votre métier</label>
                    <div class="input-group">
                        <span class="icon">🧰</span>
                        <input type="text" placeholder="ex: Céramiste, Ébéniste...">
                    </div>
                </div>

                <label>Mot de passe</label>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" value="">
                    <span class="icon eye">👁️</span>
                </div>

                <label>Confirmer le mot de passe</label>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" value="">
                    <span class="icon eye">👁️</span>
                </div>

                <!-- CONDITIONS -->
                <div class="checkbox-row">
                    <input type="checkbox">
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
    </main>
</body>

</html>