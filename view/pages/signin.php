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
                    <input type="email" name="email" placeholder="Votre@email.fr">
                </div>
                <div class="divider"></div>
                
                <label>Ou SIRET (Si vous êtes un artisan)</label>
                <div class="input-group">
                    <span class="icon"></span>
                    <input type="text" name="siret" placeholder="SIRET">
                </div>

                <label>Mot de passe</label>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" name="password" value="" required>
                    <span class="icon eye">👁️</span>
                </div>

                <div class="options">
                    <label><input type="checkbox"> Se souvenir de moi</label>
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