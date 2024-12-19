<?php
session_start();
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

include 'auth.php';
include 'database.php';

$db = new database();
$conn = $db->getConnection();

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    $query = "DELETE FROM users WHERE matric = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $matric);

    if ($stmt->execute()) {
        header("Location: display_users.php");
        exit();
    } else {
        echo "Failed to delete user.";
    }
} else {
    echo "Invalid request.";
}
?>