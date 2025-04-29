<?php 
session_start();

	include("../FUNCTIONS/connection.php");
	include("../FUNCTIONS/functions.php");

	$user_data = check_login($con);



?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="customers_style.css" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&display=swap" rel="stylesheet">
      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
      <script src="dashboard.js" defer></script>
      <script src="delete.js"></script>
      <script src="search.js"></script>
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
            <h1>Customers</h1>
            <div class="user">
            <div class="icons">
                  <i class="fa-solid fa-magnifying-glass" title="Search by Customer ID"></i>
                  <i class="fa-solid fa-add" title="Add new Customer"></i>
                  <i class="fa-solid fa-bell"></i>
               </div>
               <p class="name"><?php echo $user_data['username']; ?></p>  
                <!-- admin name according to the username keyed in during login -->
               <div class="user-img">
                  <i class="fa-solid fa-user"></i>
               </div>
            </div>
         </header>
         
         <div class="add-new-btn"><button onclick="window.location.href='./new_customer.php'">Add New Customer</button></div>
         <div class="search-container"><input type="text" id="search-input" placeholder="Search by Customer ID"></div>



         <div class="customers-table search-table">
            <?php

               $sql_reserved = "SELECT customer.customer_id, customer.email, reservation.reservation_id, reservation.car_id, reservation.payment_status,reservation.start_date, customer.last_updated, reservation.end_date FROM customer LEFT JOIN reservation ON customer.customer_id = reservation.customer_id;";
               
               // Execute query and get result
               $result = $con->query($sql_reserved);

               if ($result->num_rows > 0) {

                  echo"<table>";
                  echo"<thead>";
                  echo"<tr>";
                  echo"<th>Customer ID</th>";
                  echo"<th>Customer Email</th>";
                  echo"<th>Last Updated</th>";
                  echo"<th>Reservation ID</th>";
                  echo"<th>Status</th>";
                  echo"<th>Action</th>";
                  echo"</tr>";
                  echo"<tbody>";
                  // Output data of each row
                  while($row = $result->fetch_assoc()) {
                     if (is_null($row['reservation_id'])) {
                       echo "<tr><td>".$row["customer_id"]."</td><td>".$row["email"]."</td><td>".$row["last_updated"]."</td><td>NULL</td><td>-</td><td><a href='edit_customer.php?id=".$row["customer_id"]."'>Edit</a><a href='javascript:void(0);' onclick='deleteCustomer(".$row["customer_id"].")'>Delete</a></td></tr>";
                     } else {
                       $paymentStatus = ($row["payment_status"] == 1) ? "Paid" : "Unpaid";
                       echo "<tr><td>".$row["customer_id"]."</td><td>".$row["email"]."</td><td>".$row["last_updated"]."</td><td>".$row["reservation_id"]."</td><td>".$paymentStatus."</td><td><a href='edit_customer.php?id=".$row["customer_id"]."'>Edit</a><a href='javascript:void(0);' onclick='deleteCustomer(".$row["customer_id"].")'>Delete</a></td></tr>";
                     }
                   }
                   
                  echo"</tbody>";
                  echo "</table>";
               } else {
                  echo "0 results";
               }

            ?>
             
         </div>

      </main>
   </body>
</html>