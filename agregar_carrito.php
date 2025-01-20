<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$existing_item_index = null;
foreach ($_SESSION['cart'] as $index => $item) {
    if ($item['productId'] === $data['productId']) {
        $existing_item_index = $index;
        break;
    }
}

if ($existing_item_index !== null) {
    $_SESSION['cart'][$existing_item_index]['quantity']++;
} else {
    $_SESSION['cart'][] = [
        'name' => $data['name'],
        'price' => $data['price'],
        'image' => $data['image'],
        'productId' => $data['productId'],
        'quantity' => 1
    ];
}

echo json_encode(['success' => true]);
?>