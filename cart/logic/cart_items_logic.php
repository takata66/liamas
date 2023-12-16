<?php
session_start();


require_once "../../database/database.php";


if (!isset($_SESSION['user_id'])) {
    echo "<div class='alert alert-warning' role='alert'>Пожалуйста, авторизуйтесь для просмотра корзины.</div>";
    exit;
}

$userId = $_SESSION['user_id'];


$query = "SELECT p.product_id, p.image_url, p.name, p.description, c.quantity, p.price, (c.quantity * p.price) as total_price
          FROM Cart c
          JOIN Products p ON c.product_id = p.product_id
          WHERE c.user_id = ?";

$isCartEmpty = true; 
$totalPrice = 0;

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $isCartEmpty = false;
        
        while ($row = $result->fetch_assoc()) {
            echo "<div class='cart-item d-flex justify-content-between align-items-center mb-3'>";
            
            
            echo "<div class='product-image'>";
            echo "<img src='" . htmlspecialchars($row['image_url']) . "' alt='" . htmlspecialchars($row['name']) . "' style='width: 150px; height: 150px; object-fit: cover;'>";
            echo "</div>";
            
           
            echo "<div class='product-details'>";
            echo "<h5 class='product-title'>" . htmlspecialchars($row['name']) . "</h5>";
            echo "<button class='btn btn-dark custom-button btn-sm remove-from-cart' data-product-id='" . htmlspecialchars($row['product_id']) . "'>Удалить</button>";
            echo "</div>";
            
            
            echo "<div class='product-quantity'>";
            echo "<button class='btn btn-outline-secondary btn-sm decrease-quantity' data-product-id='" . htmlspecialchars($row['product_id']) . "'>-</button>"; 
            echo "<span class='quantity mx-2'>" . htmlspecialchars($row['quantity']) . "</span>";
            echo "<button class='btn btn-outline-secondary btn-sm increase-quantity' data-product-id='" . htmlspecialchars($row['product_id']) . "'>+</button>";
            echo "</div>";
            
            echo "<div class='product-price'>";
            echo "<span>" . htmlspecialchars($row['price']) . " руб.</span>";
            echo "</div>";
            
            echo "</div>"; 
            $totalPrice += $row['price'] * $row['quantity'];
        }
        
    } else {
        echo "<div class='alert alert-info' role='alert'>Ваша корзина пуста.</div>";
    }

    $stmt->close();
} else {
    echo "<div class='alert alert-danger' role='alert'>Ошибка при выполнении запроса к базе данных.</div>";
}   
echo "<script>var totalPrice = $totalPrice;</script>";

$conn->close();

echo "<script>var isCartEmpty = " . ($isCartEmpty ? 'true' : 'false') . ";</script>";
?>
