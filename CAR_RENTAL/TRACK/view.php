<?php

include("../FUNCTIONS/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_email = $_POST['email'];
    $reservation_id = $_POST['reservation_id'];

    $reservation_query = "SELECT * FROM reservation WHERE reservation_id = '$reservation_id' AND customer_id IN (SELECT customer_id FROM customer WHERE email = '$customer_email')";
    $reservation_result = $con->query($reservation_query);
    $reservation_row = $reservation_result->fetch_assoc();

    // Check if a reservation was found
    if (!$reservation_row) {
        $response = array(
            'found' => false,
            'message' => 'No reservation found for the given email and reservation ID.'
        );
    } else {
        // Retrieve additional information from the reservation table
        $car_id = $reservation_row['car_id'];
        $start_date = $reservation_row['start_date'];
        $end_date = $reservation_row['end_date'];
        $price = $reservation_row['price'];

        // Retrieve the car information based on the car ID
        $car_query = "SELECT * FROM car WHERE car_id = '$car_id'";
        $car_result = $con->query($car_query);
        $car_row = $car_result->fetch_assoc();

        // Retrieve the customer information based on the email
        $customer_query = "SELECT * FROM customer WHERE email = '$customer_email'";
        $customer_result = $con->query($customer_query);
        $customer_row = $customer_result->fetch_assoc();

         // Construct the response object
         $response = array(
            'found' => true,
            'reservation_id' => $reservation_id,
            'car_id' => $car_id,
            'car_model' => $car_row['car_name'],
            'customer_id' => $customer_row['customer_id'],
            'customer_name' => $customer_row['first_name'] . ' ' . $customer_row['last_name'],
            'start_date' => $start_date,
            'end_date' => $end_date,
            'price' => $price,
            'car_img' => $car_row['car_img'],
            'payment_status' => $reservation_row['payment_status'],
            'total_paid' => $reservation_row['total_paid']
        );
    }
     // Return the response as a JSON object
     header('Content-Type: application/json');
     echo json_encode($response);
} else {
    echo "Invalid request method.";
}

?>
