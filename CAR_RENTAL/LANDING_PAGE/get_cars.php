<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "carNow";

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch all the cars
$sql = "SELECT car_id, car_name, car_img, price FROM car";
$result = $conn->query($sql);

$allCars = [];
if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
     $allCars[] = $row;
   }
}
$allCarsJson = json_encode($allCars);

// Close the database connection
$conn->close();
?>
