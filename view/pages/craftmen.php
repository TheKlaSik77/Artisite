<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous nos Artisans</title>

    <!-- ✅ Use absolute paths like your profile page -->
    <link rel="stylesheet" href="/Artisite/assets/css/pages/craftmen.css" />
    <link rel="stylesheet" href="/Artisite/assets/css/pages/products.css" />
</head>

<body>
<main>
    <section class="products-section">
        <h1 class="products-title">Nos Artisans</h1>
        <p class="products-subtitle">
            Découvrez le savoir-faire de nos artisans.
        </p>

        <!-- ================== FILTRES ================== -->
        <div class="filter-card">

            <div class="filter-header">
                <div>
                    <h2 class="filter-title">Rechercher et filtrer</h2>
                    <p class="filter-subtitle">Affinez par nom d'artisan ou métier.</p>
                </div>
            </div>

            <!-- Recherche texte -->
            <div class="filter-row">
                <div class="filter-input-wrapper">
                    <span class="filter-input-icon">🔍</span>
                    <input type="text" id="productSearch" class="filter-input"
                           placeholder="Rechercher par produit ou artisan..." />
                </div>
            </div>

            <!-- Catégorie -->
            <div class="filter-row">
                <p class="filter-label">Catégorie :</p>
                <div class="chip-group" id="categoryChips">
                    <button class="chip chip-active" data-category="Tous">Tous</button>
                    <button class="chip" data-category="Poterie">Poterie</button>
                    <button class="chip" data-category="Vêtements">Vêtements</button>
                    <button class="chip" data-category="Décoration">Décoration</button>
                    <button class="chip" data-category="Accessoires">Accessoires</button>
                    <button class="chip" data-category="Autre">Autre</button>
                </div>
            </div>

            <!-- Matière -->
            <div class="filter-row">
                <p class="filter-label">Matière :</p>
                <div class="chip-group" id="materialChips">
                    <button class="chip chip-active" data-material="Tous">Tous</button>
                    <button class="chip" data-material="Céramique">Céramique</button>
                    <button class="chip" data-material="Bois">Bois</button>
                    <button class="chip" data-material="Cuir">Cuir</button>
                    <button class="chip" data-material="Textile">Textile</button>
                    <button class="chip" data-material="Métal">Métal</button>
                    <button class="chip" data-material="Verre">Verre</button>
                    <button class="chip" data-material="Papier">Papier</button>
                    <button class="chip" data-material="Autre">Autre</button>
                </div>
            </div>
        </div>

        <div class="results-count">
            <?= count($craftmen) ?> artisans trouvés
        </div>

        <div class="craftmen-grid">
            <?php foreach ($craftmen as $_craftman): ?>
                <div class="craftman-card">
                    <div class="craftman-card-img-wrap">
                        <img
                            src="<?= htmlspecialchars($_craftman['profile_image_url'] ?? '') ?>"
                            alt="Photo de <?= htmlspecialchars($_craftman['company_name'] ?? 'artisan') ?>"
                        >
                        <div class="img-gradient"></div>
                    </div>

                    <div class="craftman-card-content">
                        <h3><?= htmlspecialchars($_craftman['company_name'] ?? '') ?></h3>
                        <p>Artisan</p>

                        <a href="index.php?page=craftman&id=<?= (int)($_craftman['craftman_id'] ?? 0) ?>"
                           class="btn-discover">
                            <span>Découvrir</span>
                            <span class="icon-arrow-right">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                    <polyline points="12 5 19 12 12 19" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
</body>

