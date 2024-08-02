<?php
$totalProducts = 2000;

// Générer une liste complète de produits fictifs
$allProducts = [];
for ($i = 0; $i < $totalProducts; $i++) {
    $id = $i + 1;
    $allProducts[] = [
        'id' => $id,
        'name' => "Product $id",
        'description' => "Description for Product $id",
        'price' => rand(1, 100) . "." . str_pad(rand(0, 99), 2, '0', STR_PAD_LEFT), // Ajout de zéros pour les centimes
    ];
}

// Préparer les données au format JSON
$jsonData = json_encode(['products' => $allProducts], JSON_PRETTY_PRINT);

// Écrire les données JSON dans un fichier
$file = 'products.json';
file_put_contents($file, $jsonData);

echo "Fichier JSON généré avec succès.";
