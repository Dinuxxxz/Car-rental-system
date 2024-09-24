<?php
require '../dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $nic = $_POST['nic'];
    $contact_number = $_POST['contact_number'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $designation = $_POST['designation'];

    $stmt = $pdo->prepare("INSERT INTO staff (first_name, last_name, email, nic, contact_number, gender, address, designation) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $email, $nic, $contact_number, $gender, $address, $designation]);

    echo "Staff member added successfully!";
}