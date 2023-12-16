<?php
require_once '../../database/database.php';

header('Content-Type: application/json');

function getCategories($conn) {
    $categories = [];
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    return $categories;
}

echo json_encode(getCategories($conn));
?>