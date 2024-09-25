<?php
require '../dbconfig.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // $conn is the MySQL connection established in dbconfig.php
    $stmt = mysqli_prepare($conn, "DELETE FROM staff WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Staff member deleted successfully!";
    } else {
        echo "Error deleting staff member: " . mysqli_error($conn);
    }
    
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($conn);