<?php
require_once '../../database/database.php';

function getProducts($conn, $categoryId = null) {
    $sql = "SELECT p.product_id, p.name, p.description, p.price, p.category_id, p.image_url, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.category_id";
    if (!empty($categoryId)) {
        $sql .= " WHERE p.category_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $categoryId);
    } else {
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];

    while($row = $result->fetch_assoc()) {
        array_push($products, $row);
    }

    $stmt->close();
    return $products;
}

function getCategories($conn) {
    $categories = [];
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        array_push($categories, $row);
    }

    return $categories;
}

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'loadProducts') {
        $categoryId = isset($_POST['categoryId']) && !empty($_POST['categoryId']) ? $_POST['categoryId'] : null;
        $products = getProducts($conn, $categoryId);
        echo json_encode($products);
    } elseif ($_POST['action'] == 'loadCategories') {
        $categories = getCategories($conn);
        echo json_encode($categories);
    }
    exit;
}
?>
    