<?php
// signup.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tour";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Added username
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Validate password and confirm password
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location.href='signup.html';</script>";
        exit();
    }

    // Check if email already exists
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email_query);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email is already registered!'); window.location.href='signup.html';</script>";
        exit();
    }

    // Check if username already exists
    $check_username_query = "SELECT * FROM users WHERE username = '$username'"; // Added username check
    $result_username = $conn->query($check_username_query);

    if ($result_username->num_rows > 0) {
        echo "<script>alert('Username is already taken!'); window.location.href='signup.html';</script>";
        exit();
    }

    // Insert user into the database without hashing the password
    $sql = "INSERT INTO users (name, username, email, password) VALUES ('$name', '$username', '$email', '$password')"; // No hashing here

    if ($conn->query($sql) === TRUE) {
        // Show success message and button to go back to homepage
        echo "
        <html>
        <head>
            <title>Account Created</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    padding: 50px;
                }
                .btn {
                    display: inline-block;
                    border: 1px solid black;
                    padding: 15px 25px;
                    background-color: green;
                    color: white;
                    font-size: 1.5rem;
                    text-decoration: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
                .btn:hover {
                    background-color: darkgreen;
                }
            </style>
        </head>
        <body>
            <h1>Account Created Successfully!</h1>
            <p>Your account has been created. Please log in now.</p>
            <a href='login.html' class='btn'>Back to Login</a>
        </body>
        </html>";
        exit();
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href='signup.html';</script>";
    }
}

$conn->close();
?>
