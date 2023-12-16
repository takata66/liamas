<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liamas - Интернет Магазин</title>
    <link rel="stylesheet" href="vendor/styles/style.css">
    <link rel="stylesheet" href="/liamas/assets/css/fonts.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/liamas/navbar/navbar.php';?>
    
    <div class="container-fluid font-family-2" style="margin-top:100px; text-align: center;">
        <div class="row">
            <div class="col-md-12" style="font-size: 20px; ">
                <p>Добро пожаловать в <b>LIamas</b>, ваш эксклюзивный адрес в мире изысканных ювелирных изделий. <br>Наш новый магазин воплощает собой утонченность и элегантность, предлагая коллекции ювелирных изделий для истинных ценителей роскоши.
                    <br>Каждое наше украшение — это <b>шедевр</b>, созданный с непревзойденным мастерством. Наши дизайнеры сочетают в себе классическую эстетику с современными тенденциями, чтобы предложить вам уникальные изделия, которые вы не найдете нигде.
                    <br>В Liamas, мы ценим красоту, качество и эксклюзивность. Мы сотрудничаем только с лучшими мастерами и используем драгоценные камни высочайшего качества для создания ювелирных изделий, достойных вашего особого момента.
                    <br>Загляните в наш <a href="catalog/catalog.php"><b>магазин</b></a>, чтобы ощутить неповторимое сочетание роскоши и изысканности. Мы с нетерпением ждем возможности помочь вам найти тот самый уникальный аксессуар или подарок, который станет символом ваших самых запоминающихся моментов.
                </p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="col-12" style="font-size:30px;">
                    Контакты для связи
                </div>
                <div class="row">
                    <div class="col-md-4" style="font-size:20px; color:black">
                        <p>Телефон: +7 (888) 888 - 82 - 28</p>
                    </div>
                    <div class="col-md-4" style="font-size:20px; color:black">
                        <p><a href="https://t.me/ssuenoo" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Telegram</a></p>
                    </div>
                    <div class="col-md-4" style="font-size:20px; color:black">
                        <p><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">VK</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer bg-light fixed-bottom">
        <div class="container text-center">
            <span class="text-muted">&copy; 2023 LIAMAS</span>
        </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
