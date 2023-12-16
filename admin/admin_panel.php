<?php
session_start();
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    // Пользователь не аутентифицирован или не админ, перенаправляем на страницу входа
    header('Location: /liamas/authentication/login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
    <title>Админ панель</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/liamas/admin/style/admin_panel.css">
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/liamas/navbar/navbar.php';?>
    
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="row" id="admin-products-container">
                    <!-- Товары  -->
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
    <h2>Добавление нового товара</h2>
    <form action="logic/add_product_logic.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="productName">Название товара</label>
            <input type="text" class="form-control" id="productName" name="name" required>
        </div>
        <div class="form-group">
            <label for="productDescription">Описание товара</label>
            <textarea class="form-control" id="productDescription" name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="productPrice">Цена</label>
            <input type="number" class="form-control" id="productPrice" name="price" required>
        </div>
        <div class="form-group">
            <label for="productCategory">Категория</label>
            <select class="form-control" id="productCategory" name="category_id">
                <!-- Категории was here -->
            </select>
        </div>
        <div class="form-group">
            <label for="productImageUrl">URL изображения товара</label>
            <input type="text" class="form-control" id="productImageUrl" name="image_url">
        </div>
        <button type="submit" class="btn btn-primary">Добавить товар</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="script/admin_panel_script.js"></script>


</body>
</html>