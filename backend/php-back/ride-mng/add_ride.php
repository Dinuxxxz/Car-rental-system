<?php
require '../';

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
    $stmt = $pdo->prepare("SELECT is_available FROM cars WHERE car_id = ?");
    $stmt->execute([$car_id]);
    $car = $stmt->fetch();

    if ($car && $car['is_available']) {
        // Prepare SQL statement
        $stmt = $pdo->prepare("INSERT INTO rides (ride_id, car_id, pickup_date, dropoff_date, pickup_location, with_driver, driver_id, discount_coupon) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$ride_id, $car_id, $pickup_date, $dropoff_date, $pickup_location, $with_driver, $driver_id, $discount_coupon]);

        // Update car table: set is_available to 0
        $stmt = $pdo->prepare("UPDATE cars SET is_available = 0 WHERE car_id = ?");
        $stmt->execute([$car_id]);

        echo "Ride added successfully!";
    } else {
        echo "Car is not available.";
    }
}
?>
