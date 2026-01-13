<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$events = [
    1 => [
        'id'=>1,'title'=>'Atelier poterie traditionnelle','description'=>'Plongez dans l\'univers fascinant de la céramique traditionnelle...','longDescription'=>'Cet atelier de 3 heures vous permettra de découvrir les bases de la poterie...','type'=>'Atelier','category'=>'Céramique','duration'=>'3 heures','participants'=>'6-10 personnes','level'=>'Débutant','price'=>85,'artisan'=>['id'=>1,'name'=>'Sophie Martin','craft'=>'Céramiste'],'images'=>[
            'https://images.unsplash.com/photo-1758402633659-0aa5bdea7b89?crop=entropy&cs=tinysrgb&fit=max&fm=jpg',
            'https://images.unsplash.com/photo-1695740633675-d060b607f5c4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg',
            'https://images.unsplash.com/photo-1602224307648-b5d5f28d9132?crop=entropy&cs=tinysrgb&fit=max&fm=jpg'
        ],'availableDates'=>[
            ['id'=>'1','label'=>'Samedi 15 novembre 2025 - 14h00','available'=>true],
            ['id'=>'2','label'=>'Dimanche 16 novembre 2025 - 10h00','available'=>true],
            ['id'=>'3','label'=>'Samedi 22 novembre 2025 - 14h00','available'=>true],
            ['id'=>'4','label'=>'Dimanche 23 novembre 2025 - 10h00','available'=>false],
        ],'availableLocations'=>[
            ['id'=>'1','label'=>'Atelier Sophie Martin - Paris 11ème','address'=>'25 Rue de la Roquette, 75011 Paris'],
            ['id'=>'2','label'=>'Espace Créatif - Paris 3ème','address'=>'12 Rue du Temple, 75003 Paris'],
        ],'paymentOptions'=>[
            ['id'=>'card','label'=>'Carte bancaire'],['id'=>'paypal','label'=>'PayPal'],['id'=>'transfer','label'=>'Virement bancaire']
        ]
    ],

];

$event = isset($events[$id]) ? $events[$id] : $events[1];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= htmlspecialchars($event['title']) ?></title>
    <link rel="stylesheet" href="/Artisite/react/style/globals.css">
    <style>
        .container{max-width:1200px;margin:0 auto}
        .card{background:#fff;border-radius:16px;padding:1rem;border:1px solid rgba(0,0,0,.06)}
        .gallery img{width:100%;height:100%;object-fit:cover}
        .sticky{position:sticky;top:24px}
        .radio-row{display:flex;flex-direction:column;gap:.5rem}
        
        .event-grid{display:grid;grid-template-columns:1fr 360px;gap:2rem;align-items:start;max-width:1200px;margin:0 auto}
        @media(max-width:900px){.event-grid{grid-template-columns:1fr}}
        .event-main{min-width:0}
        .event-side{min-width:0}
        
        .event-side .card{padding:1.5rem}
        .event-side label{display:block;margin-bottom:.4rem}
        .event-side input[type="radio"]{margin-right:.5rem}
        .reserve-btn{width:100%;padding:1rem;border-radius:12px;background:linear-gradient(90deg,var(--secondary),var(--accent));border:none;color:#000;font-weight:700;cursor:pointer}
    </style>
</head>
<body>
    <main>
        <div class="container" style="padding:2rem 1rem">
            <button onclick="location.href='/Artisite/index.php?page=events'" style="background:none;border:none;color:var(--primary)">← Retour aux événements</button>
        </div>

        <div style="height:360px;position:relative;overflow:hidden">
            <img src="<?= htmlspecialchars($event['images'][0]) ?>" alt="<?= htmlspecialchars($event['title']) ?>" style="width:100%;height:100%;object-fit:cover">
            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.7),transparent)"></div>
        </div>

        <div class="container" style="margin-top:-80px;padding:0 1rem 4rem;position:relative;z-index:10">
            <div class="event-grid">
                <div class="event-main">
                    <div class="card" style="padding:2rem;margin-bottom:1rem">
                        <div style="display:flex;gap:1rem;align-items:center;margin-bottom:1rem">
                            <span style="padding:.4rem .8rem;background:var(--secondary);border-radius:999px;color:black;font-size:.9rem"><?= htmlspecialchars($event['type']) ?></span>
                            <span style="padding:.4rem .8rem;background:var(--primary);border-radius:999px;color:white;font-size:.9rem"><?= htmlspecialchars($event['category']) ?></span>
                        </div>
                        <h1 style="font-family:'Cormorant Garamond';font-size:36px;color:var(--primary);margin:0 0 1rem"><?= htmlspecialchars($event['title']) ?></h1>
                        <div style="color:#6b6b6b;margin-bottom:1rem">
                            <div>⏱ <?= htmlspecialchars($event['duration']) ?></div>
                            <div>👥 <?= htmlspecialchars($event['participants']) ?></div>
                            <div>Niveau : <?= htmlspecialchars($event['level']) ?></div>
                        </div>
                        <div style="border-top:1px solid rgba(0,0,0,.06);padding-top:1rem">
                            <h2 style="font-family:'Cormorant Garamond'">Description</h2>
                            <p><?= htmlspecialchars($event['description']) ?></p>
                            <p><?= htmlspecialchars($event['longDescription']) ?></p>
                        </div>

                        <div style="border-top:1px solid rgba(0,0,0,.06);padding-top:1rem;margin-top:1rem">
                            <h3>Animé par</h3>
                            <button onclick="location.href='/Artisite/index.php?page=craftman&id=<?= $event['artisan']['id'] ?>'" style="display:flex;align-items:center;gap:1rem;padding:.6rem;border-radius:12px;border:1px solid rgba(0,0,0,.04);background:#f9f9f9">
                                <div style="width:56px;height:56px;border-radius:999px;background:linear-gradient(90deg,var(--secondary),var(--accent));display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Cormorant Garamond'"><?= strtoupper($event['artisan']['name'][0]) ?></div>
                                <div style="text-align:left">
                                    <div style="font-family:'Cormorant Garamond'"><?= htmlspecialchars($event['artisan']['name']) ?></div>
                                    <div style="color:#6b6b6b"><?= htmlspecialchars($event['artisan']['craft']) ?></div>
                                </div>
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <h3 style="font-family:'Cormorant Garamond'">Galerie photos</h3>
                        <div class="gallery" style="display:grid;grid-template-columns:repeat(2,1fr);gap:1rem;margin-top:1rem">
                            <?php for($i=1;$i<count($event['images']);$i++): ?>
                                <div style="aspect-ratio:16/9;border-radius:12px;overflow:hidden">
                                    <img src="<?= htmlspecialchars($event['images'][$i]) ?>" alt="<?= htmlspecialchars($event['title']) ?> - photo <?= $i ?>">
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>

                <aside class="event-side">
                    <div class="card sticky" style="padding:2rem">
                        <div style="margin-bottom:1rem">
                            <div style="font-family:'Cormorant Garamond';font-size:28px;color:var(--primary)"><?= htmlspecialchars($event['price']) ?>€</div>
                            <div style="color:#6b6b6b">/ personne</div>
                        </div>

                        <div style="margin-bottom:1rem">
                            <label style="font-weight:600;margin-bottom:.5rem;display:block">Choisir une date</label>
                            <div class="radio-row">
                                <?php foreach($event['availableDates'] as $d): ?>
                                    <label style="display:flex;align-items:center;gap:.5rem;padding:.5rem;border-radius:8px;border:1px solid rgba(0,0,0,.04);">
                                        <input type="radio" name="date" value="<?= $d['id'] ?>" <?= $d['available']? '':'disabled' ?>>
                                        <span><?= htmlspecialchars($d['label']) ?> <?= $d['available']? '': ' (Complet)' ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div style="margin-bottom:1rem">
                            <label style="font-weight:600;margin-bottom:.5rem;display:block">Choisir un lieu</label>
                            <div class="radio-row">
                                <?php foreach($event['availableLocations'] as $loc): ?>
                                    <label style="display:flex;align-items:flex-start;gap:.5rem;padding:.5rem;border-radius:8px;border:1px solid rgba(0,0,0,.04);">
                                        <input type="radio" name="location" value="<?= $loc['id'] ?>">
                                        <div>
                                            <div style="font-weight:600"><?= htmlspecialchars($loc['label']) ?></div>
                                            <div style="font-size:.85rem;color:#6b6b6b"><?= htmlspecialchars($loc['address']) ?></div>
                                        </div>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div style="margin-bottom:1rem">
                            <label style="font-weight:600;margin-bottom:.5rem;display:block">Mode de paiement</label>
                            <div class="radio-row">
                                <?php foreach($event['paymentOptions'] as $opt): ?>
                                    <label style="display:flex;align-items:center;gap:.5rem;padding:.5rem;border-radius:8px;border:1px solid rgba(0,0,0,.04);">
                                        <input type="radio" name="payment" value="<?= htmlspecialchars($opt['id']) ?>">
                                        <span><?= htmlspecialchars($opt['label']) ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <button id="reserveBtn" class="reserve-btn">Réserver maintenant</button>
                        <p style="font-size:.85rem;color:#6b6b6b;text-align:center;margin-top:.75rem">Annulation gratuite jusqu'à 48h avant l'événement</p>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('reserveBtn').addEventListener('click', function(){
            const date = document.querySelector('input[name="date"]:checked');
            const loc = document.querySelector('input[name="location"]:checked');
            const pay = document.querySelector('input[name="payment"]:checked');
            if(date && loc && pay){
                alert('Réservation confirmée !');
            } else {
                alert('Veuillez sélectionner une date, un lieu et un mode de paiement.');
            }
        });
    </script>
</body>
</html>