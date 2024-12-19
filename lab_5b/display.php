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

$query = "SELECT matric, name, role FROM users";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Users</title>
</head>
<body>
    <h2>Users List</h2>
    <table border="1">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['matric']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td>
                <a href="update_user.php?matric=<?php echo $row['matric']; ?>">Update</a>
                <a href="delete_user.php?matric=<?php echo $row['matric']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>