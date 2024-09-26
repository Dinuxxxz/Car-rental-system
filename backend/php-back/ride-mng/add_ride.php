<?php
require '../dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ride_id = $_POST['ride_id'];
    $car_id = $_POST['car_id'];
    $pickup_date = $_POST['pickup_date'];
    $dropoff_date = $_POST['dropoff_date'];
    $pickup_location = $_POST['pickup_location'];
    $with_driver = isset($_POST['with_driver']) ? 1 : 0;
    $driver_id = !empty($_POST['driver_id']) ? $_POST['driver_id'] : NULL;
    $discount_coupon = !empty($_POST['discount_coupon']) ? $_POST['discount_coupon'] : NULL;

    // Check if the car is available first
    $stmt = mysqli_prepare($conn, "SELECT is_available FROM cars WHERE car_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $car_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $car = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($car && $car['is_available']) {
        // Prepare SQL statement for inserting ride
        $stmt = mysqli_prepare($conn, "INSERT INTO rides (ride_id, car_id, pickup_date, dropoff_date, pickup_location, with_driver, driver_id, discount_coupon) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iisssiis", $ride_id, $car_id, $pickup_date, $dropoff_date, $pickup_location, $with_driver, $driver_id, $discount_coupon);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);

            // Update car table: set is_available to 0
            $stmt = mysqli_prepare($conn, "UPDATE cars SET is_available = 0 WHERE car_id = ?");
            mysqli_stmt_bind_param($stmt, "i", $car_id);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "Ride added successfully!";
            } else {
                echo "Error updating car availability: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error adding ride: " . mysqli_error($conn);
        }
    } else {
        echo "Car is not available.";
    }
}

// Close the connection
mysqli_close($conn);
?>