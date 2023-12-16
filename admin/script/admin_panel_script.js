function loadAdminProducts() {
    $.ajax({
        url: 'logic/admin_panel_logic.php',
        type: 'post',
        dataType: 'json',
        data: { action: 'loadAdminProducts' },
        success: function(response) {
            var adminProductsContainer = $('#admin-products-container');
            adminProductsContainer.empty();
            $.each(response, function(index, product) {
                var productHtml = '<div class="col-md-4 mb-4">' +
                                  '<div class="card">' +
                                  '<img src="' + product.image_url + '" class="card-img-top" alt="' + product.name + '">' +
                                  '<div class="card-body">' +
                                  '<h5 class="card-title">' + product.name + '</h5>' +
                                  '<p class="card-text">' + product.description + '</p>' +
                                  '<p class="card-text">Цена: ' + product.price + ' руб.</p>' +
                                  '<button class="btn btn-danger delete-product" data-product-id="' + product.product_id + '">Удалить</button>' +
                                  '</div>' +
                                  '</div>' +
                                  '</div>';
                adminProductsContainer.append(productHtml);
            });
        },
        error: function() {
            $('#admin-products-container').html('<p>Произошла ошибка при загрузке продуктов.</p>');
        }
    });
}

$(document).ready(function() {
    loadAdminProducts();
});

$(document).on('click', '.delete-product', function() {
    var productId = $(this).data('product-id');
    $.ajax({
        url: 'logic/admin_panel_logic.php',
        type: 'post',
        data: { action: 'deleteProduct', product_id: productId },
        success: function(response) {
            loadAdminProducts(); 
        },
        error: function() {
            alert("Ошибка при удалении товара.");
        }
    });
});
$(document).ready(function() {
    $.ajax({
        url: 'logic/get_categories_logic.php', 
        type: 'get',
        dataType: 'json',
        success: function(categories) {
            var select = $('#productCategory');
            categories.forEach(function(category) {
                select.append('<option value="' + category.category_id + '">' + category.name + '</option>');
            });
        },
        error: function() {
            alert("Ошибка при загрузке категорий.");
        }
    });
});