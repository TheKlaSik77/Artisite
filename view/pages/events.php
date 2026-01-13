<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tous nos Evènements</title>
  <link rel="stylesheet" href="./assets/css/pages/craftmen.css" />
  <link rel="stylesheet" href="./assets/css/pages/products.css" />
</head>

<body>
  <main>
    <section class="products-section">
        <h1 class="products-title">Nos Evènements</h1>
        <p class="products-subtitle">
            Découvrez les évenements organisés par nos atisans.
        </p>

        <!-- ================== FILTRES ================== -->
        <div class="filter-card">

            <div class="filter-header">
                <div>
                    <h2 class="filter-title">Rechercher et filtrer</h2>
                    <p class="filter-subtitle">Affinez par nom d'évènement ou catégorie.</p>
                </div>
            </div>

            <!-- Recherche texte -->
            <div class="filter-row">
                <div class="filter-input-wrapper">
                    <span class="filter-input-icon">🔍</span>
                    <input
                        type="text"
                        id="productSearch"
                        class="filter-input"
                        placeholder="Rechercher par nom d'évènement..."
                    />
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
        </div>
    <div class="results-count">
      9 évènements trouvés
    </div>

    <div class="craftmen-grid">
      <div class="craftman-card">
        <div class="craftman-card-img-wrap">
          <img
            src="https://images.unsplash.com/photo-1695740633675-d060b607f5c4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwb3R0ZXJ5JTIwY2VyYW1pYyUyMGhhbmRtYWRlfGVufDF8fHx8MTc2MDk1NTMyMXww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
            alt="Cours de couture">
          <div class="img-gradient"></div>
        </div>
        <div class="craftman-card-content">
          <h3>Crée ton propre bol</h3>
          <p>Atelier poterie</p>
          <a href="index.php?page=event&id=1" class="btn-discover">
            <span>Découvrir</span>
            <span class="icon-arrow-right">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="craftman-card">
        <div class="craftman-card-img-wrap">
          <img
            src="https://images.unsplash.com/photo-1675721128213-a9052641488e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx3b29kd29ya2luZyUyMGNhcnBlbnRlciUyMHRvb2xzfGVufDF8fHx8MTc2MTA1MTk1OHww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
            alt="Thomas Dubois">
          <div class="img-gradient"></div>
        </div>
        <div class="craftman-card-content">
          <h3>Confectionne ton sac</h3>
          <p>Cours de couture</p>
          <a href="index.php?page=event&id=1" class="btn-discover">
            <span>Découvrir</span>
            <span class="icon-arrow-right">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="craftman-card">
        <div class="craftman-card-img-wrap">
          <img
            src="https://images.unsplash.com/photo-1638410644502-e622c5c11e61?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxsZWF0aGVyJTIwY3JhZnQlMjBoYW5kbWFkZXxlbnwxfHx8fDE3NjEwNTE5NTh8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
            alt="Marie Leroux">
          <div class="img-gradient"></div>
        </div>
        <div class="craftman-card-content">
          <h3>Sculpture de glace</h3>
          <p>Atelier de sculpture</p>
          <a href="index.php?page=event&id=1" class="btn-discover">
            <span>Découvrir</span>
            <span class="icon-arrow-right">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="craftman-card">
        <div class="craftman-card-img-wrap">
          <img
            src="https://images.unsplash.com/photo-1562469162-c17fc5155156?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx0ZXh0aWxlJTIwd2VhdmluZyUyMGZhYnJpY3xlbnwxfHx8fDE3NjEwNTE5NjB8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
            alt="Julien Rousseau">
          <div class="img-gradient"></div>
        </div>
        <div class="craftman-card-content">
          <h3>Fabrique ton tissu</h3>
          <p>Atelier de tissage</p>
          <a href="index.php?page=event&id=1" class="btn-discover">
            <span>Découvrir</span>
            <span class="icon-arrow-right">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="craftman-card">
        <div class="craftman-card-img-wrap">
          <img
            src="https://images.unsplash.com/photo-1758974504445-65b1ee86e47e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxoYW5kbWFkZSUyMGpld2VscnklMjBhcnRpc2FufGVufDF8fHx8MTc2MTAzODQzOXww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
            alt="Claire Bernard">
          <div class="img-gradient"></div>
        </div>
        <div class="craftman-card-content">
          <h3>Ponce ton bijou</h3>
          <p>Atelier de joaillerie</p>
          <a href="index.php?page=event&id=1" class="btn-discover">
            <span>Découvrir</span>
            <span class="icon-arrow-right">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="craftman-card">
        <div class="craftman-card-img-wrap">
          <img
            src="https://images.unsplash.com/photo-1602224307648-b5d5f28d9132?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxhcnRpc2FuJTIwd29ya3Nob3AlMjBjcmFmdHNtYW58ZW58MXx8fHwxNzYxMDUxOTU4fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
            alt="Antoine Moreau">
          <div class="img-gradient"></div>
        </div>
        <div class="craftman-card-content">
          <h3>L'art de nos pinceaux</h3>
          <p>Cours de peinture</p>
          <a href="index.php?page=event&id=1" class="btn-discover">
            <span>Découvrir</span>
            <span class="icon-arrow-right">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="craftman-card">
        <div class="craftman-card-img-wrap">
          <img
            src="https://images.unsplash.com/photo-1695740633675-d060b607f5c4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwb3R0ZXJ5JTIwY2VyYW1pYyUyMGhhbmRtYWRlfGVufDF8fHx8MTc2MDk1NTMyMXww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
            alt="Isabelle Fontaine">
          <div class="img-gradient"></div>
        </div>
        <div class="craftman-card-content">
          <h3>Visite de notre soufflerie</h3>
          <p>Soufflerie artisanale</p>
          <a href="index.php?page=event&id=1" class="btn-discover">
            <span>Découvrir</span>
            <span class="icon-arrow-right">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="craftman-card">
        <div class="craftman-card-img-wrap">
          <img
            src="https://images.unsplash.com/photo-1602224307648-b5d5f28d9132?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxhcnRpc2FuJTIwd29ya3Nob3AlMjBjcmFmdHNtYW58ZW58MXx8fHwxNzYxMDUxOTU4fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
            alt="Laurent Petit">
          <div class="img-gradient"></div>
        </div>
        <div class="craftman-card-content">
          <h3>Bijoux</h3>
          <p>Enchères</p>
          <a href="index.php?page=event&id=1" class="btn-discover">
            <span>Découvrir</span>
            <span class="icon-arrow-right">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
              </svg>
            </span>
          </a>
        </div>
      </div>
      <div class="craftman-card">
        <div class="craftman-card-img-wrap">
          <img
            src="https://images.unsplash.com/photo-1638410644502-e622c5c11e61?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxsZWF0aGVyJTIwY3JhZnQlMjBoYW5kbWFkZXxlbnwxfHx8fDE3NjEwNTE5NTh8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
            alt="Camille Durand">
          <div class="img-gradient"></div>
        </div>
        <div class="craftman-card-content">
          <h3>Goûtez les produits locaux</h3>
          <p>Dégustation de vins</p>
          <a href="index.php?page=event&id=1" class="btn-discover">
            <span>Découvrir</span>
            <span class="icon-arrow-right">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="5" y1="12" x2="19" y2="12" />
                <polyline points="12 5 19 12 12 19" />
              </svg>
            </span>
          </a>
        </div>
      </div>
    </div>
    </div>
  </main>
  <!-- JS: recherche + filtres (réutilise le comportement de products.php adapté aux cartes artisans) -->
  <script>
    (function(){
      const searchInput = document.getElementById('productSearch');
      const categoryChips = document.getElementById('categoryChips');
      const materialChips = document.getElementById('materialChips');
      const artisanCards = Array.from(document.querySelectorAll('.craftman-card'));

      let searchTerm = '';
      let selectedCategory = 'Tous';
      let selectedMaterial = 'Tous';

      function cardText(card){
        const name = (card.querySelector('h3') && card.querySelector('h3').textContent) || '';
        const prof = (card.querySelector('.craftman-card-content p') && card.querySelector('.craftman-card-content p').textContent) || '';
        return (name + ' ' + prof).toLowerCase();
      }

      function updateFilters(){
        artisanCards.forEach(card => {
          const text = cardText(card);
          const matchText = text.includes(searchTerm.toLowerCase());
          const matchCategory = selectedCategory === 'Tous' || text.includes(selectedCategory.toLowerCase());
          const matchMaterial = selectedMaterial === 'Tous' || text.includes(selectedMaterial.toLowerCase());
          card.style.display = (matchText && matchCategory && matchMaterial) ? '' : 'none';
        });
      }

      if(searchInput){
        searchInput.addEventListener('input', (e) => {
          searchTerm = e.target.value.trim();
          updateFilters();
        });
      }

      if(categoryChips){
        categoryChips.addEventListener('click', (e) => {
          if(e.target.classList.contains('chip')){
            categoryChips.querySelectorAll('.chip').forEach(c => c.classList.remove('chip-active'));
            e.target.classList.add('chip-active');
            selectedCategory = e.target.dataset.category || 'Tous';
            updateFilters();
          }
        });
      }

      if(materialChips){
        materialChips.addEventListener('click', (e) => {
          if(e.target.classList.contains('chip')){
            materialChips.querySelectorAll('.chip').forEach(c => c.classList.remove('chip-active'));
            e.target.classList.add('chip-active');
            selectedMaterial = e.target.dataset.material || 'Tous';
            updateFilters();
          }
        });
      }

    })();
  </script>
</body>

</html>