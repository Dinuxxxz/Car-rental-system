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

    // Assuming $conn is the MySQL connection established in dbconfig.php
    $stmt = mysqli_prepare($conn, "UPDATE staff SET first_name = ?, last_name = ?, email = ?, nic = ?, contact_number = ?, gender = ?, address = ?, designation = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssssssssi", $first_name, $last_name, $email, $nic, $contact_number, $gender, $address, $designation, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Staff member updated successfully!";
    } else {
        echo "Error updating staff member: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = mysqli_prepare($conn, "SELECT * FROM staff WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $staff = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($conn);