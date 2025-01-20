<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['index']) && isset($_SESSION['cart'])) {
    // Remove the item at the specified index
    array_splice($_SESSION['cart'], $data['index'], 1);
    
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Índice no válido']);
}
?>