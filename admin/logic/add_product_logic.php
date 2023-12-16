<?php
require_once '../../database/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $categoryId = $_POST['category_id'];
    $imageUrl = $_POST['image_url']; 

    
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, category_id, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis", $name, $description, $price, $categoryId, $imageUrl);
    $stmt->execute();
    $stmt->close();

    
    header('Location: /liamas/admin/admin_panel.php');
}
?>