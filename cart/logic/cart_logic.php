<?php
session_start();


require_once "../../database/database.php";


if (isset($_POST['action']) && $_POST['action'] == 'addToCart' && isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];

    
    $checkCart = $conn->prepare("SELECT * FROM Cart WHERE user_id = ? AND product_id = ?");
    $checkCart->bind_param("ii", $userId, $productId);
    $checkCart->execute();
    $result = $checkCart->get_result();

    if ($result->num_rows > 0) {
        
        $updateCart = $conn->prepare("UPDATE Cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?");
        $updateCart->bind_param("ii", $userId, $productId);
        $updateCart->execute();
    } else {
        
        $addToCart = $conn->prepare("INSERT INTO Cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
        $addToCart->bind_param("ii", $userId, $productId);
        $addToCart->execute();
    }

    echo "Товар добавлен в корзину";
} else {
    echo "Ошибка: Пользователь не авторизован или неверный запрос";
}
?>
