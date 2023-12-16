<?php
session_start();
require_once "../../database/database.php"; // Подключение к базе данных

if (!isset($_SESSION['user_id'])) {
    echo 'user_not_logged_in';
    exit;
}
$userId = $_SESSION['user_id'];
$paymentMethod = $_POST['payment_method'];
$totalPrice = $_POST['total_price'];
$fullName = $_POST['full_name'];
$address_without_apartments = $_POST['address'];
$apartment = $_POST['apartment'];

if (empty($apartment) || empty($fullName) || empty($address_without_apartments)) {
    echo 'error_empty_fields';
    exit;
}

$address = $address_without_apartments . ', ' . $apartment;

$query = "SELECT product_id, quantity FROM Cart WHERE user_id = ?";
$products = array();

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $products[] = array("product_id" => $row['product_id'], "quantity" => $row['quantity']);
    }

    $stmt->close();
} else {
    echo 'database_error';
    exit;
}


$productsJson = json_encode($products);


$orderQuery = "INSERT INTO orders (user_id, order_date, product_id, price, address, status, payment_type, full_name) VALUES (?, NOW(), ?, ?, ?, 'обработан', ?, ?)";

if ($orderStmt = $conn->prepare($orderQuery)) {
    $orderStmt->bind_param("isssss", $userId, $productsJson, $totalPrice, $address, $paymentMethod,$fullName);
    if ($orderStmt->execute()) {
        echo 'success';
    } else {
        echo 'order_failed';
    }
    $orderStmt->close();
} else {
    echo 'database_error';
}

$conn->close();
?>