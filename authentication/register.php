<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - LIAMAS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body style= "background-color:#F3F4F7!important;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title text-center">Регистрация</h2>
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
                            unset($_SESSION['error']); 
                        }
                        ?>

                        
                        <form action="./logic/register_logic.php" method="POST">
                            <div class="form-group">
                                <label for="username">Имя пользователя</label>
                                <input type="text" class="form-control" id="username" name="username" required pattern="[A-Za-z0-9]+">
                            </div>
                            <div class="form-group">
                                <label for="email">Электронная почта</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="password" class="form-control" id="password" name="password" required pattern="[A-Za-z0-9]+">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Подтверждение пароля</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required pattern="[A-Za-z0-9]+">
                            </div>
                            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                        </form>
                        <p class="mt-3">Уже зарегистрированы? <a href="./login.php">Войти</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
