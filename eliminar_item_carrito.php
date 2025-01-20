<?php
session_start();

header('Content-Type: application/json');

if (!isset($_POST['index']) || !isset($_SESSION['cart'])) {
    echo json_encode(['success' => false, 'message' => 'Índice inválido']);
    exit;
}

$index = intval($_POST['index']);

if (isset($_SESSION['cart'][$index])) {
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array

    // Recalculate total
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $precio = $item['price'];
        $cantidad = $item['quantity'];
        $descuento = isset($item['discount']) ? $item['discount'] : 0;
        
        $precio_final = $descuento > 0 
            ? $precio * (1 - ($descuento / 100)) * $cantidad
            : $precio * $cantidad;
        
        $total += $precio_final;
    }

    echo json_encode([
        'success' => true, 
        'cart_count' => count($_SESSION['cart']), 
        'total' => $total
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
}
exit;