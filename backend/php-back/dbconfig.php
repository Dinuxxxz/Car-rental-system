<?php
$servername = "localhost";
$username = "root"; // default username for XAMPP/WAMP
$password = ""; // default password is empty
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
