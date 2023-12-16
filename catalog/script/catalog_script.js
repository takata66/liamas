function loadProductsByCategory(categoryId) {
    $.ajax({
        url: 'logic/catalog_logic.php',
        type: 'post',
        dataType: 'json',
        data: { action: 'loadProducts', categoryId: categoryId },
        success: function(response) {
            var productsContainer = $('#products-container');
            productsContainer.empty();
            $.each(response, function(index, product) {
                var productHtml = '<div class="col-md-3 mb-4">' +
                                  '<div class="card">' +
                                  '<img src="' + product.image_url + '" class="card-img-top" alt="' + product.name + '">' +
                                  '<div class="card-body">' +
                                  '<h5 class="card-title">' + product.name + '</h5>' +
                                  '<p class="card-text">Цена: ' + product.price + ' руб.</p>' +
                                  '<button class="btn add-to-cart" data-product-id="' + product.product_id + '">Добавить в корзину</button>' +
                                  '</div>' +
                                  '</div>' +
                                  '</div>';
                productsContainer.append(productHtml);
            });
        },
        error: function() {
            $('#products-container').html('<p>Произошла ошибка при загрузке продуктов.</p>');
        }
    });
}




function loadCategories() {
    $.ajax({
        url: 'logic/catalog_logic.php',
        type: 'post',
        dataType: 'json',
        data: { action: 'loadCategories' },
        success: function(categories) {
            var categoriesContainer = $('#categories-container');
            categoriesContainer.empty();
            categoriesContainer.append('<button class="btn btn-category" onclick="loadProductsByCategory(\'\')">Все категории</button>');
            $.each(categories, function(index, category) {
                categoriesContainer.append('<button class="btn btn-category" onclick="loadProductsByCategory(\'' + category.category_id + '\')">' + category.name + '</button>');
            });
        }
    });
}

$(document).ready(function() {
    loadCategories();
    loadProductsByCategory('');

    $(document).on('click', '.btn-category', function() {
        $('.btn-category').removeClass('active');
        $(this).addClass('active');
    });
    
});


$(document).on('click', '.card', function() {
    var productId = $(this).data('product-id');
    window.location.href = 'product_details.php?product_id=' + productId;
});


$(document).on('click', '.add-to-cart', function() {
    var productId = $(this).data('product-id');
    $.ajax({
        url: '/liamas/cart/logic/cart_logic.php',
        type: 'post',
        data: { action: 'addToCart', product_id: productId },
        success: function(response) {
            showNotification("Товар добавлен в корзину!");
        },
        error: function() {
            showNotification("Ошибка при добавлении в корзину.", true);
        }
        });
    });

    function showNotification(message, isError = false) {
        var notification = $('#notification');
        notification.text(message);

        if (isError) {
            notification.removeClass('alert-success').addClass('alert-danger');
        } else {
            notification.removeClass('alert-danger').addClass('alert-success');
        }

        notification.show();

        setTimeout(function() {
            notification.fadeOut('slow');
        }, 3000); 
    }