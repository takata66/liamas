<?php
session_start();

// Очистка всех переменных сессии
$_SESSION = array();

// Уничтожение сессии
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();


header("Location: /liamas/index.php");
exit();
?>
