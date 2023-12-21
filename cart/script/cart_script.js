$(document).ready(function() {

    function updateCheckoutButton() {
        if (typeof isCartEmpty !== 'undefined' && isCartEmpty) {
            $('#checkout').prop('disabled', true);
        } else {
            $('#checkout').prop('disabled', false);
        }
    }
    
    function loadCartItems() {
        $.ajax({
            url: 'logic/cart_items_logic.php', 
            type: 'post',
            success: function(response) {
                $('#cart-items').html(response);
                if (typeof totalPrice !== 'undefined') {
                    $('#total-price').text(totalPrice +' руб.');
                }
                updateCheckoutButton();
            },
            error: function() {
                $('#cart-items').html('<div class="col">Произошла ошибка при загрузке корзины.</div>');
            }
        });
    }

    loadCartItems();
    
    $(document).on('click', '.increase-quantity', function() {
        var productId = $(this).data('product-id');

        $.ajax({
        url: 'logic/increase_quantity.php', 
        type: 'post',
        data: { product_id: productId },
        success: function(response) {
            if (response === 'success') {
                loadCartItems();
            } else {
                alert('Ошибка при увеличении количества товара');
            }
        }
    });
    });

    $(document).on('click', '.decrease-quantity', function() {
        var productId = $(this).data('product-id');
        $.ajax({
        url: 'logic/decrease_quantity.php', 
        type: 'post',
        data: { product_id: productId },
        success: function(response) {
            if (response === 'success') {
                loadCartItems();
            } else {
                alert('Ошибка при уменьшении количества товара');
            }
        }
    });
    });

    $(document).on('click', '.remove-from-cart', function() {
        var productId = $(this).data('product-id');
        $.ajax({
        url: 'logic/remove_from_cart.php',
        type: 'post',
        data: { product_id: productId },
        success: function(response) {
            if (response === 'success') {
                loadCartItems();
            } else {
                alert('Ошибка при удалении товара из корзины');
            }
        }
    });
    });
    function fillOrderSummary() {
        var summaryHtml = '';
        var totalPrice = $('#total-price').text();
        $('#cart-items .cart-item').each(function() {
            var productName = $(this).find('.product-title').text();
            var productPrice = $(this).find('.product-price span').text();
            var productImage = $(this).find('.product-image img').attr('src');
            summaryHtml += '<div class="order-item"><img src="' + productImage + '" alt="' + productName + '" style="width: 50px; height: 50px;"/> ' + productName + '  ' + productPrice + '</div>';
    });

        summaryHtml += '<div class="total-price" style="text-align: right; margin-top: 20px; font-weight: bold;">Общая сумма: ' + totalPrice + '</div>';
        $('#order-summary').html(summaryHtml);
    }

    $(document).on('change', '#privateHouseCheckbox', function() {
        if ($(this).is(':checked')) {
            $('#apartment').val('Частное здание').prop('disabled', true);
        } else {
            $('#apartment').val('').prop('disabled', false);
        }
    });
    function clearCart() {
        $.ajax({
            url: 'logic/clear_cart.php',
            type: 'post',
            success: function(response) {
                if (response === 'success') {
                    console.log('Корзина очищена');
                    loadCartItems(); 
                } else {
                    console.log('Ошибка при очистке корзины');
                }
            }
        });
    }
    $(document).on('click', '#confirm-order', function() {
        var paymentMethod = $('#payment-method').val();
        var totalPrice = $('#total-price').text();
        var fullName = $('#full-name').val();
        var address = $('#address').val();
        var apartment = $('#apartment').val();
    
        $.ajax({
            url: 'logic/create_order.php',
            type: 'post',
            data: {
                payment_method: paymentMethod,
                total_price: totalPrice,
                full_name: fullName,
                address: address,
                apartment: apartment
            },
            success: function(response) {
                if (response === 'success') {
                    alert('Заказ успешно оформлен');
                    $('#orderModal').modal('hide');
                    clearCart();
                } else if (response === 'error_empty_fields') {
                    alert('Ошибка: Поля "Имя" и "Адрес" и "Квартира" должны быть заполнены.');
                } else {
                    alert('Ошибка запроса к базе данных');
                }
            }
        });
    });
    ymaps.ready(init); 
    function init() {
        var myMap = new ymaps.Map("map", {
            center: [55.76, 37.64], 
            zoom: 10
        });
    
        myMap.events.add('click', function (e) {
            var coords = e.get('coords');
    
            
            ymaps.geocode(coords).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0);
                var address = firstGeoObject.getAddressLine();
    
                $('#address').val(address);
            });
        });
    }
    $(document).on('click', '#checkout', function() {
        fillOrderSummary();
        $('#orderModal').modal('show');
    }); 
});
   
