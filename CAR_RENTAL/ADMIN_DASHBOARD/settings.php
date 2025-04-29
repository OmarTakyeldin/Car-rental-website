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
      <link rel="stylesheet" href="settings_style.css" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&display=swap" rel="stylesheet">
      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
      <script src="dashboard.js" defer></script>
      <script src="delete.js"></script>
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
            <h1>Settings</h1>
            <div class="user">
               <div class="icons">
                  <i class="fa-solid fa-magnifying-glass"></i>
                  <i class="fa-solid fa-bell"></i>
               </div>
               <p class="name"><?php echo $user_data['username']; ?></p>   
               <div class="user-img">
                  <i class="fa-solid fa-user"></i>
               </div>
            </div>
         </header>
      </main>
   </body>
</html>