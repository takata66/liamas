<?php 
session_start();

include '../database/database.php'; 

$user_id = $_SESSION['user_id']; 
$query = "SELECT surname, first_name, middle_name, date_of_birth FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

$user_data = mysqli_fetch_assoc($result);

// Проверка, заполнены ли все поля
$all_fields_filled = !empty($user_data['surname']) && !empty($user_data['first_name']) && !empty($user_data['middle_name']) && !empty($user_data['date_of_birth']);

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
            <div class="col-md-2 order-2 order-md-1">
                <a href="/liamas/orders/orders.php" class="btn btn-block rounded custom-button">Ваши заказы</a>
                <a href="/liamas/profile/change_password.php" class="btn btn-block rounded custom-button">Изменить пароль</a>
                <a href="/liamas/about.php" class="btn btn-block rounded custom-button">Поддержка</a>
                <?php if ($isAdmin){echo '<a href="/liamas/admin/admin_panel.php" class="btn btn-block rounded custom-button custom-button-admin">Админ панель</a>';}?>
                <a href="/liamas/profile/logout.php" class="btn btn-block rounded custom-button custom-button-exit">Выйти</a>
            </div> 
            <div class="col-md-10 order-1 order-md-2">
                <div class="card">
                    <div class="card-body" style="background-color:white">
                        <h2 class="card-title text-center">Личные данные</h2>
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
                        <form action="/liamas/profile/logic/update_profile_logic.php" method="post">
                            <div class="form-group">
                                <label for="firstName">Имя:</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" required value="<?php echo htmlspecialchars($user_data['first_name'] ?? ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="surname">Фамилия:</label>
                                <input type="text" class="form-control" id="surname" name="surname" required value="<?php echo htmlspecialchars($user_data['surname'] ?? ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="middleName">Отчество:</label>
                                <input type="text" class="form-control" id="middleName" name="middle_name" required value="<?php echo htmlspecialchars($user_data['middle_name'] ?? ''); ?>">
                            </div>
                            <div class="form-group">
                                <label for="dateOfBirth">Дата рождения:</label>
                                <input type="date" class="form-control" id="dateOfBirth" name="date_of_birth" required value="<?php echo htmlspecialchars($user_data['date_of_birth'] ?? ''); ?>">
                            </div>
                            <button type="submit" class="btn btn-block form-buttons" <?php if ($all_fields_filled) echo 'disabled'; ?>>Сохранить изменения</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/liamas/assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="/liamas/assets/js/popper.min.js"></script>
    <script src="/liamas/assets/js/bootstrap.min.js"></script>
    <script src="/liamas/profile/script/profile.js"></script>
                                
</body>
</html>