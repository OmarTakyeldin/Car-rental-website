<?php

include("../FUNCTIONS/connection.php");
include("../FUNCTIONS/functions.php");

$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$car_type = $_GET['car_type'];
$reservation_id = isset($_GET['reservation_id']) ? $_GET['reservation_id'] : ''; // Get the reservation ID from the request
$trim_car_type = str_replace('%20', '', $car_type);
$sql = "SELECT car_id, car_name, car_img FROM car WHERE car_type = '$trim_car_type' AND car_id NOT IN (SELECT car_id FROM reservation WHERE ((start_date BETWEEN '$start_date' AND '$end_date') OR (end_date BETWEEN '$start_date' AND '$end_date') OR (start_date < '$start_date' AND end_date > '$end_date')) AND reservation_id <> '$reservation_id')";

$result = $con->query($sql);

$availableCars = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $availableCars[] = $row;
    }
}
echo json_encode($availableCars);

?>
