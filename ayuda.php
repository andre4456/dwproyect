<?php
require_once 'conexion.php';  // Trae la conexión PDO ($conn)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos enviados por el formulario
    $id_usuario = $_POST['id_usuario'];
    $correo_electronico = $_POST['correo_electronico'];
    $comentario = $_POST['comentario'];
    
    // Limpiar los datos (esto es básico, puedes mejorarlo)
    $id_usuario = htmlspecialchars($id_usuario);
    $correo_electronico = htmlspecialchars($correo_electronico);
    $comentario = htmlspecialchars($comentario);

    try {
        // Preparar la consulta para insertar los datos en la base de datos
        $stmt = $conn->prepare("INSERT INTO ayuda (id_usuario, correo_electronico, comentario, fecha)
                                VALUES (:id_usuario, :correo_electronico, :comentario, NOW())");

        // Vincular los parámetros
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':correo_electronico', $correo_electronico);
        $stmt->bindParam(':comentario', $comentario);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>alert('¡Comentario enviado exitosamente!');</script>";
        } else {
            echo "<script>alert('Error al enviar el comentario.');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Ayuda</title>
  <link rel="stylesheet" href="ayuda.css"/> 
</head>
<body>
  <!-- Menú superior -->
  <div class="header">
    <div class="left-section">
      <img src="iconos/menu-hamburguesa.png" alt="Menu" class="menu-icon icon" onclick="toggleMenu()" />
      <img src="iconos/logo.png" alt="Logo" height="200" width="150" />
    </div>
    <div class="icons">
      <a href="carrito.php">
        <img src="iconos/carrito-de-compras.png" alt="Carrito" class="cart-icon icon" />
      </a>
    </div>
  </div>

  <!-- Menú lateral -->
  <div class="menu" id="menu">
    <div>
      <img src="iconos/cruz.png" onclick="toggleMenu()" class="close-icon">
    </div>
    <ul>
      <li><a href="bienvenido.html">Inicio</a></li>
      <li><a href="Productos.php">Catálogo</a></li>
      <li><a href="ayuda.php">Ayuda</a></li>
    </ul>
  </div>

  <!-- Contenedor principal (formulario y gif) -->
  <div class="container">
    <div class="gif-container">
      <img alt="gif de carrito" src="imagenes/ayuda.gif"/>
    </div>

    <div class="form-container">
      <h2>Ayuda</h2>

      <!-- Formulario de Ayuda -->
      <form method="POST" action="ayuda.php"> 
        <div class="input-container">
            <input type="text" name="id_usuario" placeholder="Usuario" required/>
            <img src="iconos/usuario.png" alt="Usuario Icono"/>
        </div>

        <div class="input-container">
            <input type="email" name="correo_electronico" placeholder="Correo" required/>
            <img src="iconos/sobre.png" alt="Correo Icono"/>
        </div>

        <h4>Comentario</h4>
        <div class="input-container">
            <textarea name="comentario" placeholder="Escribe tu comentario aquí..." rows="8" required></textarea>
        </div>

        <button type="submit" class="quantity-controls">Enviar</button>
      </form>
    </div>
  </div>
  <script src="menuyflayer"></script>
</body>
</html>
