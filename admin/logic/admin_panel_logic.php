
<?php
require_once '../../database/database.php';


function loadAdminProducts($conn) {
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


function deleteProduct($conn, $productId) {
    // Сначала удаляем связанные записи из таблицы cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $stmt->close();

    // Теперь удаляем продукт из таблицы products
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $stmt->close();
}


header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'loadAdminProducts') {
        $products = loadAdminProducts($conn);
        echo json_encode($products);
    } elseif ($_POST['action'] == 'deleteProduct') {
        $productId = $_POST['product_id'];
        deleteProduct($conn, $productId);
        echo json_encode(['success' => true]);
    }
    exit;
}

?>
