<?php
session_start();


try {
    $conn = new PDO("mysql:host=localhost;dbname=db1", "userphp", "123456");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

try {

    $productos_stmt = $conn->prepare("SELECT id_produc, Nombre, precio, descuento, imagen_URL FROM producto");
    $productos_stmt->execute();
    $productos = $productos_stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}


$total_carrito = 0;
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

foreach ($cart_items as $index => $item) {

    $precio_original = $item['price'] * $item['quantity'];
    

    if(isset($item['discount']) && $item['discount'] > 0) {

        $precio_con_descuento = $item['price'] * (1 - ($item['discount'] / 100));
        

        $total_item = $precio_con_descuento * $item['quantity'];
    } else {

        $total_item = $precio_original;
    }
    

    $total_carrito += $total_item;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda de Abarrotes - Carrito</title>
    
    <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    overflow-x: hidden;
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    overflow-x: hidden;
}
.header {
    background-color: #ffffff;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.header .left-section {
    display: flex;
    align-items: center;
}
.header img {
    height: 50px;
}
.header .search-box-container {
    flex: 1;
    display: flex;
    justify-content: center;
    margin: 0 20px;
}
.header .search-box {
    position: relative;
    background-color: #ffffff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    width: 100%;
    max-width: 400px;
    display: flex;
    align-items: center;
}
.header .search-box input {
    flex: 1;
    border: none;
    padding: 5px;
    outline: none;
}
.header .icon {
    width: 20px;
    height: 20px;
    cursor: pointer;
}
.header .icons {
    display: flex;
    align-items: center;
}
.header .menu-icon, .header .cart-icon, .header .user-icon {
    margin: 0 10px;
}
.menu {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100%;
    background-color: #FF7312;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0,0,0,0.5);
    z-index: 1000;
}
.menu .close-icon {
    font-size: 24px;
    color: white;
    cursor: pointer;
    text-align: left;
}
.menu ul {
    list-style: none;
    padding: 0;
}
.menu ul li {
    margin: 20px 0;
}
.menu ul li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
}

h1 {
    text-align: center;
    margin-top: 20px;
}

.productos-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    overflow-x: auto;
    white-space: nowrap;
    gap: 20px;
    padding: 20px;
}
carrito-container{
  flex: 0 0 auto;
  width: 400%;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 15px;
  text-align: center;
  vertical-align: top;
  transition: transform 0.3s ease;
}

.producto, .carrito-item {
    display: inline-block;
    flex: 0 0 auto; 
    width: 300px;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    vertical-align: top;
    transition: transform 0.3s ease;
}

.producto img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}
.carrito-item img{
    max-width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 10px;
}

button {
    padding: 10px 15px;
    background-color: #FF7312;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-right: 20px;
}

button:hover {
    background-color: #C2AA27;
}


.footer {
    z-index: 1000;
    background-color: #ff68ff00;
    color: white;
    text-align: center;
    padding: 20px 0;
    width: 100%; 
    position: fixed;
    bottom: 0;
    left: 0;
    box-sizing: border-box;
    margin-top: -10px;
}
 a {
    padding: 10px 15px;
    background-color: #FF7312;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.buttonn  {
    padding: 10px 15px;
    background-color: #FF7312;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.buttonn:hover {
    background-color: #C2AA27;
}
.productos-container, .carrito-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    overflow-x: auto; 
    white-space: nowrap; 
    padding: 20px;
}

.producto, .carrito-item {
    display: inline-block;
    flex: 0 0 auto; 
    width: 250px;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    vertical-align: top;
    transition: transform 0.3s ease;
}

.producto img, .carrito-item img {
    max-width: 100%;
    height: 200px; 
    object-fit: cover; 
    border-radius: 8px;
    margin-bottom: 10px;
}

.carrito-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background-color: #f9f9f9;
    border-top: 1px solid #ddd;
}
.productos-container::-webkit-scrollbar {
    height: 8px;
}

.productos-container::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.productos-container::-webkit-scrollbar-thumb {
    background: #FF7312;
    border-radius: 4px;
}

.producto:hover, .carrito-item:hover {
    transform: scale(1.05);
}
.carrito-item h2 {
    font-size: 16px;
    margin-bottom: 10px;
  }
  
  .carrito-item p {
    font-size: 14px;
    margin-bottom: 5px;
  }
  
  .carrito-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
  }

  .total-carrito {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-top: 20px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
}

.total-carrito h3 {
    margin-bottom: 15px;
    font-size: 1.5em;
}

.total-carrito .button2 {
    margin: 10px 0;
    width: 200px;
}
</style>
</head>
<body>
<div class="header">
        <div class="left-section">
            <img src="iconos/menu-hamburguesa.png" alt="Menu" class="menu-icon icon" onclick="toggleMenu()" />
            <img src="iconos/logo.png" alt="Logo" height="200" width="150" />
        </div>

        <div class="icons">
            <a href="carrito.php">
                <img src="iconos/carrito-de-compras.png" alt="Cart" class="cart-icon icon" />
                <?php 
                $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                echo "<span id='cart-count'>($cart_count)</span>";
                ?>
            </a>
        </div>
    </div>
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

<div class="carrito-section">
    <h2>Carrito de Compras</h2>
    <div class="carrito-grid">
        <?php 
        foreach ($cart_items as $index => $item): 
            $precio_original = $item['price'] * $item['quantity'];
            
            if(isset($item['discount']) && $item['discount'] > 0) {
                $precio_con_descuento = $item['price'] * (1 - ($item['discount'] / 100));
                $precio_final = $precio_con_descuento * $item['quantity'];
            } else {
                $precio_final = $precio_original;
            }
        ?>
            <div class="carrito-item">
                <img src="<?php echo htmlspecialchars($item['image'] ?? ''); ?>" alt="<?php echo htmlspecialchars($item['name'] ?? 'Producto'); ?>">
                <h3><?php echo htmlspecialchars($item['name'] ?? 'Producto sin nombre'); ?></h3>
                <p>Cantidad: <?php echo $item['quantity']; ?></p>
                <p>Precio unitario: $<?php echo number_format($item['price'], 2); ?> MXN</p>
                <?php if(isset($item['discount']) && $item['discount'] > 0): ?>
                    <p>Descuento: <?php echo number_format($item['discount'], 2); ?>%</p>
                    <p>Precio unitario con descuento: $<?php echo number_format($item['price'] * (1 - ($item['discount'] / 100)), 2); ?> MXN</p>
                <?php endif; ?>
                <p>Subtotal: $<?php echo number_format($precio_final, 2); ?> MXN</p>
                <button onclick="eliminarDelCarrito(<?php echo $index; ?>)">Eliminar</button>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="total-carrito">
        <h3>Total: $<?php echo number_format($total_carrito, 2); ?> MXN</h3>
        <button class="button2" onclick="vaciarCarrito()">Vaciar Carrito</button>
        <button onclick="window.location.href='carrito_tarjeta.php'" class="button2">Pagar</button>
    </div>
</div>

<script>
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
    event.preventDefault();

    document.querySelectorAll('.error').forEach(error => error.textContent = '');

    let isValid = true;

    const cartItems = JSON.parse(localStorage.getItem('carrito') || '[]');
    if (cartItems.length === 0) {
        alert('El carrito está vacío. No se puede proceder con el pago.');
        return;
    }

    const expiryDateInput = document.getElementById('expiryDate');
    const currentDate = new Date();
    const [month, year] = expiryDateInput.value.split('/').map(Number);
    const expiryDate = new Date(2000 + year, month - 1);

    if (expiryDate <= currentDate) {
        document.getElementById('expiryDateError').textContent = 'La tarjeta está vencida';
        isValid = false;
    }

    if (isValid) {
        const formData = new FormData(event.target);
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        fetch('carrito_tarjeta.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers);
            
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Error response text:', text);
                    throw new Error(`HTTP error! status: ${response.status}, message: ${text}`);
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('Received data:', data);
            if (data.success) {

                localStorage.removeItem('carrito');
                

                window.location.href = 'pagado.html';
            } else {

                const errorMessage = data.message || 'Error desconocido';
                console.error('Server Error:', errorMessage);
                alert(errorMessage);
            }
        })
        .catch(error => {
            console.error('Fetch Error - Full Error:', error);
            console.error('Error name:', error.name);
            console.error('Error message:', error.message);
            console.error('Error stack:', error.stack);
            
            alert('Hubo un error al procesar el pago: ' + error.message);
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('monthYearPickerContainer');
    const expiryDateInput = document.getElementById('expiryDate');

    const MonthYearPicker = ReactDOM.render(
        <MonthYearPicker 
            onSelect={(formattedDate) => {
                expiryDateInput.value = formattedDate;
            }}
        />,
        container
    );
});


function eliminarDelCarrito(index) {
    fetch('eliminar_item_carrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `index=${index}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('No se pudo eliminar el producto');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al eliminar el producto');
    });
}


    //menu no borrar
    function toggleMenu() {
        const menu = document.getElementById('menu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
        } else {
            menu.style.display = 'block';
        }
    }
</script>
</body>
</html>