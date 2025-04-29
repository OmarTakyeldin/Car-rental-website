<?php
// Include database connection
require_once '../FUNCTIONS/connection.php';

if (isset($_GET['reservation_id'])) {
    $reservation_id = intval($_GET['reservation_id']);
    $delete_query = "DELETE FROM reservation WHERE reservation_id = $reservation_id";
    
    if (mysqli_query($con, $delete_query)) {
        echo $reservation_id;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

$con->close();
?>
