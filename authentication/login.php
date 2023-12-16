<?php
session_start();
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация - LIAMAS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body style="background-color: grey !important;"> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title text-center">Авторизация</h2>
                        <div id="error-container" class="alert alert-danger" style="display: none;"> 
                        </div>
                        <form action="./logic/login_logic.php" method="POST">
                            <div class="form-group">
                                <label for="username">Логин</label>
                                <input type="text" class="form-control" id="username" name="username" required pattern="[A-Za-z0-9]+">
                            </div>
                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="password" class="form-control" id="password" name="password" required pattern="[A-Za-z0-9]+">
                            </div>
                            <button type="submit" class="btn btn-success">Войти</button>
                        </form>
                        <div id="error-container" class="alert alert-danger" style="<?php echo isset($error) ? '' : 'display: none;'; ?>">
                            <?php if(isset($error)) echo $error; ?>
                        </div>
                        <p class="mt-3">Нет в системе? <a href="../authentication/register.php">Регистрация</a></p>
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
