<?php
session_start();
require_once 'conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    http_response_code(401); // No autorizado
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

try {
    $stmt = $conn->prepare("SELECT c.ID_product AS id, p.nombre, p.precio, c.cantidad, p.imagen_URL AS imagen 
                            FROM carrito c 
                            JOIN producto p ON c.ID_product = p.id_produc 
                            WHERE c.id_usuario = :id_usuario");
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->execute();
    $carrito = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($carrito);
} catch (PDOException $e) {
    http_response_code(500); // Error del servidor
    echo json_encode(['error' => $e->getMessage()]);
}
?>
