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
      <img src="https://picsum.photos/1600/300" alt="atelier cover">
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

              <div class="meta" style="margin-top:.6rem;">
                <div class="chip" title="SIRET">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 1 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                  </svg>
                  <span><?= htmlspecialchars($craftman['siret'] ?? '—') ?></span>
                </div>
              </div>
            </div>

            <div>
              <button class="contact-btn" type="button">Contacter</button>
            </div>
          </div>

          <p class="muted" style="margin-top:.4rem;max-width:75ch">
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
                      // ✅ same behavior as your products page
                      $links[] = '/Artisite/' . ltrim($link, '/');
                  }
              }
              $first = $links[0] ?? 'https://picsum.photos/500/300';
            ?>

            <article class="product-card product-appear">
              <img
                class="product-img js-product-img"
                src="<?= htmlspecialchars($first) ?>"
                data-images='<?= htmlspecialchars(json_encode($links, JSON_UNESCAPED_SLASHES)) ?>'
                alt="<?= htmlspecialchars($product['name'] ?? 'Produit') ?>"
              >

              <div class="product-info">
                <h3 class="product-name"><?= htmlspecialchars($product['name'] ?? '') ?></h3>
                <p class="product-artisan"><?= htmlspecialchars($product['company_name'] ?? '') ?></p>
                <p class="product-price">
                  <?= number_format((float)($product['unit_price'] ?? 0), 2, ',', ' ') ?> €
                </p>
                <a class="product-btn" href="index.php?page=product&id=<?= (int)$product['product_id'] ?>">
                  Acheter
                </a>
              </div>
            </article>
          <?php endforeach; ?>

        </div>
      <?php endif; ?>
    </section>

    <!-- keep your other sections as before (events/reviews static) -->
    <section>
      <div class="section-header">
        <div class="section-subtitle">Prochainement</div>
        <h3 class="section-title">Ateliers & Événements</h3>
        <p class="muted" style="margin-top:.5rem">Découvrez les ateliers et événements organisés par <?= htmlspecialchars($craftman['company_name'] ?? 'cet artisan') ?></p>
      </div>

      <div class="events-grid">
        <article class="card">
          <div><img src="https://picsum.photos/300/300" alt="atelier"></div>
          <div>
            <h4 style="padding:0 1rem 0 1rem;margin-top:.6rem">Atelier poterie traditionnelle</h4>
            <div class="muted" style="padding:0 1rem 0 1rem">15 novembre 2025 — Paris 11ème</div>
            <div style="padding:1rem 1rem 1.2rem 1rem"><a class="btn-gold" href="#">En savoir plus</a></div>
          </div>
        </article>

        <article class="card">
          <div><img src="https://picsum.photos/300/300" alt="stage"></div>
          <div>
            <h4 style="padding:0 1rem 0 1rem;margin-top:.6rem">Stage de tournage - Niveau avancé</h4>
            <div class="muted" style="padding:0 1rem 0 1rem">22 novembre 2025 — Paris 11ème</div>
            <div style="padding:1rem 1rem 1.2rem 1rem"><a class="btn-gold" href="#">En savoir plus</a></div>
          </div>
        </article>
      </div>
    </section>

    <section>
      <div class="section-header">
        <div class="section-subtitle">Témoignages</div>
        <h3 class="section-title">Avis des clients</h3>
      </div>

      <div class="reviews-grid">
        <div class="review">
          <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:.6rem">
            <div>
              <div style="font-size:1.05rem">Marie L.</div>
            </div>
            <div style="font-size:.85rem;color:var(--muted)">Il y a 2 semaines</div>
          </div>
          <p style="margin:0;color:#374151">Magnifique travail !</p>
        </div>

        <div class="review">
          <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:.6rem">
            <div>
              <div style="font-size:1.05rem">Thomas D.</div>
            </div>
            <div style="font-size:.85rem;color:var(--muted)">Il y a 1 mois</div>
          </div>
          <p style="margin:0;color:#374151">Je recommande vivement !</p>
        </div>

        <div class="review">
          <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:.6rem">
            <div>
              <div style="font-size:1.05rem">Claire B.</div>
            </div>
            <div style="font-size:.85rem;color:var(--muted)">Il y a 2 mois</div>
          </div>
          <p style="margin:0;color:#374151">Très belles pièces artisanales.</p>
        </div>
      </div>
    </section>

    <div style="height:6rem"></div>
  </main>

  <script src="./assets/js/products/image_cycle.js"></script>
</body>

</html>
