<?php
session_start();
require_once "../../database/database.php";

if (!isset($_SESSION['user_id'])) {
    echo "<div class='alert alert-warning'>Пожалуйста, авторизуйтесь для просмотра заказов.</div>";
    exit;
}

$userId = $_SESSION['user_id'];

$query = "SELECT * FROM orders WHERE user_id = ?";
if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $orders = $stmt->get_result();
    if ($orders->num_rows > 0) {
        echo "<div class='container'>"; 
        echo "<div class='row'>"; 
        while ($order = $orders->fetch_assoc()) {
            $product_ids = json_decode($order['product_id'], true);
            $formatted_date = date("d.m.Y", strtotime($order['order_date'])); 
    
            echo "<div class='col-12 col-sm-6'>"; 
            echo "<div class='card order-card mb-3' style='height: 500px; display: flex; flex-direction: column;'>";
            echo "<div class='card-body' style='padding: 20px; display: flex; flex-direction: column;'>";

            // Order header
            echo "<div class='d-flex justify-content-between align-items-center'>";
            echo "<h5 class='card-title'>Заказ №" . htmlspecialchars($order['order_id']) . "</h5>";
            echo "<p class='card-date'><small class='text-muted'>" . $formatted_date . "</small></p>";
            echo "</div>";
            echo "<p class='card-status' data-status='" . htmlspecialchars($order['status']) . "'>" . htmlspecialchars($order['status']) . "</p>";

            // Scrollable product list
            echo "<div class='product-list' style='flex-grow: 1; overflow-y: auto;'>";
            $total_price = 0;
            foreach ($product_ids as $pid) {
                $product_query = "SELECT * FROM products WHERE product_id = ?";
                if ($product_stmt = $conn->prepare($product_query)) {
                    $product_stmt->bind_param("i", $pid['product_id']);
                    $product_stmt->execute();
                    $product_result = $product_stmt->get_result();
    
                    if ($product_result->num_rows > 0) {
                        while ($product = $product_result->fetch_assoc()) {
                            $quantity = $pid['quantity']; // Get the quantity
                            echo "<div class='d-flex justify-content-between mb-2'>";
                            echo "<div class='d-flex align-items-center'>";
                            echo "<img src='" . htmlspecialchars($product['image_url']) . "' alt='" . htmlspecialchars($product['name']) . "' class='product-image mr-2'>";
                            echo "<div class='product-info'>"; 
                            echo "<p class='product-name mb-0'>" . htmlspecialchars($product['name']) . " ($quantity)</p>"; // Display quantity
                            echo "<p class='product-description mb-0'>" . htmlspecialchars($product['description']) . "</p>";
                            echo "</div>";
                            echo "</div>";
                            echo "<p class='product-price mb-0'>" . htmlspecialchars($product['price']) . " руб.</p>";
                            echo "</div>"; 
                            $total_price += (int)$product['price'] * $quantity;
                        }
                    }
                    $product_stmt->close();
                }
            }
            echo "</div>"; // End of product list

            // Total price
            echo "<div class='total-price' style='text-align: right; font-weight: bold;'>";
            echo "Общая цена: <strong>" . $total_price . " руб.</strong>";
            echo "</div>";

            echo "</div>"; // End of card-body
            echo "</div>"; // End of order-card
            echo "</div>"; // End of col-12 col-sm-6
        }
        echo "</div>"; // End of row
        echo "</div>"; // End of container
    } else {
        echo "<div class='alert alert-info'>У вас нет активных заказов.</div>";
    }
    $stmt->close();
} else {
    echo "<div class='alert alert-danger'>Ошибка при выполнении запроса к базе данных.</div>";
}

$conn->close();
?>
