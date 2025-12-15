<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bol en céramique - Artisite</title>
    <link rel="stylesheet" href="../../assets/css/pages/product1.css">
</head>
<body>

    <!-- TODO : ta navbar ici (même que sur les autres pages) -->

    <main class="product-page">

        <!-- ================== HEADER CHEMIN ================== -->
        <div class="breadcrumb">
            <a href="index.html">Accueil</a> /
            <a href="produit.html">Produits</a> /
            <span>Bol en céramique</span>
        </div>

        <!-- ================== BLOC PRODUIT ================== -->
        <section class="product-hero">

            <!-- Colonne image(s) -->
            <div class="product-gallery">
                <div class="product-main-image">
                    <img src="https://picsum.photos/200/300" alt="Bol en céramique">
                </div>
                <div class="product-thumbs">
                    <button class="thumb thumb-active">
                        <img src="https://picsum.photos/200/300" alt="Vue 1 bol en céramique">
                    </button>
                    <button class="thumb">
                        <img src="https://picsum.photos/200/300" alt="Vue 2 bol en céramique">
                    </button>
                    <button class="thumb">
                        <img src="https://picsum.photos/200/300" alt="Vue 3 bol en céramique">
                    </button>
                </div>
            </div>

            <!-- Colonne infos produit -->
            <div class="product-info">

                <p class="product-category">Poterie · Céramique</p>
                <h1 class="product-title">Bol en céramique</h1>

                <div class="product-artisan">
                    Par <span>Sophie Martin</span>
                </div>

                <div class="product-rating">
                    <span class="stars">★★★★★</span>
                    <span class="rating-text">4.8 · 24 avis</span>
                </div>

                <p class="product-price">29€</p>

                <p class="product-short-desc">
                    Bol en céramique façonné à la main, émaillé avec une finition satinée.
                    Idéal pour vos petits-déjeuners, soupes ou desserts.
                </p>

                <ul class="product-details">
                    <li><span>Matière</span><span>Céramique émaillée</span></li>
                    <li><span>Diamètre</span><span>14 cm</span></li>
                    <li><span>Hauteur</span><span>7 cm</span></li>
                    <li><span>Couleur</span><span>Blanc cassé / Beige</span></li>
                    <li><span>Stock</span><span>En stock (7 pièces)</span></li>
                    <li><span>Fabrication</span><span>Pièce faite main, légère variation possible</span></li>
                </ul>

                <div class="product-actions">
                    <div class="quantity">
                        <label for="qty">Quantité</label>
                        <div class="quantity-input">
                            <button type="button">-</button>
                            <input id="qty" type="number" min="1" value="1">
                            <button type="button">+</button>
                        </div>
                    </div>

                    <button class="btn-primary">Ajouter au panier</button>
                    <button class="btn-secondary">♡ Ajouter aux favoris</button>
                </div>

                <div class="product-extra">
                    <p>🚚 Livraison estimée : 3 à 5 jours ouvrés</p>
                    <p>🔄 Retours possibles sous 14 jours (hors personnalisation).</p>
                </div>
            </div>
        </section>

        <!-- ================== DESCRIPTION DÉTAILLÉE ================== -->
        <section class="product-description">
            <h2>Description détaillée</h2>
            <p>
                Chaque bol est tourné à la main dans l’atelier de Sophie, puis émaillé et cuit à haute
                température. Cette méthode permet d’obtenir une pièce résistante, adaptée au contact alimentaire
                et au quotidien.
            </p>
            <p>
                Les légères différences de forme ou de couleur font partie du charme de l’artisanat :
                vous recevez un objet réellement unique.
            </p>

            <ul>
                <li>Passe au lave-vaisselle (programme délicat recommandé).</li>
                <li>Compatible micro-ondes.</li>
                <li>Éviter les chocs thermiques trop brutaux.</li>
            </ul>
        </section>

        <!-- ================== AVIS CLIENTS ================== -->
        <section class="reviews-section" id="avis">
            <div class="reviews-header">
                <h2>Avis clients</h2>
                <div class="reviews-summary">
                    <div class="summary-main">
                        <span class="summary-note">4.8</span>
                        <span class="summary-stars">★★★★★</span>
                    </div>
                    <p class="summary-text">Basé sur 24 avis</p>
                </div>
            </div>

            <!-- Liste des avis -->
            <div class="reviews-list">
                <article class="review-card">
                    <header class="review-header">
                        <div>
                            <p class="review-author">Camille</p>
                            <p class="review-date">Publié le 12 nov. 2025</p>
                        </div>
                        <span class="review-stars">★★★★★</span>
                    </header>
                    <p class="review-text">
                        Très joli bol, conforme aux photos. La taille est parfaite pour le petit-déjeuner.
                        Envoi soigné et rapide, merci !
                    </p>
                </article>

                <article class="review-card">
                    <header class="review-header">
                        <div>
                            <p class="review-author">Julien</p>
                            <p class="review-date">Publié le 3 nov. 2025</p>
                        </div>
                        <span class="review-stars">★★★★☆</span>
                    </header>
                    <p class="review-text">
                        Belle qualité, on sent le travail artisanal. La couleur est un peu plus claire
                        que sur les photos, mais ça reste très joli.
                    </p>
                </article>
            </div>

            <!-- Formulaire pour laisser un avis -->
            <div class="review-form-card">
                <h3>Laisser un avis</h3>
                <form class="review-form">
                    <div class="form-row">
                        <div class="form-field">
                            <label for="reviewName">Votre prénom</label>
                            <input type="text" id="reviewName" name="name" placeholder="Ex : Camille" required>
                        </div>
                        <div class="form-field">
                            <label for="reviewRating">Note</label>
                            <select id="reviewRating" name="rating" required>
                                <option value="">Choisissez…</option>
                                <option value="5">5 - Excellent</option>
                                <option value="4">4 - Très bien</option>
                                <option value="3">3 - Correct</option>
                                <option value="2">2 - Moyen</option>
                                <option value="1">1 - Déçu(e)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="reviewText">Votre avis</label>
                        <textarea id="reviewText" name="message" rows="4"
                                  placeholder="Parlez de la qualité, de l’emballage, de la livraison…"
                                  required></textarea>
                    </div>

                    <button type="submit" class="btn-primary">
                        Envoyer mon avis
                    </button>

                    <p class="review-feedback" aria-live="polite"></p>
                </form>
            </div>
        </section>

    </main>

    <!-- Petit JS facultatif juste pour afficher un message de confirmation -->
    <script>
        const reviewForm = document.querySelector(".review-form");
        const reviewFeedback = document.querySelector(".review-feedback");

        reviewForm.addEventListener("submit", function (e) {
            e.preventDefault();
            reviewFeedback.textContent = "Merci pour votre avis ! Il sera publié après validation.";
            reviewForm.reset();
        });
    </script>

</body>
</html>
