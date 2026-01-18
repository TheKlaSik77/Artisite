<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon profil - Arti'Site</title>

    <!-- ✅ CORRECT CSS PATH -->
    <link rel="stylesheet" href="/Artisite/assets/css/pages/profil.css">
</head>

<body>

<div class="profile-container">
    <div class="profile-card">

        <h1>Mon profil</h1>

        <!-- Photo + upload -->
        <div class="profile-photo">
            <div class="profile-avatar">
                <img src="<?= htmlspecialchars($profileImageUrl) ?>" alt="Photo de profil">
            </div>

            <form method="POST"
                  action="index.php?page=profil&action=upload-image"
                  enctype="multipart/form-data"
                  class="upload-form">

                <!-- Native file input completely hidden -->
                <input
                    type="file"
                    id="profile_image"
                    name="profile_image"
                    accept="image/jpeg,image/png,image/webp"
                    required
                    style="display:none"
                >

                <!-- Same size buttons -->
                <label for="profile_image" class="btn-primary btn-upload">
                    Choisir une image
                </label>

                <button type="submit" class="btn-primary btn-upload">
                    Enregistrer
                </button>
            </form>
        </div>

        <?php if (function_exists('isCraftman') && isCraftman()): ?>

            <div class="profile-name">
                <?= htmlspecialchars($profile['company_name'] ?? '') ?>
            </div>
            <div class="profile-email">Artisan</div>

            <div class="profile-info">
                <div class="info-block">
                    <div class="label">SIRET</div>
                    <div class="value"><?= htmlspecialchars($profile['siret'] ?? '') ?></div>
                </div>
                <div class="info-block">
                    <div class="label">Description</div>
                    <div class="value"><?= htmlspecialchars($profile['description'] ?? '') ?></div>
                </div>
            </div>

            <div class="profile-actions">
                <a class="btn-secondary" href="index.php?page=craftman-products">Gérer mes produits</a>
                <a class="btn-danger" href="index.php?page=logout">Se déconnecter</a>
            </div>

        <?php else: ?>

            <div class="profile-name">
                <?= htmlspecialchars(($profile['first_name'] ?? '') . ' ' . ($profile['last_name'] ?? '')) ?>
            </div>
            <div class="profile-email">
                <?= htmlspecialchars($profile['email'] ?? '') ?>
            </div>

            <div class="profile-info">
                <div class="info-block">
                    <div class="label">Username</div>
                    <div class="value"><?= htmlspecialchars($profile['username'] ?? '') ?></div>
                </div>
                <div class="info-block">
                    <div class="label">Téléphone</div>
                    <div class="value"><?= htmlspecialchars($profile['phone_number'] ?? '') ?></div>
                </div>
                <div class="info-block">
                    <div class="label">Description</div>
                    <div class="value"><?= htmlspecialchars($profile['description'] ?? '') ?></div>
                </div>
            </div>

            <div class="profile-actions">
                <a class="btn-secondary" href="index.php?page=cart">Voir mon panier</a>
                <a class="btn-danger" href="index.php?page=logout">Se déconnecter</a>
            </div>

        <?php endif; ?>

    </div>
</div>

</body>
</html>
