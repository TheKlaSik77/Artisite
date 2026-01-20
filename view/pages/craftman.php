<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?= htmlspecialchars($craftman['company_name'] ?? "Artisan") ?></title>

  <link rel="stylesheet" href="./assets/css/pages/craftman.css" />
  <link rel="stylesheet" href="./assets/css/pages/products.css" />
</head>

<body>
  <main>
    <div class="cover" role="banner">
      <img src="./assets/img/placeholder0.jpeg" alt="atelier cover">
      <button type="button" class="back-btn" aria-label="Retour" onclick="location.href='index.php?page=craftmen'">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round" style="color:#000000">
          <line x1="19" y1="12" x2="5" y2="12"></line>
          <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
      </button>
    </div>

    <div class="profile-wrap">
      <div class="profile-card">
        <div class="avatar">
          <img src="<?= htmlspecialchars($craftmanImageUrl) ?>"
            alt="<?= htmlspecialchars($craftman['company_name'] ?? 'Artisan') ?>">
        </div>

        <div class="profile-main">
          <div class="profile-top">
            <div>
              <h2 class="name"><?= htmlspecialchars($craftman['company_name'] ?? '') ?></h2>
              <p class="occupation">Artisan</p>

              <div class="meta">
                <div class="chip chip-siret">
                  <span>SIRET : <?= htmlspecialchars($craftman['siret'] ?? '—') ?></span>
                </div>
              </div>
            </div>

            <?php if (isUser()): ?>
              <div class="profile-actions">
                <a href="index.php?page=support&craftman=<?= urlencode($craftman['company_name'] ?? '') ?>"
                  class="contact-btn contact-btn-primary">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                  </svg>
                  Contacter
                </a>
              </div>
            <?php endif; ?>
          </div>

          <p class="profile-description">
            <?= htmlspecialchars($craftman['description'] ?? '') ?>
          </p>
        </div>
      </div>
    </div>

    <!-- ✅ CREATIONS: dynamic + animated only -->
    <section class="products-section" style="padding-top:0;">
      <div class="section-header">
        <div class="section-subtitle">Disponible maintenant</div>
        <h3 class="section-title">Créations</h3>
      </div>

      <?php if (empty($products)): ?>
        <p class="no-results" style="text-align:left;">Aucun produit pour le moment.</p>
      <?php else: ?>
        <div class="products-grid">

          <?php foreach ($products as $product): ?>
            <?php
            $links = [];
            if (!empty($product['image_links'])) {
              $rawLinks = array_values(array_filter(explode('||', $product['image_links'])));
              foreach ($rawLinks as $link) {
                // Use relative path from index.php
                $links[] = './' . ltrim($link, '/');
              }
            }
            $first = $links[0] ?? 'https://picsum.photos/500/300';
            ?>

            <article class="product-card product-appear">
              <img class="product-img js-product-img" src="<?= htmlspecialchars($first) ?>"
                data-images='<?= htmlspecialchars(json_encode($links, JSON_UNESCAPED_SLASHES)) ?>'
                alt="<?= htmlspecialchars($product['name'] ?? 'Produit') ?>">

              <div class="product-info">
                <h3 class="product-name"><?= htmlspecialchars($product['name'] ?? '') ?></h3>
                <p class="product-artisan"><?= htmlspecialchars($product['company_name'] ?? '') ?></p>
                <p class="product-price">
                  <?= number_format((float) ($product['unit_price'] ?? 0), 2, ',', ' ') ?> €
                </p>
                <a class="product-btn" href="index.php?page=product&id=<?= (int) $product['product_id'] ?>">
                  Acheter
                </a>
              </div>
            </article>
          <?php endforeach; ?>

        </div>
      <?php endif; ?>
    </section>
    <div style="height:6rem"></div>
  </main>

  <script src="./assets/js/products/image_cycle.js"></script>
</body>

</html>