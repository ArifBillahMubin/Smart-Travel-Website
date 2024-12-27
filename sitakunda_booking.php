<?php
// Database connection details
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "tour"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$package = $_POST['package'];
$preferred_date = $_POST['preferred_date'];
$special_requests = $_POST['special_requests'];

// Insert data into sitakunda_bookings table
$sql = "INSERT INTO sitakunda_bookings (full_name, email, phone, package, preferred_date, special_requests) 
        VALUES ('$full_name', '$email', '$phone', '$package', '$preferred_date', '$special_requests')";

if ($conn->query($sql) === TRUE) {
    echo "Booking submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
