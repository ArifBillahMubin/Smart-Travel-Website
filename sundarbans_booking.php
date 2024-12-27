<?php
// Database connection variables
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "tour"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $package = $_POST['package'];
    $dates = $_POST['dates'];
    $special = $_POST['special'];

    // Check if the email exists in the user table
    $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($emailCheckQuery);

    if ($result->num_rows > 0) {
        // If email exists, insert booking into the sundarbans_booking table
        $sql = "INSERT INTO sundarbans_booking (name, email, phone, package, travel_dates, special_requests)
                VALUES ('$name', '$email', '$phone', '$package', '$dates', '$special')";

        if ($conn->query($sql) === TRUE) {
            // Display success message with a button to go back to home
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
                <h1>Booking Successfully Submitted!</h1>
                <p>Thank you for booking with us. We will contact you soon with further details.</p>
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
            <p>You have not login up yet. Please login before booking a package.</p>
            <a href='login.html' class='btn'>Go to login Page</a>
        </body>
        </html>";
    }

    // Close connection
    $conn->close();
}
?>
