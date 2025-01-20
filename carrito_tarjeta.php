<?php
session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = htmlspecialchars(trim($_POST['ownerName']));
    $direccion = htmlspecialchars(trim($_POST['address']));
    $correo_electronico = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $num_tarjeta = htmlspecialchars(trim($_POST['cardNumber']));
    $fecha_tarjeta = htmlspecialchars(trim($_POST['expiryDate']));
    $cvv = htmlspecialchars(trim($_POST['cvv']));

    $errors = [];
    
    if (empty($nombre)) $errors[] = "Nombre es requerido";
    if (!filter_var($correo_electronico, FILTER_VALIDATE_EMAIL)) $errors[] = "Correo electrónico inválido";
    if (empty($direccion)) $errors[] = "Dirección es requerida";
    if (strlen($num_tarjeta) != 16) $errors[] = "Número de tarjeta inválido";
    if (!preg_match('/^\d{2}\/\d{2}$/', $fecha_tarjeta)) $errors[] = "Fecha de tarjeta inválida";
    if (strlen($cvv) != 3) $errors[] = "CVV inválido";

    if (empty($errors)) {
        try {
            $stmt = $conexion->prepare("INSERT INTO usuario (nombre, correo_electronico, direccion, num_tarjeta, fecha_tarjeta, cvv) VALUES (?, ?, ?, ?, ?, ?)");
            

            $stmt->bind_param("ssssss", $nombre, $correo_electronico, $direccion, $num_tarjeta, $fecha_tarjeta, $cvv);
            
            if ($stmt->execute()) {
                header("Location: pagado.html");
                exit();
            } else {
                $errors[] = "Error al guardar los datos: " . $stmt->error;
            }
            
            $stmt->close();
        } catch (Exception $e) {
            $errors[] = "Error de conexión: " . $e->getMessage();
        }
    }

    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago y Dirección</title>
    <link rel="stylesheet" href="tarjeta.css"/> 
</head>
<body>
<div class="container">
    <div class="gif-container">
      <img alt="gif de carrito" src="imagenes/tarjeta.gif"/>
    </div>
    
    <div class="form-container">
        <?php
        if (isset($_SESSION['form_errors'])) {
            echo "<div class='error-container'>";
            foreach ($_SESSION['form_errors'] as $error) {
                echo "<p class='error'>$error</p>";
            }
            echo "</div>";
            unset($_SESSION['form_errors']);
        }
        ?>
        <form id="paymentForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Ingresar tarjeta</h2>
            <div class="input-container">
                <label for="ownerName">Nombre del propietario</label>
                <input type="text" id="ownerName" name="ownerName" required value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : ''; ?>">
                <img src="iconos/usuario.png" alt="Usuario Icono"/>
                <div class="error" id="ownerNameError"></div>
            </div>
            <div class="input-container">
                <label for="cardNumber">Número de tarjeta</label>
                <input type="text" id="cardNumber" name="cardNumber" maxlength="16" required value="<?php echo isset($num_tarjeta) ? htmlspecialchars($num_tarjeta) : ''; ?>">
                <img src="iconos/tarjeta-de-credito.png" alt="Usuario Icono"/>
                <div class="error" id="cardNumberError"></div>
            </div>
            <div class="input-container">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" maxlength="3" required>
                <img src="iconos/tarjeta-cvv.png" alt="Usuario Icono"/>
                <div class="error" id="cvvError"></div>
            </div>
        <div class="input-container">
            <label for="expiryDate">Fecha de vencimiento</label>
            <input type="month" 
                id="expiryDate" 
                name="expiryDate" 
                required 
                min="<?php echo date('Y-m'); ?>" 
                max="<?php echo date('Y-m', strtotime('+10 years')); ?>"
            >
            <img src="iconos/calendario.png" alt="Calendario Icono" id="calendarIcon"/>
            <div class="error" id="expiryDateError"></div>
        </div>
            <h2>Información Adicional</h2>
            <div class="input-container">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required value="<?php echo isset($correo_electronico) ? htmlspecialchars($correo_electronico) : ''; ?>">
                <img src="iconos/sobre.png" alt="Usuario Icono"/>
                <div class="error" id="emailError"></div>
            </div>
            <div class="input-container">
                <label for="address">Dirección</label>
                <input type="text" id="address" name="address" required value="<?php echo isset($direccion) ? htmlspecialchars($direccion) : ''; ?>">
                <img src="iconos/marcador.png" alt="Usuario Icono"/>
                <div class="error" id="addressError"></div>
            </div>
            <button onclick="window.location.href='pagado.php'" type="submit">Pagar</button>
        </form>
    </div>    
    <script src="tarjeta.js"></script>
</body>
</html>