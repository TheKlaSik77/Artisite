<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil – Arti'Site</title>
    <link rel="stylesheet" href="./assets/css/pages/profil.css" />
</head>

<body>
    <main>
        <section class="profile-container">
            <div class="profile-card">
                <!-- Photo de profil -->
                <div class="profile-photo">
                    <img src="https://picsum.photos/300/300" alt="Photo de profil" />
                    <button class="change-photo-btn">Changer la photo</button>
                </div>

                <!-- Informations utilisateur -->
                <h2 class="profile-name">Nom Prénom</h2>
                <p class="profile-email">email@exemple.com</p>

                <div class="profile-info">
                    <div class="info-block">
                        <span class="label">Téléphone :</span>
                        <span class="value">06 00 00 00 00</span>
                    </div>

                    <div class="info-block">
                        <span class="label">Adresse :</span>
                        <span class="value">12 Rue de Paris, France</span>
                    </div>

                    <div class="info-block">
                        <span class="label">Date de création du compte :</span>
                        <span class="value">14 janvier 2025</span>
                    </div>
                </div>

                <!-- Boutons de gestion -->
                <div class="profile-actions">
                    <button class="btn-primary">Modifier le profil</button>
                    <button class="btn-secondary">
                        Changer le mot de passe
                    </button>
                    <button class="btn-danger">Supprimer mon compte</button>
                </div>
            </div>
        </section>
    </main>
</body>

</html>