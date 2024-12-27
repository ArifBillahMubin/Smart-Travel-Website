<?php
// Database connection variables
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "tour"; // Replace with your actual database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $package = $_POST['package'];
    $preferred_date = $_POST['preferred_date'];
    $special_requests = $_POST['special_requests'];

    // Insert data into the database
    $sql = "INSERT INTO coxsbazar_booking (full_name, email, phone, package, preferred_date, special_requests)
            VALUES (?, ?, ?, ?, ?, ?)";

    // Use prepared statements for security
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $full_name, $email, $phone, $package, $preferred_date, $special_requests);

    if ($stmt->execute()) {
        // Success message with "Back to Home" button
        echo "
        <html>
        <head>
            <title>Booking Success</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    padding: 50px;
                }
                .btn {
                    display: inline-block;
                    border: none;
                    padding: 15px 25px;
                    background-color: #007BFF;
                    color: white;
                    font-size: 1.5rem;
                    text-decoration: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
                .btn:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <h1>Booking Successfully Submitted!</h1>
            <p>Thank you for booking your trip to Cox’s Bazar with us. We will contact you soon with further details.</p>
            <a href='index.html' class='btn'>Back to Home</a>
        </body>
        </html>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
}
?>
