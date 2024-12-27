<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "tour";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$package = $_POST['package'];
$preferred_date = $_POST['preferred_date'];
$special_requests = $_POST['special_requests'];

// Check if the email exists in the users table
$emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($emailCheckQuery);

if ($result->num_rows > 0) {
    // Email exists, proceed with booking
    $sql = "INSERT INTO bandarban_booking (full_name, email, phone, package, preferred_date, special_requests)
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
            <p>Thank you for booking your trip to Bandarban with us. We will contact you soon with further details.</p>
            <a href='index.html' class='btn'>Back to Home</a>
        </body>
        </html>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // If email does not exist, show a message and redirect to login
    echo "
    <html>
    <head>
        <title>Login Required</title>
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
                background-color: red;
                color: white;
                font-size: 1.5rem;
                text-decoration: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .btn:hover {
                background-color: darkred;
            }
        </style>
    </head>
    <body>
        <h1>Login Required</h1>
        <p>You are not logged in yet. Please login to proceed with the booking.</p>
        <a href='login.html' class='btn'>Go to Login Page</a>
    </body>
    </html>";
}

// Close the connection
$conn->close();
?>
