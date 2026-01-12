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

            <form method="POST" action="index.php?page=signin&action=login">
                <label>Adresse email</label>
                <div class="input-group">
                    <span class="icon">📧</span>
                    <input type="email" name="email" placeholder="Votre@email.fr" required>
                </div>

                <div class="checkbox">
                    <input type="checkbox" id="is_craftman" name="is_craftman" value="1">
                    <label for="is_craftman">Je suis un artisan</label>
                </div>

                <label>Mot de passe</label>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" name="password" value="" required>
                    <span class="icon eye">👁️</span>
                </div>


                <div class="options">
                    <div class="checkbox">
                        <label><input type="checkbox"> Se souvenir de moi</label>
                    </div>
                    <a href="#" class="forgot">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="login-btn">Se connecter</button>
            </form>

            <p class="signup-text">
                Vous n'avez pas de compte ? <a href="index.php?page=signup" class="signup">S’inscrire</a>
            </p>

        </div>
    </main>
</body>

</html>