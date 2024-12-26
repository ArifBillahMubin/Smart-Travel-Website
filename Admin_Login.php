<?php
// login.php

session_start();

// Database connection (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tour";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate username and password (replace with your actual logic)
    $sql = "SELECT * FROM Admin_Login WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        $_SESSION["logged_in"] = true;
        $_SESSION["username"] = $username; 

        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        // Login failed
        echo "<script>alert('Invalid username or password.');</script>";
    }
}

$conn->close();
?>