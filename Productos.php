<?php
session_start(); // Iniciar sesión para el carrito

require_once 'conexion.php'; // Asegúrate de que este archivo contiene la conexión PDO

try {
    // Consulta para obtener TODOS los productos
    $stmt = $conn->prepare("SELECT id_produc, nombre, precio, categoria, descuento, imagen_URL FROM producto");
    $stmt->execute(); // Ejecuta la consulta
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtiene todos los resultados como un array asociativo

    if (!$productos) {
        echo "No se encontraron productos.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

/// Modify the existing add to cart logic in the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_discount = $_POST['product_discount'];
    $product_image = $_POST['product_image'];
    $quantity = $_POST['quantity'];

    // Fetch product details
    $stmt = $conn->prepare("SELECT * FROM producto WHERE id_produc = :product_id");
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product already exists in the cart
    $product_exists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id && !$item['isPromotion']) {
            $item['quantity'] += $quantity;
            $product_exists = true;
            break;
        }
    }

    // If the product doesn't exist, add it
    if (!$product_exists) {
        $_SESSION['cart'][] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'discount' => $product_discount,
            'image' => $product_image,
            'quantity' => $quantity,
            'isPromotion' => false
        ];
    }

    // Redirect to prevent form resubmission
    header('Location: Productos.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="producto.css"/>
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

<div class="filter">
    <div>
        Ordenar por:
        <select id="sort-select">
            <option value="price-desc">Descuento, mayor a menor</option>
            <option value="price-asc">Descuento, menor a mayor</option>
            <option value="alphabetical">Alfabéticamente, A-Z</option>
        </select>
    </div>
</div>
    
<div class="products">
        <?php if (empty($productos)): ?>
            <p>No hay productos disponibles en este momento.</p>
        <?php else: ?>
            <?php foreach ($productos as $producto): ?>
                <div class="product-card">
                <img src="<?php echo isset($producto['imagen_URL']) ? htmlspecialchars($producto['imagen_URL']) : '/imagenes/default.jpg'; ?>" alt="Imagen de <?php echo htmlspecialchars($producto['nombre']); ?>" />
                <div class="details">
                        <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                        <p>Categoría: <?php echo htmlspecialchars($producto['categoria']); ?></p>
                        
                        <?php if ($producto['descuento'] > 0): ?>
                            <p>Precio original: $<?php echo number_format($producto['precio'], 2); ?> MXN</p>
                            <p><strong>Descuento: <?php echo $producto['descuento']; ?>%</strong></p>
                            <p>Precio con descuento: $<?php echo number_format($producto['precio'] * (1 - $producto['descuento']/100), 2); ?> MXN</p>
                        <?php else: ?>
                            <p>Precio: $<?php echo number_format($producto['precio'], 2); ?> MXN</p>
                        <?php endif; ?>
                    </div>

                    <!-- Formulario para agregar al carrito -->
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $producto['id_produc']; ?>" />
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($producto['nombre']); ?>" />
                        <input type="hidden" name="product_price" value="<?php echo $producto['descuento'] > 0 ? $producto['precio'] * (1 - $producto['descuento']/100) : $producto['precio']; ?>" />
                        <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($producto['imagen_URL']); ?>" />
                        <input type="hidden" name="product_discount" value="<?php echo $producto['descuento']; ?>" />
                        <!-- Campo oculto para la cantidad -->
                        <input type="hidden" id="hidden-quantity-<?php echo $producto['id_produc']; ?>" name="quantity" value="1" />

                        <div class="quantity-controls">
                            <button type="button" class="button" onclick="decreaseQuantity('<?php echo $producto['id_produc']; ?>')">-</button>
                            <div id="quantity-<?php echo $producto['id_produc']; ?>" class="quantity-display">1</div>
                            <button type="button" class="button" onclick="increaseQuantity('<?php echo $producto['id_produc']; ?>')">+</button>
                        </div>

                        <button class="button2" type="submit" name="add_to_cart">Agregar al carrito</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <div class="footer">
   <span>Universidad Veracruzana</span>
   <span>Desarrollo Web</span>
   <span>Andrea Alejandra Lopez Mendez</span>
  </div>  

    <script src="producto.js"></script>
</body>
</html>