<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Ювелирный Каталог</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style/catalog_style.css">
    <link rel="stylesheet" href="/liamas/assets/css/fonts.css">
</head>
<body class="font-family-2">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/liamas/navbar/navbar.php';?>
    
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-2 mt-4">
                <div id="categories-container" class="btn-group-vertical">
                    <!-- Категории -->
                </div>
                <div id="notification" class="alert" role="alert" style="display: none; margin-top:10px; bottom: 20px; right: 20px; background-color:#A7D6FA">
                    Товар добавлен в корзину!
                </div>
            </div>
            <div class="col-md-10 ">
                <div class="row" id="products-container">
                    <!-- Товары -->
                </div>
            </div>
        </div>
    </div>

    <footer class="footer bg-light fixed-bottom">
            <div class="container text-center">
                <span class="text-muted">&copy; 2023 LIAMAS</span>
            </div>
    </footer>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script/catalog_script.js"></script>
</body>
</html>
