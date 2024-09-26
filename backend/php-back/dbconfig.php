<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$servername = "localhost";
$username = "root"; // default username for XAMPP/WAMP
$password = "your_new_password"; // default password is empty
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
