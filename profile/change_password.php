<?php 
session_start();
$isAdmin = false;
if ($_SESSION['role'] == 'admin') {
    $isAdmin = true;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="/liamas/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="style/user_profile_style.css">
    <link rel="stylesheet" href="/liamas/assets/css/fonts.css">
</head>
<body class="font-family-3">

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/liamas/navbar/navbar.php';?>

    <div class="container-fluid mt-3">    
        <div class="row">
            <div class="col-2">
                <a href="/liamas/orders/orders.php" class="btn btn-block rounded custom-button">Ваши заказы</a>
                <a href="/liamas/profile/change_password.php" class="btn btn-block rounded custom-button">Изменить пароль</a>
                <a href="/liamas/about.php" class="btn btn-block rounded custom-button">Поддержка</a>
                <?php if ($isAdmin){echo '<a href="/liamas/admin/admin_panel.php" class="btn btn-block rounded custom-button custom-button-admin">Админ панель</a>';}?>
                <a href="/liamas/profile/logout.php" class="btn btn-block rounded custom-button custom-button-exit">Выйти</a>
            </div>

            <div class="col-10">
                <div class="card">
                    <div class="card-body" style="background-color:white">
                        <h2 class="card-title text-center">Сменить пароля</h2>
                            <?php if (isset($_SESSION['error_message'])): ?>
                                <div class="alert alert-danger" role="alert">
                                <?= $_SESSION['error_message']; ?>
                            <?php unset($_SESSION['error_message']); ?>
                            </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['success_message'])): ?>
                            <div class="alert alert-success" role="alert">
                                <?= $_SESSION['success_message']; ?>
                                <?php unset($_SESSION['success_message']); ?>
                            </div>
                            <?php endif; ?> 
                        <form action="/liamas/profile/logic/change_password_logic.php" method="post" id="changePasswordForm">
                            <div class="form-group">
                                <label for="oldPassword">Старый пароль:</label>
                                <input type="password" class="form-control" id="oldPassword" name="old_password" required>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">Новый пароль:</label>
                                <input type="password" class="form-control" id="newPassword" name="new_password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Подтвердите новый пароль:</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-block form-buttons">Сменить пароль</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <script src="/liamas/assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="/liamas/assets/js/popper.min.js"></script>
    <script src="/liamas/assets/js/bootstrap.min.js"></script>
    <script>
         $(document).ready(function() {
            $('#changePasswordForm').on('submit', function(e) {
                var newPassword = $('#newPassword').val();
                var confirmPassword = $('#confirmPassword').val();

                if (newPassword !== confirmPassword) {
                    alert('Новый пароль и подтверждение пароля не совпадают.');
                    e.preventDefault(); 
                }
            });
        });
    </script>                           

</body>
</html>