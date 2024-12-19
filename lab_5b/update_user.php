<?php
session_start();
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

include 'database.php';
include 'auth.php';

$db = new database();
$conn = $db->getConnection();

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $query = "SELECT * FROM users WHERE matric = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $matric);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $query = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $name, $role, $matric);

    if ($stmt->execute()) {
        header("Location: display_users.php");
        exit();
    } else {
        $error = "Failed to update user.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <form method="post" action="">
        <label>Matric:</label>
        <input type="text" name="matric" value="<?php echo $user['matric']; ?>" readonly>
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
        <label>Role:</label>
        <select name="role" required>
            <option value="student" <?php echo $user['role'] === 'student' ? 'selected' : ''; ?>>Student</option>
            <option value="lecturer" <?php echo $user['role'] === 'lecturer' ? 'selected' : ''; ?>>Lecturer</option>
        </select>
        <button type="submit">Update</button>
    </form>
    <a href="display_users.php">Cancel</a>
</body>
</html>