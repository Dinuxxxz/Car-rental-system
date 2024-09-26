<?php
require '../dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Assuming $conn is the MySQL connection established in dbconfig.php
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "User registered successfully";
    } else {
        echo "Error registering user: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($conn);