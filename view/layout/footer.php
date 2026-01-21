<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accueil – Arti'Site</title>
    <link rel="stylesheet" href="./assets/css/layout/footer.css" />
</head>


<footer class="footer">
    <div class="footer-container">

        <div class="footer-col">
            <div class="footer-logo">
                <img src="./assets/img/logo_fond_sombre.png" alt="Logo Arti'Site" class="footer-logo-img" />
            </div>
        </div>

        <div class="footer-col">
            <h3 class="footer-title">Liens Rapides</h3>

            <ul class="footer-links">
                <li><a href="index.php?page=homepage">Accueil</a></li>
                <li><a href="index.php?page=craftmen">Nos Artisans</a></li>
                <li><a href="index.php?page=products">Nos Produits</a></li>
                <?php if (isUser()): ?>
                    <li><a href="#">Devenir Artisan</a></li>
                <?php endif; ?>
                <?php if (isUser() || isCraftman()): ?>
                    <?php if (isCraftman()): ?>
                        <li><a href="index.php?page=craftman-support">Support</a></li>
                    <?php else: ?>
                        <li><a href="index.php?page=support">Support</a></li>
                    <?php endif; ?>
                    <li><a href="index.php?page=faq">FAQ</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="footer-col">
            <h3 class="footer-title">Contact</h3>

            <ul class="footer-contact">
                <li><span class="contact-icon">✉️</span>
                    <div>
                        <p class="contact-label">Email</p>
                        <p>contact@artisite.fr</p>
                    </div>
                </li>

                <li><span class="contact-icon">📞</span>
                    <div>
                        <p class="contact-label">Téléphone</p>
                        <p>+33 1 23 45 67 89</p>
                    </div>
                </li>

                <li><span class="contact-icon">📍</span>
                    <div>
                        <p class="contact-label">Adresse</p>
                        <p>Paris, France</p>
                    </div>
                </li>
            </ul>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2025 Arti’site — Tous droits réservés.</p>
    </div>
</footer>