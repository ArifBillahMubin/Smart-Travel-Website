<?php
// login_process.php

// Start session
session_start();

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
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login
        $user = $result->fetch_assoc();
        
        // Set session variables
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];

        // Show success message and back to home button
        echo "
        <html>
        <head>
            <title>Login Successful</title>
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
            <h1>Login Successful!</h1>
            <p>Welcome, $username</p>
            <a href='index.html' class='btn'>Back to Home</a>
        </body>
        </html>";
        exit();
    } else {
        // Invalid credentials
        echo "<script>alert('Invalid username or password!'); window.location.href='login.html';</script>";
    }
}

$conn->close();
?>
