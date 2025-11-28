<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-card">
            <p class="subtitle">BON RETOUR</p>
            <h1>Connexion</h1>
            <p class="description">Accédez à votre espace personnel</p>

            <form>
                <label>Adresse email</label>
                <div class="input-group">
                    <span class="icon">📧</span>
                    <input type="email" placeholder="votre@email.fr">
                </div>

                <label>Mot de passe</label>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" value="">
                    <span class="icon eye">👁️</span>
                </div>

                <div class="options">
                    <label><input type="checkbox"> Se souvenir de moi</label>
                    <a href="#" class="forgot">Mot de passe oublié ?</a>
                </div>

                <button class="login-btn">Se connecter</button>
            </form>

            <p class="signup-text">
                Vous n'avez pas de compte ? <a href="inscription.html" class="signup">S’inscrire</a>
            </p>

            <div class="divider"></div>

            <p class="continue">Ou continuer avec</p>

            <div class="social-buttons">
                <button class="google">Google</button>
                <button class="facebook">Facebook</button>
            </div>
        </div>
    </div>
</body>
</html>
