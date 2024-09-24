<?php
require '../dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $nic = $_POST['nic'];
    $contact_number = $_POST['contact_number'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $designation = $_POST['designation'];

    $stmt = $pdo->prepare("UPDATE staff SET first_name = ?, last_name = ?, email = ?, nic = ?, contact_number = ?, gender = ?, address = ?, designation = ? WHERE id = ?");
    $stmt->execute([$first_name, $last_name, $email, $nic, $contact_number, $gender, $address, $designation, $id]);

    echo "Staff member updated successfully!";
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM staff WHERE id = ?");
    $stmt->execute([$id]);
    $staff = $stmt->fetch(PDO::FETCH_ASSOC);
}
