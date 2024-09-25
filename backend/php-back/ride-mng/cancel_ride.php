<?php
require '../dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ride_id'])) {
    $ride_id = $_POST['ride_id'];

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Get the car_id associated with the ride
        $stmt = mysqli_prepare($conn, "SELECT car_id FROM rides WHERE ride_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $ride_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $ride = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if (!$ride) {
            throw new Exception("Ride not found.");
        }

        $car_id = $ride['car_id'];

        // Delete the ride
        $stmt = mysqli_prepare($conn, "DELETE FROM rides WHERE ride_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $ride_id);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error deleting ride: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt);

        // Update car availability
        $stmt = mysqli_prepare($conn, "UPDATE cars SET is_available = 1 WHERE car_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $car_id);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error updating car availability: " . mysqli_error($conn));
        }
        mysqli_stmt_close($stmt);

        // Commit transaction
        mysqli_commit($conn);

        echo "Ride cancelled successfully!";
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}

// Close the connection
mysqli_close($conn);