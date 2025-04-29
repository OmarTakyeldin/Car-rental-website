<?php
    include("../FUNCTIONS/connection.php");
    
    // Retrieve all available coupons from the database
    $coupon_query = "SELECT * FROM coupon";
    $coupon_result = $con->query($coupon_query);
    $coupons = array();

    while ($coupon_row = $coupon_result->fetch_assoc()) {
        $coupons[] = array(
            'coupon_name' => $coupon_row['coupon_name'],
            'discount_amount' => $coupon_row['discount_amount']
        );
    }

    // Return the coupons as a JSON array
    header('Content-Type: application/json');
    echo json_encode($coupons);
?>
