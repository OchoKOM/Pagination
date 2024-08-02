<?php
$jsonFilePath = './products.json';

if (!file_exists($jsonFilePath) || !is_readable($jsonFilePath)) {
    http_response_code(500);
    echo json_encode(['error' => 'Cannot access products data']);
    exit;
}

$jsonData = file_get_contents($jsonFilePath);
$data = json_decode($jsonData, true);

if ($data === null) {
    http_response_code(500);
    echo json_encode(['error' => 'Error decoding JSON data']);
    exit;
}

$allProducts = $data['products'] ?? [];
$totalProducts = count($allProducts);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;
$lastProductID = isset($_GET['lastProductID']) ? $_GET['lastProductID'] : null;

$startIndex = 0;

// Si un lastProductID est fourni, trouver l'index de ce produit et commencer à partir du produit suivant
if ($lastProductID !== null) {
    foreach ($allProducts as $index => $product) {
        if ($product['id'] == $lastProductID) {
            $startIndex = $index + 1;
            break;
        }
    }
}

$endIndex = $startIndex + $perPage;

if ($startIndex >= $totalProducts) {
    $products = [];
    $isLastPage = true;
} else {
    $products = array_slice($allProducts, $startIndex, $perPage);
    $isLastPage = $endIndex >= $totalProducts;
}

header('Content-Type: application/json');
echo json_encode([
    'products' => $products,
    'isLastPage' => $isLastPage
]);
