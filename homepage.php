<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div style="text-align: center; padding:15%;">
        <p style="font-size: 50px; font-weight:bold;">
            Hello <?php
            if (isset($_SESSION['email'])) {
                $email = $conn->real_escape_string($_SESSION['email']);
                $query = $conn->query("SELECT * FROM users WHERE email='$email'");
                if ($query && $query->num_rows > 0) {
                    $row = $query->fetch_assoc();
                    echo htmlspecialchars($row['firstName']) . ' ' . htmlspecialchars($row['lastName']);
                }
            }
            ?> :)
        </p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
