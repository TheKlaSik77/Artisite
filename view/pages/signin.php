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

            <form method="POST" action="/artisite/model/requests.signin.php">
                <label>Adresse email</label>
                <div class="input-group">
                    <span class="icon">📧</span>
                    <input type="email" name="email" placeholder="Votre@email.fr" required>
                </div>

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

            <div class="social-buttons">
                <button class="google">Google</button>
                <button class="facebook">Facebook</button>
            </div>
        </div>
    </main>
</body>

</html>