<?php
$servername = "localhost:3307";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password is empty
$database = "login-register";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
