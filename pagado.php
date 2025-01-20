<?php
session_start();

// Clear the cart
$_SESSION['cart'] = [];

// Optionally, you can also clear the cart from localStorage if you're using it
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra Realizada</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    margin: 20px;
    padding: 20px;
    display: flex;
    background-color: #FF7312;
    justify-content: center;
}
.container {
    text-align: center;
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}
h1 {
    color: #333;
    margin-bottom: 30px;
}
.buttons {
    display: flex;
    justify-content: center;
    gap: 20px;

    .btn {
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}
.btn-inicio {
    background-color: #FF7312;
    color: white;
}
.btn-comprar {
    background-color: #C2AA27;
    color: white;
}
.btn:hover {
    opacity: 0.9;
}
}

    </style>


</head>
<body>
    <div class="container">
    <img src="iconos/pago.png" alt="Usuario Icono"/>
        <h1>¡Gracias por tu compra!</h1>
        <p>Tu pedido ha sido procesado exitosamente.</p>
        <button onclick="window.location.href='bienvenido.html'" type="submit" class=".buttons">Volver al Inicio</button>
    </div>

    <script>
        // Clear localStorage cart
        localStorage.removeItem('carrito');
    </script>
</body>
</html>