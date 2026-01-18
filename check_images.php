<?php
require 'model/utils/connexion.php';

// $pdo est maintenant disponible depuis connexion.php

// Vérifier les images
echo "=== Images dans la table image ===\n";
$stmt = $pdo->query('SELECT product_id, image_link, placeholder FROM image LIMIT 10');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($rows)) {
    echo "❌ Aucune image trouvée dans la table image\n\n";
} else {
    echo "✓ " . count($rows) . " image(s) trouvée(s):\n";
    foreach ($rows as $r) {
        echo "  - Product {$r['product_id']}: {$r['image_link']}\n";
    }
    echo "\n";
}

// Vérifier les produits
echo "=== Produits dans la table product ===\n";
$stmt2 = $pdo->query('SELECT product_id, name FROM product LIMIT 5');
$products = $stmt2->fetchAll(PDO::FETCH_ASSOC);

if (empty($products)) {
    echo "❌ Aucun produit trouvé\n";
} else {
    echo "✓ " . count($products) . " produit(s) trouvé(s)\n";
    foreach ($products as $p) {
        echo "  - Product {$p['product_id']}: {$p['name']}\n";
    }
}
