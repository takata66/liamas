<?php
session_start(); 


require_once "../../database/database.php"; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $sql = "SELECT user_id, username, password, role FROM Users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $stmt->close();
            $conn->close();
            
            header("Location: /liamas/index.php");
            exit;
        } else {
            
            $_SESSION['error'] = 'Неверный пароль';
            $stmt->close();
            $conn->close();
            header("Location: /liamas/authentication/login.php");
            exit;
        }
    } else {
        
        $_SESSION['error'] = 'Пользователь не найден';
        $stmt->close();
        $conn->close();
        header("Location: /liamas/authentication/login.php");
        exit;
    }
}
?>
