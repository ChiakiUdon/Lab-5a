<?php
session_start();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new database();
    $conn = $db->getConnection();

    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE matric = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $matric);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['matric'] = $user['matric'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];     

            header("Location: display.php"); 
            exit();
        } else {
            $error = "Invalid matric number or password.";
        }
    } else {
        $error = "Invalid matric number or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post" action="">
        <label>Matric:</label>
        <input type="text" name="matric" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <p><?php echo isset($error) ? $error : ''; ?></p>
    <a href="registration.php">Register here</a>
</body>
</html>