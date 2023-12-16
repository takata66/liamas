<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказы</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/liamas/assets/css/fonts.css">
    <link rel="stylesheet" href="style/order.css">
    
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/liamas/navbar/navbar.php'; ?>

    <div class="container font-family-2">
        <h1 class="my-4 ml-4">Заказы</h1>
        <div id="orders-container"></div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script/order_script.js"></script>
</body>
</html>
