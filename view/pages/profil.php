<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon profil - Arti'Site</title>
    <link rel="stylesheet" href="./assets/css/pages/profil.css">
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

                <form method="POST" action="index.php?page=profil&action=upload-image" enctype="multipart/form-data"
                    class="upload-form">

                    <input type="file" id="profile_image" name="profile_image"
                        accept="image/jpg,image/jpeg,image/png,image/webp" required style="display:none">

                    <label for="profile_image" class="btn-primary btn-upload">
                        Choisir une image
                    </label>

                    <button type="submit" class="btn-primary btn-upload">
                        Enregistrer
                    </button>
                </form>
            </div>

            <?php if (function_exists('isCraftman') && isCraftman()): ?>

                <div class="profile-name"><?= htmlspecialchars($profile['company_name'] ?? '') ?></div>
                <div class="profile-email">Artisan</div>

                <!-- ✅ 1 seul form, affichage texte par défaut -->
                <form method="POST" action="index.php?page=profil&action=update-info" class="profile-edit-form"
                    data-profile-form>

                    <div class="profile-info">

                        <div class="info-block">
                            <div class="label">Entreprise</div>
                            <div class="value">
                                <span class="value-text"><?= htmlspecialchars($profile['company_name'] ?? '') ?></span>
                                <input class="value-input" type="text" name="company_name"
                                    value="<?= htmlspecialchars($profile['company_name'] ?? '', ENT_QUOTES) ?>" disabled>
                            </div>
                        </div>

                        <div class="info-block">
                            <div class="label">SIRET</div>
                            <div class="value">
                                <span class="value-text"><?= htmlspecialchars($profile['siret'] ?? '') ?></span>
                                <input class="value-input" type="text" name="siret"
                                    value="<?= htmlspecialchars($profile['siret'] ?? '', ENT_QUOTES) ?>" disabled>
                            </div>
                        </div>

                        <div class="info-block">
                            <div class="label">Description</div>
                            <div class="value">
                                <span class="value-text"><?= htmlspecialchars($profile['description'] ?? '') ?></span>
                                <textarea class="value-textarea" name="description" rows="4"
                                    disabled><?= htmlspecialchars($profile['description'] ?? '') ?></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="profile-actions">
                        <!-- ✅ IMPORTANT: buttons with data-action (no duplicate ids) -->
                        <button type="button" class="btn-secondary" data-action="edit">
                            Modifier mes informations
                        </button>

                        <button type="button" class="btn-secondary" data-action="cancel" style="display:none;">
                            Annuler
                        </button>

                        <button type="submit" class="btn-primary btn-upload" data-action="save" style="display:none;">
                            Enregistrer mes informations
                        </button>

                        <a class="btn-secondary" href="index.php?page=craftman-products">Gérer mes produits</a>
                        <a class="btn-danger" href="index.php?page=logout">Se déconnecter</a>
                    </div>
                </form>

            <?php else: ?>

                <div class="profile-name">
                    <?= htmlspecialchars(($profile['first_name'] ?? '') . ' ' . ($profile['last_name'] ?? '')) ?>
                </div>
                <div class="profile-email"><?= htmlspecialchars($profile['email'] ?? '') ?></div>

                <form method="POST" action="index.php?page=profil&action=update-info" class="profile-edit-form"
                    data-profile-form>

                    <div class="profile-info">

                        <div class="info-block">
                            <div class="label">Username</div>
                            <div class="value">
                                <span class="value-text"><?= htmlspecialchars($profile['username'] ?? '') ?></span>
                                <input class="value-input" type="text" name="username"
                                    value="<?= htmlspecialchars($profile['username'] ?? '', ENT_QUOTES) ?>" disabled>
                            </div>
                        </div>

                        <div class="info-block">
                            <div class="label">Téléphone</div>
                            <div class="value">
                                <span class="value-text"><?= htmlspecialchars($profile['phone_number'] ?? '') ?></span>
                                <input class="value-input" type="text" name="phone_number"
                                    value="<?= htmlspecialchars($profile['phone_number'] ?? '', ENT_QUOTES) ?>" disabled>
                            </div>
                        </div>

                    </div>

                    <div class="profile-actions">
                        <button type="button" class="btn-secondary" data-action="edit">
                            Modifier mes informations
                        </button>

                        <button type="button" class="btn-secondary" data-action="cancel" style="display:none;">
                            Annuler
                        </button>

                        <button type="submit" class="btn-primary btn-upload" data-action="save" style="display:none;">
                            Enregistrer mes informations
                        </button>

                        <a class="btn-secondary" href="index.php?page=cart">Voir mon panier</a>
                        <a class="btn-danger" href="index.php?page=logout">Se déconnecter</a>
                    </div>
                </form>

            <?php endif; ?>

        </div>
    </div>

    <script src="./assets/js/profil/profile-image-preview.js"></script>
    <script src="./assets/js/profil/profilModification.js"></script>
</body>

</html>