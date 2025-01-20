<!DOCTYPE html>
<html>
<head>
    <title>Bienvenidos</title>
    <link rel="stylesheet" href="principa.css"/>
</head>
<body>
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
    
    <div class="menu" id="menu">
        <div>
            <img src="iconos/cruz.png" onclick="toggleMenu()" class="close-icon">
        </div>
        <ul>
            <li><a href="bienvenido.html">Inicio</a></li>
            <li><a href="Productos.php">Catalogo</a></li>
            <li><a href="ayuda.php">Ayuda</a></li>
        </ul>
    </div>
    <h1>Hola, Bienvenido</h1>
    <div class="carousel-container">
        <div class="welcome-flyer active">
            <img class="promo-img" src="imagenes/principalflayer.jpg" alt="Promoción 1">
        </div>

        <!-- Promoción 2 -->
        <div class="welcome-flyer">
            <img class="promo-img" src="imagenes/despensaflayer.jpg" alt="Promoción 2">
            <button onclick="window.location.href='explorar3.html'" class="boton-productos">Explorar Productos</button>
        </div>

        <!-- Promoción 3 -->
        <div class="welcome-flyer">
            <img class="promo-img" src="imagenes/pastaflayer.jpg" alt="Promoción 3">
            <button onclick="window.location.href='explorar2.html'" class="boton-productos">Explorar Productos</button>
        </div>

        <!-- Promoción 4 -->
        <div class="welcome-flyer">
            <img class="promo-img" src="imagenes/piernaflayer.jpg" alt="Promoción 4">
            <button onclick="window.location.href='explorar4.html'" class="boton-productos"">Explorar Productos</button>
        </div>

    <!-- Radio Buttons para Navegar entre Promociones -->
    <div class="radio-buttons">
        <input type="radio" id="promo1" name="promo" checked>
        <label for="promo1"></label>
        <input type="radio" id="promo2" name="promo">
        <label for="promo2"></label>
        <input type="radio" id="promo3" name="promo">
        <label for="promo3"></label>
        <input type="radio" id="promo4" name="promo">
        <label for="promo4"></label>
    </div>
</div>
<div class="cate">
    <h2 class="titulo">Categorias</h2>
  <div class="coin">
   <div class="item">
    <h2>Verduras y Frutas</h2>
    <img alt="Verduras y Frutas" height="200" src="imagenes/frutasyverduras.png" width="100"/>
   </div>
   
   <div class="item">
    <h2>Semillas y Chiles Secos</h2>
    <img alt="Semillas y Chiles Secos" height="200" src="imagenes/semillasychiles.png" width="100"/>
    <p class="discount"></p>
    <p class="price"></p>
    <p class="savings"></p>
    <p class="bank"></p>
   </div>
   
   <div class="item">
    <h2>Lacteos, Carnes y Embutidos</h2>
    <img alt="Lacteos, Carnes y Embutidos" height="200" src="imagenes/lacteoscarnes.png" width="100"/>
   </div>
   
   <div class="item">
    <h2>Abarrotes en General</h2>
    <img alt="Abarrotes en General" height="200" src="imagenes/Abarrotesgeneral.png" width=100"/>
   </div>
   
   <div class="item">
    <h2>Mascotas y Accesorios</h2>
    <img alt="Mascotas y Accesorios" height="200" src="imagenes/mascotasyaccesorios.png" width="100/>
    <p class="price"> </p>
   </div>
   
   <div class="item">
    <h2>Productos de Limpieza</h2>
    <img alt="Productos de Limpieza" height="200" src="imagenes/detergentesylimpieza.png" width="100"/>
   </div>
   
  </div>
   </div>  
    	    <div class="about-section">
        <img src="imagenes/acerca.png" alt="Abarrotes La Sombrita" />
        <div class="about-text">
            <h2>Acerca de Nosotros</h2>
            <p>En Abarrotes La Sombrita, nos dedicamos a ser tu tienda de confianza, ofreciendo productos de alta calidad a precios justos para el hogar. Desde que abrimos nuestras puertas, nos hemos enfocado en satisfacer las necesidades de nuestra comunidad con una selección variada de alimentos frescos, productos de limpieza, artiículos de higiene personal y mucho más.</p>
            <p>Nuestro compromiso es brindarte una experiencia de compra agradable y accesible, donde encuentres todo lo que necesitas en un solo lugar. Valoramos la cercanía y el trato amable, porque para nosotros, cada cliente es como un vecino y amigo. Por eso, nos esforzamos en seleccionar productos de las mejores marcas y ofrecer un servicio personalizado, siempre atentos a lo que necesitas.</p>

        </div>
            <div class="espacio"> </div>
    </div>
    <div class="footer">
   <span>Universidad Veracruzana</span>
   <span>Desarrollo Web</span>
   <span>Andrea Alejandra Lopez Mendez</span>
  </div>  

    <script src="menuyflayer"></script>
</body>
</html>
