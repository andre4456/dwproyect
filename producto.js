//botones de -a+ y agregar carrito
function increaseQuantity(productId) {
    const quantityDisplay = document.getElementById(`quantity-${productId}`);
    const hiddenQuantity = document.getElementById(`hidden-quantity-${productId}`);
    let currentQuantity = parseInt(quantityDisplay.textContent);
    quantityDisplay.textContent = currentQuantity + 1;
    hiddenQuantity.value = currentQuantity + 1; // Actualiza el campo oculto
}

function decreaseQuantity(productId) {
    const quantityDisplay = document.getElementById(`quantity-${productId}`);
    const hiddenQuantity = document.getElementById(`hidden-quantity-${productId}`);
    let currentQuantity = parseInt(quantityDisplay.textContent);
    if (currentQuantity > 1) {
        quantityDisplay.textContent = currentQuantity - 1;
        hiddenQuantity.value = currentQuantity - 1; // Actualiza el campo oculto
    }
}


//menu
function updateCartCount() {
document.getElementById('cart-count').textContent = cartCount;
}

function toggleMenu() {
const menu = document.getElementById('menu');
menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

let currentPromoIndex = 0; // Índice de la promoción actual
const flyers = document.querySelectorAll('.welcome-flyer'); // Selecciona todos los flyers
const radioButtons = document.querySelectorAll('.radio-buttons input'); // Selecciona los radio buttons
const totalPromos = flyers.length; // Número total de promociones
const intervalTime = 5000; // Intervalo en milisegundos (5 segundos)

// Función para mostrar una promoción específica
function showPromo(index) {
// Oculta todos los flyers
flyers.forEach(flyer => flyer.classList.remove('active'));
// Marca el radio button correspondiente
radioButtons.forEach(radio => radio.checked = false);
// Muestra el flyer y activa el radio button correspondiente
flyers[index].classList.add('active');
radioButtons[index].checked = true;
}

// Función para avanzar al siguiente flyer
function nextPromo() {
currentPromoIndex = (currentPromoIndex + 1) % totalPromos; // Cicla los índices
showPromo(currentPromoIndex);
}

// Inicia el intervalo para rotar las promociones automáticamente
setInterval(nextPromo, intervalTime);

//no borrar menu
function toggleMenu() {
const menu = document.getElementById('menu');
// Alterna la propiedad display entre none y block
if (menu.style.display === 'block') {
menu.style.display = 'none';
} else {
menu.style.display = 'block';
}
}
