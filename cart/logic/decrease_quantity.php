<?php 
    session_start();

    
    require_once "../../database/database.php";

    if (isset($_POST['product_id']) && isset($_SESSION['user_id'])) {
        $productId = $_POST['product_id'];
        $userId = $_SESSION['user_id'];

        
        $stmt = $conn->prepare("UPDATE Cart SET quantity = quantity - 1 WHERE user_id = ? AND product_id = ? AND quantity > 1");
        $stmt->bind_param("ii", $userId, $productId);

        if ($stmt->execute()) {
            
            if ($stmt->affected_rows > 0) {
                echo "success";
            } else {
                echo "minimum quantity reached";
            }
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
?>
