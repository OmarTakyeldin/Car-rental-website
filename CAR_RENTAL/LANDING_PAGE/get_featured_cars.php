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

// Fetch the details of the three cars that you want to display
$sql = "SELECT car_id, car_name, car_img FROM car ORDER BY RAND() LIMIT 3";

$result = $conn->query($sql);

$carDetails = [];
if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
     $carDetails[] = $row;
   }
}

// Close the database connection
$conn->close();
?>
