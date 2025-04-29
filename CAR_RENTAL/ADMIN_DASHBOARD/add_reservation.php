<?php
include("../FUNCTIONS/connection.php");
include("../FUNCTIONS/functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_email = $_POST['email'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $car_id = $_POST['car_id'];

    // Get the reservation_id from the form
    $reservation_id = isset($_POST['reservation_id']) ? $_POST['reservation_id'] : '';

    $customer_query = "SELECT * FROM customer WHERE email = '$customer_email'";

    $customer_result = $con->query($customer_query);
    $customer_row = $customer_result->fetch_assoc();
    $customer_id = $customer_row['customer_id'];
     // Calculate the price
     
     $car_query = "SELECT price FROM car WHERE car_id = '$car_id'";
     $car_result = $con->query($car_query);
     $car_row = $car_result->fetch_assoc();
     $price_per_day = $car_row['price'];
     $start_date_obj = date_create($start_date);
     $end_date_obj = date_create($end_date);
     $duration = date_diff($start_date_obj, $end_date_obj)->format('%a');
     $price = $duration * $price_per_day;

    // If reservation_id is not empty, update the existing reservation
    if (!empty($reservation_id)) {
        $query = "UPDATE reservation SET customer_id = $customer_id, car_id = $car_id, start_date = '$start_date', end_date = '$end_date', price = $price WHERE reservation_id = $reservation_id";
    } else {
        // Else, create a new reservation
        $reservation_id = random_num(10);
        $query = "INSERT INTO reservation (reservation_id, customer_id, car_id, start_date , end_date, price) VALUES ($reservation_id, $customer_id, $car_id, '$start_date', '$end_date', $price)";
    }

    $result = $con->query($query);
    header("Location: ./reservations.php");
} else {
    echo "Invalid request method.";
}



?>