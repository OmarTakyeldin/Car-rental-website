<?php
// Include database connection
require_once '../FUNCTIONS/connection.php';

if (isset($_GET['support_id'])) {
    $support_id = intval($_GET['support_id']);
    $delete_query = "DELETE FROM support WHERE support_id = $support_id";
    
    if (mysqli_query($con, $delete_query)) {
        echo $support_id;
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

$con->close();
?>
