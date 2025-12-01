<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Contact - [Nom du site]</title>
    <link rel="stylesheet" href="./assets/css/pages/contact.css">
</head>

<body>
    <main>
        <section class="contact-section" id="contact">
            <div class="contact-inner">

                <form class="contact-form" id="contactForm">
                    <div class="header-form">
                        <h1 class="contact-title">Contactez-nous</h1>
                        <p class="contact-subtitle">
                            Une question à propos d’un artisan, d’un produit ou du fonctionnement de la plateforme ?
                            Écrivez-nous via ce formulaire.
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" id="name" name="name" placeholder="Votre nom" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" id="email" name="email" placeholder="exemple@mail.com" required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Sujet</label>
                        <input type="text" id="subject" name="subject" placeholder="Ex : Problème avec une commande"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="message">Votre message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Expliquez votre demande..."
                            required></textarea>
                    </div>

                    <button type="submit" class="contact-btn">Envoyer</button>

                    <p class="contact-feedback" id="contactFeedback" aria-live="polite"></p>
                </form>
            </div>
        </section>
    </main>

</body>

</html>