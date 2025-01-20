document.getElementById('paymentForm').addEventListener('submit', function(event) {
    event.preventDefault();

    document.querySelectorAll('.error').forEach(error => error.textContent = '');

    let isValid = true;


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
                // [Your existing success modal code]
            } else {
                // More detailed error handling
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

const expiryDateInput = document.getElementById('expiryDate');
const currentDate = new Date();
const [month, year] = expiryDateInput.value.split('/').map(Number);
const expiryDate = new Date(2000 + year, month - 1);

if (expiryDate <= currentDate) {
    document.getElementById('expiryDateError').textContent = 'La tarjeta está vencida';
    isValid = false;
}