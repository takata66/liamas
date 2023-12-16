<?php
session_start();
require_once('../../database/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password']; 
    $user_id = $_SESSION['user_id'];

    
    if ($new_password !== $confirm_password) {
        $_SESSION['error_message'] = "Новый пароль и подтверждение пароля не совпадают.";
        header('Location: /liamas/profile/change_password.php');
        exit();
    }

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $_SESSION['error_message'] = "Ошибка соединения с базой данных: " . $conn->connect_error;
        header('Location: /liamas/profile/change_password.php');
        exit();
    }

    $sql = "SELECT password FROM Users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($old_password, $hashed_password)) {
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            $update_sql = "UPDATE Users SET password = ? WHERE user_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $new_hashed_password, $user_id);
            $update_stmt->execute();

            if ($update_stmt->affected_rows > 0) {
                $_SESSION['success_message'] = "Пароль успешно изменен.";
            } else {
                $_SESSION['error_message'] = "Ошибка при изменении пароля.";
            }

            $update_stmt->close();
        } else {
            $_SESSION['error_message'] = "Неправильный старый пароль.";
        }
    } else {
        $_SESSION['error_message'] = "Пользователь не найден.";
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION['error_message'] = "Некорректный запрос.";
}

header('Location: /liamas/profile/user_profile.php');
exit();
?>
