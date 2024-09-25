<?php
require_once '../dbconfig.php';

// Get form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$nic = $_POST['nic'];
$contact_number = $_POST['contact_number'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$designation = $_POST['designation'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO staff (first_name, last_name, email, nic, contact_number, gender, address, designation) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $first_name, $last_name, $email, $nic, $contact_number, $gender, $address, $designation);

// Execute the statement
if ($stmt->execute()) {
    echo "Staff member added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();