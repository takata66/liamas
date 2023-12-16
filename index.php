<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIAMAS - Ювелирный Интернет-Магазин</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="/liamas/assets/css/fonts.css">
    <link rel="shortcut icon" href="/assets/img/pngtree-letter-l-and-a-medical-cross-vector-logo-design-png-image_5165447.png" type="image/png">
</head>
<body style= "background-color:white !important;">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/liamas/navbar/navbar.php';?>
    <div class="container-fluid p-0">
        <div id="main-banner" class="carousel slide" style="border-bottom:1px solid black;" data-ride="carousel">
            
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/banner-2.png" class="d-block w-100" alt="Баннер">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/main-banner.jpg" class="d-block w-100" alt="Баннер">
                </div>
            </div>
    
            <a class="carousel-control-prev" href="#main-banner" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Предыдущий</span>
            </a>
            <a class="carousel-control-next" href="#main-banner" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Следующий</span>
            </a>
        </div>
    </div>
    

   
    <footer class="footer bg-light fixed-bottom">
        <div class="container text-center">
            <span class="text-muted">&copy;LIAMAS. Все права защищены.</span>
        </div>
    </footer>

   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
