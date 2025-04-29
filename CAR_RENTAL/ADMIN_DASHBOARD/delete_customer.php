<?php
// Include database connection
require_once '../FUNCTIONS/connection.php';

if (isset($_GET['customer_id'])) {
    $customer_id = intval($_GET['customer_id']);
    $delete_query = "DELETE FROM customer WHERE customer_id = $customer_id";
    
    if (mysqli_query($con, $delete_query)) {
        echo $customer_id;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

$con->close();
?>
