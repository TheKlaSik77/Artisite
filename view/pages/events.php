<!DOCTYPE html>
<html lang="fr">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Événements</title>
    <link rel="stylesheet" href="/Artisite/react/style/globals.css">
    <link rel="stylesheet" href="/Artisite/assets/css/pages/products.css">
    <link rel="stylesheet" href="/Artisite/assets/css/pages/craftmen.css">
    <style>
        .container{max-width:1200px;margin:0 auto}
        .grid{display:grid;gap:1.5rem}
        .grid-cols-1{grid-template-columns:1fr}
        @media(min-width:768px){.md\:grid-cols-2{grid-template-columns:repeat(2,1fr)}}
        @media(min-width:1024px){.lg\:grid-cols-3{grid-template-columns:repeat(3,1fr)}}
        .rounded-2xl{border-radius:1rem}
        .aspect-4-3{aspect-ratio:4/3}
        .overflow-hidden{overflow:hidden}
        .object-cover{object-fit:cover}
        .btn-ghost{background:transparent;border:none;color:var(--primary)}
        .filter-chip{display:inline-block;padding:.6rem 1rem;border-radius:12px;border:1px solid rgba(0,0,0,.06);cursor:pointer}
        .filter-chip.active{background:linear-gradient(90deg,var(--secondary),var(--accent));color:#000}
        .search-input{padding:.9rem 1rem;border-radius:12px;border:1px solid rgba(0,0,0,.08);width:100%}
    </style>
</head>

<body>
    <main>
        <?php
        $events = [
            [
                'id'=>1,'title'=>'Atelier poterie traditionnelle','date'=>'15 novembre 2025','location'=>'Paris 11ème','type'=>'atelier','image'=>'https://images.unsplash.com/photo-1758402633659-0aa5bdea7b89?crop=entropy&cs=tinysrgb&fit=max&fm=jpg'
            ],
            [
                'id'=>2,'title'=>'Salon des Métiers d\'Art','date'=>'22 novembre 2025','location'=>'Lyon','type'=>'salon','image'=>'https://images.unsplash.com/photo-1719934113502-d2968bc999d7?crop=entropy&cs=tinysrgb&fit=max&fm=jpg'
            ],
            [
                'id'=>3,'title'=>'Exposition de maroquinerie artisanale','date'=>'5 décembre 2025','location'=>'Bordeaux','type'=>'exposition','image'=>'https://images.unsplash.com/photo-1638410644502-e622c5c11e61?crop=entropy&cs=tinysrgb&fit=max&fm=jpg'
            ],
            [
                'id'=>4,'title'=>'Atelier menuiserie créative','date'=>'12 décembre 2025','location'=>'Marseille','type'=>'atelier','image'=>'https://images.unsplash.com/photo-1675721128213-a9052641488e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg'
            ],
            [
                'id'=>5,'title'=>'Marché des créateurs','date'=>'18 décembre 2025','location'=>'Toulouse','type'=>'salon','image'=>'https://images.unsplash.com/photo-1719934113502-d2968bc999d7?crop=entropy&cs=tinysrgb&fit=max&fm=jpg'
            ],
        ];
        ?>

        <header class="bg-black text-white relative overflow-hidden" style="padding:6rem 0 2rem">
            <div style="position:absolute;inset:0;background-image:url('https://images.unsplash.com/photo-1739664664067-310787d23cff?crop=entropy&cs=tinysrgb&fit=max&fm=jpg');background-size:cover;background-position:center;filter:brightness(0.35);opacity:1"></div>
            <div style="position:absolute;inset:0;background:#000;opacity:0.25"></div>
            <div class="container" style="position:relative;z-index:10;padding:0 1rem;margin-top:calc(-2.5rem - 30px)">
                <button class="btn-ghost" onclick="location.href='/Artisite/index.php?page=homepage'">← Retour</button>
                <h1 style="font-family:'Cormorant Garamond';font-size:48px;color:var(--secondary);margin:.5rem 0">Événements</h1>
                <p style="max-width:800px;color:rgba(255,255,255,.9)">Découvrez tous nos ateliers, salons et expositions pour rencontrer les artisans, apprendre de nouvelles techniques et célébrer le savoir-faire artisanal français.</p>

                <div class="filter-card" style="margin-top:1.5rem">
                    <div class="filter-header">
                        <div class="filter-icon">⚙️</div>
                        <div>
                            <h2 class="filter-title">Rechercher et filtrer</h2>
                            <p class="filter-subtitle">Affinez par nom d'évènement ou catégorie.</p>
                        </div>
                    </div>

                    <div class="filter-row">
                        <div class="filter-input-wrapper">
                            <span class="filter-input-icon">🔍</span>
                            <input id="searchInput" class="filter-input" placeholder="Rechercher un évènement ou un lieu..." />
                        </div>
                    </div>

                    <div class="filter-row">
                        <p class="filter-label">Catégorie :</p>
                        <div class="chip-group" id="categoryChips">
                            <button class="chip chip-active" data-filter="all">Tous</button>
                            <button class="chip" data-filter="atelier">Atelier</button>
                            <button class="chip" data-filter="salon">Salon</button>
                            <button class="chip" data-filter="exposition">Exposition</button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="container" style="padding:3rem 1rem">

            <div id="resultsCount" style="margin-bottom:1rem;color:#6b6b6b;"></div>

            <div id="eventsGrid" class="craftmen-grid">
                <?php foreach($events as $e): ?>
                    <article class="craftman-card" data-type="<?= htmlspecialchars($e['type']) ?>" data-title="<?= htmlspecialchars(strtolower($e['title'])) ?>" data-location="<?= htmlspecialchars(strtolower($e['location'])) ?>">
                        <div class="craftman-card-img-wrap">
                            <img src="<?= $e['image'] ?>" alt="<?= htmlspecialchars($e['title']) ?>">
                            <div class="img-gradient"></div>
                        </div>
                        <div class="craftman-card-content">
                            <h3><?= htmlspecialchars($e['title']) ?></h3>
                            <p><?= htmlspecialchars($e['location']) ?> — <?= htmlspecialchars($e['date']) ?></p>
                            <a href="/Artisite/index.php?page=event&id=<?= $e['id'] ?>" class="btn-discover">
                                <span>Voir</span>
                                <span class="icon-arrow-right">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                        <polyline points="12 5 19 12 12 19" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <script>
        (function(){
            const searchInput = document.getElementById('searchInput');
            const chips = Array.from(document.querySelectorAll('.chip'));
            const cards = Array.from(document.querySelectorAll('#eventsGrid article'));
            function getActiveFilters(){
                const active = chips.filter(c=>c.classList.contains('chip-active')).map(c=>c.dataset.filter);
                return active.length?active:['all'];
            }
            function updateCount(){
                const visible = cards.filter(c=>c.style.display!=='none').length;
                document.getElementById('resultsCount').textContent = visible + ' événement' + (visible>1?'s':'') + ' trouvé' + (visible>1?'s':'');
            }
            function applyFilters(){
                const q = (searchInput.value||'').toLowerCase().trim();
                const filters = getActiveFilters();
                cards.forEach(card=>{
                    const title = card.dataset.title||'';
                    const location = card.dataset.location||'';
                    const type = card.dataset.type||'';
                    const matchesSearch = q === '' || title.includes(q) || location.includes(q);
                    const matchesType = filters.includes('all') || filters.includes(type);
                    card.style.display = (matchesSearch && matchesType)?'':'none';
                });
                updateCount();
            }
            chips.forEach(chip=>{
                chip.addEventListener('click', ()=>{
                    if(chip.dataset.filter==='all'){
                        chips.forEach(c=>c.classList.remove('chip-active'));
                        chip.classList.add('chip-active');
                    } else {
                        chip.classList.toggle('chip-active');
                        const anyNonAll = chips.some(c=>c.dataset.filter!=='all' && c.classList.contains('chip-active'));
                        chips.forEach(c=>{ if(c.dataset.filter==='all') c.classList.toggle('chip-active', !anyNonAll); });
                    }
                    applyFilters();
                });
            });
            searchInput.addEventListener('input', applyFilters);
            applyFilters();
        })();
    </script>
</body>

</html>