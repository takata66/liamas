<?php
session_start();
include '../../database/database.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT surname, first_name, middle_name, date_of_birth FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

$user_data = mysqli_fetch_assoc($result);

$all_fields_filled = !empty($user_data['surname']) && !empty($user_data['first_name']) && !empty($user_data['middle_name']) && !empty($user_data['date_of_birth']);

$response = ['allFieldsFilled' => $all_fields_filled];
header('Content-Type: application/json');
echo json_encode($response);
