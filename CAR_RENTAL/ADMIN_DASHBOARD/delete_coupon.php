<?php
// Include database connection
require_once '../FUNCTIONS/connection.php';

if (isset($_GET['coupon_id'])) {
    $coupon_id = intval($_GET['coupon_id']);
    $delete_query = "DELETE FROM coupon WHERE coupon_id = $coupon_id";
    
    if (mysqli_query($con, $delete_query)) {
        echo $coupon_id;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

$con->close();
?>
