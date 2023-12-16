<?php
session_start();
require_once('../../database/database.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $firstName = $conn->real_escape_string(trim($_POST['first_name']));
    $surname = $conn->real_escape_string(trim($_POST['surname']));
    $middleName = $conn->real_escape_string(trim($_POST['middle_name']));
    $dateOfBirth = $conn->real_escape_string(trim($_POST['date_of_birth']));
    $userId = $_SESSION['user_id'];   
    $sql = "UPDATE users SET 
            first_name = '$firstName', 
            surname = '$surname', 
            middle_name = '$middleName', 
            date_of_birth = '$dateOfBirth' 
            WHERE user_id = $userId";

   
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Profile updated successfully.";
    } else {
        $_SESSION['error_message'] = "Error updating profile: " . $conn->error;
    }

    
    $conn->close();

    
    header("Location: /liamas/profile/user_profile.php");
    exit();
}
?>