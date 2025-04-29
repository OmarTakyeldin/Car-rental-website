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
      <link rel="stylesheet" href="vehicles_style.css" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&display=swap" rel="stylesheet">
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
            <h1>Vehicles</h1>
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
         
         <div class="img-cards">

         <?php
            $sql = "SELECT * FROM car";
            
            // Execute query and get result
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                echo "<div class='img-card'>";
                echo "<img src='".$row["car_img"]."' alt='".$row["car_name"]."'>";
                echo "<div class='edit'>";
                echo "<a class ='small-btn'>";
                echo "<button class='view-car-btn' data-car-id='".$row['car_id']."' data-car-name='".$row['car_name']."' data-car-type='".$row['car_type']."' data-car-color='".$row['car_color']."' data-car-price='".$row['price']."' data-car-img='".$row['car_img']."'>View</button>";
                echo "</a>";
                echo "<a class='small-btn' href=''><button>Delete</button></a>";
                echo "</div>";
                echo "</div>";
                }
            }
        ?>
        </div>
        <div class="lg-cards">
            <div class="flex-container">
                <div class="lg-card">
                    <div class="card-header">
                       <div class="card-title">
                          <h2>Vehicle Details</h2>
                          <a href="#">View all</a>
                       </div>
                    </div>
                    <div>
                       <p>Luxurious</p>
                       <p class="lg-card-num">4</p>
                    </div>
                    <div>
                       <p>Sports</p>
                       <p class="lg-card-num">4</p>
                    </div>
                    <div>
                       <p>Classics</p>
                       <p class="lg-card-num">3</p>
                    </div>
                </div>
                <div class="add-new-btn"><button>Add Vehicle</button></div>
            </div>
        </div> 
         <div id="myModal" class="modal">
            <div class="modal-content">
               <span class="close">&times;</span>
               <img id="modal-image" src="">
               <h2 id="modal-name"></h2>
               <p id="modal-type"></p>
               <p id="modal-color"></p>
               <p id="modal-price"></p>
            </div>
         </div>
      </main>

      <script>
       document.addEventListener('DOMContentLoaded', function() {
        var viewCarButtons = document.querySelectorAll('.view-car-btn');

        viewCarButtons.forEach(function(button) {
            button.addEventListener('click', function() {
            var carId = this.getAttribute('data-car-id');
            var carName = this.getAttribute('data-car-name');
            var carType = this.getAttribute('data-car-type');
            var carColor = this.getAttribute('data-car-color');
            var carPrice = this.getAttribute('data-car-price');
            var carImg = this.getAttribute('data-car-img');

            console.log('Car ID:', carId);
            console.log('Car Name:', carName);
            console.log('Car Type:', carType);
            console.log('Car Color:', carColor);
            console.log('Car Price:', carPrice);
            console.log('Car Image:', carImg);

            openModal(carId, carName, carType, carColor, carPrice, carImg);
            });
        });
        });

        function openModal(carId, carName, carType, carColor, carPrice, carImg) {
        var modal = document.getElementById("myModal");
        var img = document.getElementById("modal-image");
        var name = document.getElementById("modal-name");
        var type = document.getElementById("modal-type");
        var color = document.getElementById("modal-color");
        var price = document.getElementById("modal-price");

        img.src = carImg;
        name.innerHTML = carName;
        type.innerHTML = "Type: " + carType;
        color.innerHTML = "Color: " + carColor;
        price.innerHTML = "Price: " + carPrice;

        modal.style.display = "block";

        var closeBtn = document.getElementsByClassName("close")[0];

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