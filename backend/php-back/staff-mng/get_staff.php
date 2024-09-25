<?php
require '../dbconfig.php';

$result = mysqli_query($conn, "SELECT * FROM staff");

if (mysqli_num_rows($result) > 0) {
    while ($staff = mysqli_fetch_assoc($result)) {
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

// Close the connection
mysqli_close($conn);