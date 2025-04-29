<?php
session_start();

include("../FUNCTIONS/connection.php");
include("../FUNCTIONS/functions.php");

$user_data = check_login($con);

$reservation_id = $_GET['reservation_id'];

// Fetch reservation data from the database
$query = "SELECT r.*, c.email FROM reservation r JOIN customer c ON r.customer_id = c.customer_id WHERE r.reservation_id = '$reservation_id'";
$result = mysqli_query($con, $query);
$reservation_data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Update the reservation data in the database
    $email = $_POST['email'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $car_id = $_POST['car_id'];

    $query = "UPDATE reservation SET start_date = '$start_date', end_date = '$end_date', car_id = '$car_id' WHERE reservation_id = '$reservation_id'";
    mysqli_query($con, $query);

    header("Location: ./reservations.php");
    die;
}
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="new_r.css" />
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
            <h1>Edit Reservation - R<?php echo($reservation_id); ?></h1>
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

            <form class="form" method="post"  id="reservation-form" action="add_reservation.php" >
                <fieldset>
            <!-- Hidden input to store the reservation id -->
            <input type="hidden" id="reservation_id" name="reservation_id" value="<?php echo $reservation_id; ?>">
            
            <!-- Text input-->

           <!-- Customer Email -->
            <div class="form-group">
                <label>Customer Email</label>
                <div class="selectorGroupContainer">
                    <div class="input-group">
                    <span class="input-icon"><i class="fa-solid fa-envelope"></i></span>
                        <?php
                            echo "<select name='email' class='selection' id='customer-email'>";
                            echo "<option value='" . $reservation_data['email'] . "'>" . $reservation_data['email'] . "</option>";
                            echo "</select>";
                        ?>
                    </div>
                </div>
            </div>

            <!-- Start Date -->
            <div class="form-group">
                <label>Start-Date</label>
                <div class="dateGroupContainer">
                    <div class="input-group">
                        <input name="start_date" class="input date" id="start-date" type="date" value="<?php echo $reservation_data['start_date']; ?>" required>
                    </div>
                </div>
            </div>

            <!-- End Date -->
            <div class="form-group">
                <label>End-Date</label>
                <div class="dateGroupContainer">
                    <div class="input-group">
                        <input name="end_date" class="input date" id="end-date" type="date" value="<?php echo $reservation_data['end_date']; ?>" required>
                    </div>
                </div>
            </div>

            <!-- Vehicle Type -->
            <div class="form-group">
                <label>Vehicle Type</label>
                <div class="selectorGroupContainer">
                    <div class="input-group">
                        <span class="input-icon"><i class="fa-solid fa-car"></i></span>
                        <?php
                            $query = "SELECT DISTINCT car_type FROM car";
                            $result = mysqli_query($con, $query);
                            echo "<select name='car_type' class='selection' id='car-type'>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $selected = ($row['car_type'] == $reservation_data['car_type']) ? "selected" : "";
                                echo "<option value='" . $row['car_type'] . "' " . $selected . ">" . $row['car_type'] . "</option>";
                            }
                            echo "</select>";
                        ?>
                    </div>
                </div>
            </div>



            <!-- Button -->
            <div class="form-group">
                <br>
                <button type="button" id="check-availability" class="check" style="font-size: 1rem;">Check Availability <span class="fa-solid fa-book"></span></button>
            </div>

            <div class="img-cards" id="available-cars" ></div>

            <input type="hidden" name="car_id" id="car_id" value="">
            <input type="submit" id="submit-reservation" style="display: none;">

            
        </fieldset>



        </form>
        <script src="add_reservation.js"></script>
        </div>
       

        
    

      </main>
   </body>
</html>