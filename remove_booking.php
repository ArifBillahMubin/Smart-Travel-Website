<?php
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "tour"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'];

    $sql = "DELETE FROM sundarbans_booking WHERE id = $id"; // Adjust the table name and ID field as necessary
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Booking removed successfully."]);
    } else {
        echo json_encode(["error" => "Error removing booking: " . $conn->error]);
    }
}

$conn->close();
?>