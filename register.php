<?php
include 'connect.php';

if (isset($_POST['register'])) {
    $firstName = $conn->real_escape_string($_POST['fName']);
    $lastName = $conn->real_escape_string($_POST['lName']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = md5($conn->real_escape_string($_POST['password']));

    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email Address Already Exists!";
    } else {
        $insertQuery = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";
        if ($conn->query($insertQuery) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
} elseif (isset($_POST['signIn'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = md5($conn->real_escape_string($_POST['password']));

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: homepage.php");
        exit();
    } else {
        echo "Not Found. Incorrect Email or Password.";
    }
}
?>
