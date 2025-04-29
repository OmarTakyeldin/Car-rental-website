<?php
session_start();

include("../FUNCTIONS/connection.php");
include("../FUNCTIONS/functions.php");

$user_data = check_login($con);

// Get the coupon ID from the URL (using GET method)
$coupon_id = isset($_GET['id']) ? $_GET['id'] : '';

// Fetch coupon details from the database using the coupon ID
if (!empty($coupon_id)) {
    $query = "SELECT * FROM coupon WHERE coupon_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $coupon_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Populate the form with the fetched data
        $coupon_name = $row['coupon_name'];
        $discount_amount = $row['discount_amount'];
    } else {
        echo("Coupon not found in database");
        header("refresh:2;url=./coupons.php");
        die;
    }
} else {
    echo("id not found.");
    header("refresh:2;url=./coupons.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Update the coupon details in the database
    $coupon_name = $_POST['coupon_name'];
    $discount_amount = $_POST['discount_amount'];
    $discount= floatval($discount_amount);

    if (!empty($coupon_name) && !empty($discount_amount) && ($discount_amount<=100)) {
        $discount = $discount/100;
        $query = "UPDATE coupon SET coupon_name = ?, discount_amount = ? WHERE coupon_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('sdi', $coupon_name, $discount, $coupon_id);
        $stmt->execute();

        header("Location: ./coupons.php");
        die;
    } else {
        if($discount_amount>100){
            echo"<p>Discount amount cannot be more than 100%</p>";
        }
        else{
            echo "Please fill in all necessary information!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="add_new.css" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
      <script src="dashboard.js" defer></script>
      <script src="https://kit.fontawesome.com/6faef4fc76.js" crossorigin="anonymous"></script>
      <title>Dashboard</title>
   </head>
   <body>

      <div class="hamburger">
         <div></div>
         <div></div>
         <div></div>
      </div>

      <div class="sidebar">
         <div class="logo-container">
            <img src="../car-now-logo.png" width="70px" height="auto" style="border-radius: 20px;" alt="logo">
            <i class="fa-solid fa-xmark close-btn"></i>
         </div>

         <nav class="sidebar-nav">
            <ul>
                <a href="reservations.php">
                    <li>
                        <i class="fa-solid fa-ticket"></i>
                        <p>Reservations</p>
                     </li>
                </a>
                <a href="./customers.php">
                    <li>
                    <i class="fa-solid fa-users"></i>
                    <p>Customers</p>
                    </li>
                </a>
                <a href="./vehicles.php">
                    <li>
                    <i class="fa-solid fa-car"></i>
                    <p>Vehicles</p>
                    </li>
                </a>
                <a href="./coupons.php">
                    <li>
                        <i class="fa-solid fa-book"></i>
                        <p>Coupons</p>
                     </li>
                </a>
                <a href="./support.php">
                  <li>
                     <i class="fa-solid fa-headset"></i>
                     <p>Support</p>
                  </li>
              </a>
             </ul>

             <ul>
                <a href="./settings.php">
                    <li>
                        <i class="fa-solid fa-gear"></i>
                        <p>Settings</p>
                    </li>
                </a>
               <a href="../FUNCTIONS/logout.php">
                    <li>
                        <i class="fa-solid fa-sign-out"></i>
                        <p>Logout</p>
                    </li>
               </a>
            </ul>
         </nav>
         <div class="fill-bottom"></div>
      </div>

      <main>
         <header class="header">
            <h1>Edit Coupon Details -<?php echo($coupon_id); ?></h1>
            <div class="user">
               <div class="icons">
                  <i class="fa-solid fa-bell"></i>
               </div>
               <p class="name"><?php echo $user_data['username']; ?></p>   
               <div class="user-img">
                  <i class="fa-solid fa-user"></i>
               </div>
            </div>
         </header>
         

         <div class="form-container">

            <form class="form" method="post" id="contact_form">
                <fieldset>
            <!-- Text input-->
            <input type="hidden" name="coupon_id" value="<?php echo $coupon_id; ?>">

            <div class="form-group">
                <label>Coupon Name</label> 
                <div class="inputGroupContainer">
                    <div class="input-group">
                        <span class="input-icon"><i class="fa-solid fa-ticket"></i></span>
                        <input name="coupon_name" placeholder="Coupon Name" class="input" type="text" value="<?php echo $coupon_name; ?>">
                    </div>
                </div>
            </div>

            <!-- Text input-->

            <div class="form-group">
                <label>Discount Amount</label> 
                <div class="inputGroupContainer">
                    <div class="input-group">
                        <span class="input-icon"><i class="fa-solid fa-percent"></i></span>
                        <input name="discount_amount" placeholder="Discount Amount" class="input" type="text" value="<?php echo $discount_amount*100; ?>">
                    </div>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <br>
                <button type="submit" class="submit-btn" >UPDATE <span class="fa-solid fa-edit"></span></button>
            </div>

            </fieldset>
        </form>
        </div>
    </div>

      </main>
   </body>
</html>