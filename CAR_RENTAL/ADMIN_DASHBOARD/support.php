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
      <link rel="stylesheet" href="support_style.css" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&display=swap" rel="stylesheet">
      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
      <script src="dashboard.js" defer></script>
      <script src="https://kit.fontawesome.com/6faef4fc76.js" crossorigin="anonymous"></script>
      <script src="delete.js"></script>
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
            <h1>Support</h1>
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

         <div class="ticket-container">
                <div class="card-header">
                   <div class="card-title">
                      <h2>Tickets</h2>
                   </div>
                </div>
                <?php

                  $query = "SELECT * FROM support ORDER BY last_updated DESC";
                  $result = mysqli_query($con, $query);
                  while ($row = mysqli_fetch_assoc($result)) {
                     $support_id = $row['support_id'];
                     $title = $row['title'];
                 
                     echo '<div class="ticket">';
                     echo '<p class="ticket-title">' . htmlspecialchars($title) . '</p>';
                     echo '<div class="card-btn">';
                     echo '<a class="view-ticket-btn" data-support-id="' . htmlspecialchars($support_id) . '" data-title="' . htmlspecialchars($title) . '" data-first-name="' . htmlspecialchars($row['first_name']) . '" data-last-name="' . htmlspecialchars($row['last_name']) . '" data-email="' . htmlspecialchars($row['email']) . '" data-reservation-id="' . htmlspecialchars($row['reservation_id']) . '" data-description="' . htmlspecialchars($row['description']) . '">View</a>';

                     echo '<a href="" onclick="deleteSupport(' . $row["support_id"] . ')">Delete</a>';

                     echo '</div>';
                     echo '</div>';
                 } 
                ?>
         </div>
         <div id="ticketModal" class="modal">
            <div class="modal-content">
               <span class="close-ticket-modal close">&times;</span>
               <h2 id="modal-ticket-title"></h2>
               <br>
               <p id="modal-full-name"></p>
               <p id="modal-email"></p>
               <p id="modal-reservation-id"></p>
               <br>
               <p id="modal-description"></p>
            </div>
         </div>
      </main>

      <script>
      document.addEventListener('DOMContentLoaded', function() {
         var viewTicketButtons = document.querySelectorAll('.view-ticket-btn');

         viewTicketButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                  var supportId = this.getAttribute('data-support-id');
                  var title = this.getAttribute('data-title');
                  var firstName = this.getAttribute('data-first-name');
                  var lastName = this.getAttribute('data-last-name');
                  var email = this.getAttribute('data-email');
                  var reservationId = this.getAttribute('data-reservation-id');
                  var description = this.getAttribute('data-description');

                  openTicketModal(supportId, title, firstName, lastName, email, reservationId, description);
            });
         });
      });

      function openTicketModal(supportId, title, firstName, lastName, email, reservationId, description) {
         var modal = document.getElementById("ticketModal");
         var ticketTitle = document.getElementById("modal-ticket-title");
         var fullNameElement = document.getElementById("modal-full-name");
         var ticketEmail = document.getElementById("modal-email");
         var reservation = document.getElementById("modal-reservation-id");
         var ticketDescription = document.getElementById("modal-description");

         ticketTitle.innerHTML = "Ticket: " + title;
         fullNameElement.innerHTML = "Name: " + firstName + " " + lastName;
         ticketEmail.innerHTML = "Email: " + email;
         if (reservationId) {
         reservation.innerHTML = "Reservation ID: " + reservationId;
         }
         ticketDescription.innerHTML = "Description: <br>" + description;

         modal.style.display = "block";

         var closeBtn = document.getElementsByClassName("close-ticket-modal")[0];

         closeBtn.onclick = function() {
            modal.style.display = "none";
         }

         window.onclick = function(event) {
            if (event.target == modal) {
                  modal.style.display = "none";
            }
         }
         return false;
      }
      </script>
      
   </body>
</html>