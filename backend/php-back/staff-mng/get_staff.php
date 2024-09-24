<?php
require '../dbconfig.php';

$stmt = $pdo->query("SELECT * FROM staff");
$staff_members = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($staff_members) {
    foreach ($staff_members as $staff) {
        echo "ID: " . $staff['id'] . "<br>";
        echo "First Name: " . $staff['first_name'] . "<br>";
        echo "Last Name: " . $staff['last_name'] . "<br>";
        echo "Email: " . $staff['email'] . "<br>";
        echo "NIC: " . $staff['nic'] . "<br>";
        echo "Contact Number: " . $staff['contact_number'] . "<br>";
        echo "Gender: " . $staff['gender'] . "<br>";
        echo "Address: " . $staff['address'] . "<br>";
        echo "Designation: " . $staff['designation'] . "<br><hr>";
    }
} else {
    echo "No staff members found.";
}
