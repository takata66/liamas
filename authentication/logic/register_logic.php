<?php
session_start(); 


require_once "../../database/database.php"; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    
    if ($password != $confirm_password) {
        $_SESSION['error'] = 'Пароли не совпадают';
        header("Location: /liamas/authentication/register.php");
        exit;
    }

   
    $check_query = "SELECT * FROM Users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        
        $_SESSION['error'] = 'Логин или электронная почта уже используются';
        header("Location: /liamas/authentication/register.php");
        exit;
    } else {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = "customer"; 
        $insert_query = "INSERT INTO Users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);
        if ($stmt->execute()) {
            
            $_SESSION['success'] = 'Регистрация успешна. Вы можете войти в систему.';
            header("Location: /liamas/authentication/login.php");
            exit;
        } else {
            
            $_SESSION['error'] = 'Произошла ошибка при регистрации';
            header("Location: /liamas/authentication/register.php");
            exit;
        }
    }
}
?>
