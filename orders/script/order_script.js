function updateOrderStatusColors() {
    document.querySelectorAll('.card-status').forEach((element) => {
        const status = element.getAttribute('data-status');
        switch (status) {
            case 'обработан':
                element.style.color = '#87a5ff';
                break;
            case 'отправлен':
                element.style.color = '#FA665F'
                break;
            case 'доставлен':
                element.style.color = '#19F7A4';
                break;
            default:
                element.style.color = 'black';
                break;
        }
    });
}


function loadOrders() {
    
    fetch('logic/load_order_items.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('orders-container').innerHTML = data;
            
            updateOrderStatusColors();
        })
        .catch(error => {
            console.error('Ошибка при загрузке заказов:', error);
        });
}


document.addEventListener('DOMContentLoaded', loadOrders);