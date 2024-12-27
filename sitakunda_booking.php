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

// Check if the email exists in the user table
$emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($emailCheckQuery);

if ($result->num_rows > 0) {
    // If email exists, insert booking into sitakunda_bookings table
    $sql = "INSERT INTO sitakunda_bookings (full_name, email, phone, package, preferred_date, special_requests) 
            VALUES ('$full_name', '$email', '$phone', '$package', '$preferred_date', '$special_requests')";

    if ($conn->query($sql) === TRUE) {
        // Success message and button to go back to home
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
                    background-color: blue;
                    color: white;
                    font-size: 1.5rem;
                    text-decoration: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
                .btn:hover {
                    background-color: darkblue;
                }
            </style>
        </head>
        <body>
            <h1>Booking Successfully Submitted!</h1>
            <p>Thank you for choosing our service. We will contact you soon with further details.</p>
            <a href='index.html' class='btn'>Back to Home</a>
        </body>
        </html>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If email does not exist, display a message and a button to go to the signup page
    echo "
    <html>
    <head>
        <title>Signup Required</title>
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
        <p>You are not login yet. Please login to proceed with the booking.</p>
        <a href='login.html' class='btn'>Go to login Page</a>
    </body>
    </html>";
}

// Close connection
$conn->close();
?>
