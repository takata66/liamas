<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Корзина - Ювелирный Магазин LIAMAS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/cart_style.css">
    <link rel="stylesheet" href="/liamas/assets/css/fonts.css">
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/liamas/navbar/navbar.php';?>

<div class="container mt-4 font-family-1">
    <div class="row">
        <div class="col-lg-9">
            <div id="cart-items">
                <!-- Товары -->
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ваша корзина</h5>
                    <div class="card-text">
                        <p class="font-weight-bold text-success total-price-text mb-4" id="total-price"></p>
                        <p class="font-weight-bold mb-4">Выберите способ оплаты</p>
                    </div>
                    <select id="payment-method" class="form-control mb-3">
                        <option value="card">Картой при получении</option>
                        <option value="sbp">по СБП при получении</option>
                        <option value="cash">Наличными при получении</option>
                    </select>
                    <a href="#" class="btn btn-agree btn-block mb-4 button" id="checkout">Перейти к оформлению</a>
                    <small class="text-muted">Адрес доставки можно выбрать при оформлении заказа</small>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Оформление заказа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="order-summary"></div>
                <input type="text" id="full-name" class="form-control my-3" placeholder="Полное имя">
                <div id="map" style="width: 100%; margin-bottom: 10px; height: 300px;"></div>
                <input type="text" id="address" class="form-control"  placeholder="Адрес">
                <input type="text" id="apartment" class="form-control my-3" style="margin-bottom: 20px;" placeholder="Квартира">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="privateHouseCheckbox">
                    <label class="form-check-label" for="privateHouseCheckbox">
                        Частное здание
                    </label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" id="confirm-order">Подтвердить заказ</button>
            </div>
        </div>
    </div>
</div>

<footer class="footer bg-light fixed-bottom">
    <div class="container text-center">
        <span class="text-muted">&copy;LIAMAS. Все права защищены.</span>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script/cart_script.js"></script>
<script src="https://api-maps.yandex.ru/2.1/?apikey=a9f34e6f-302c-4b52-bfaa-89e80dd2da72&lang=ru_RU" type="text/javascript"></script>

</body>
</html>
