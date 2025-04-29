<?php

include("../FUNCTIONS/connection.php");
include("../FUNCTIONS/functions.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $first_name = mysqli_real_escape_string($con, $_POST["first_name"]);
      $last_name = mysqli_real_escape_string($con, $_POST["last_name"]);
      $email = mysqli_real_escape_string($con, $_POST["email"]);
      $message_purpose = mysqli_real_escape_string($con, $_POST["message-purpose"]);
      $reservation_id = NULL;
      $title = '';
      $description = mysqli_real_escape_string($con, $_POST["additional_details"]);
      $support_id = random_num(11);

      if ($message_purpose == "new-booking") {
          $title = "New Booking";
          $query = "INSERT INTO support (support_id, first_name, last_name, email, title, description) VALUES ($support_id, '$first_name', '$last_name', '$email' ,'$title', '$description');";
          $result = mysqli_query($con, $query);
          mysqli_close($con);
          header("Location: ./success.php");
      } else if ($message_purpose == "existing-booking") {
          $title = mysqli_real_escape_string($con, $_POST["title"]);
          $reservation_id = mysqli_real_escape_string($con, $_POST["reservation-id"]);
          $query = "INSERT INTO support (support_id, first_name, last_name, email, reservation_id, title, description) VALUES ($support_id, '$first_name', '$last_name', '$email', $reservation_id, '$title', '$description');";
          $result = mysqli_query($con, $query);
          header("Location: ./success.php");
          mysqli_close($con);
      } else if ($message_purpose == "others") {
          $title = mysqli_real_escape_string($con, $_POST["title"]);
          $query = "INSERT INTO support (support_id, first_name, last_name, email, title, description) VALUES ($support_id, '$first_name', '$last_name', '$email', '$title', '$description');";
          $result = mysqli_query($con, $query);
          mysqli_close($con);
          header("Location: ./success.php");
      }     
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Contact Us</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="contact_style.css" />
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
      />
      <link
        href="https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600"
        rel="stylesheet"
        type="text/css"
      />
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
      <script src="https://kit.fontawesome.com/6faef4fc76.js" crossorigin="anonymous"></script>
    </head>



    <body class="body">
      <div class="login-page">
        <h1>CONTACT FORM</h1>
        <div class="container">
          <a href="../LANDING_PAGE/landing_page.php"><i class="fa-solid fa-chevron-circle-left fa-lg"></i></a>
            <form method="post">
                <div class="top">
                    <div class="left-side">
                        <input type="text" placeholder="First Name" name="first_name"/>
                        <input type="text" placeholder="Last Name" name="last_name" />
                        <input type="text" placeholder="E-mail" name="email" />
                        <select id="message-purpose" name="message-purpose">
                            <option value="" disabled selected>Select a purpose</option>
                            <option value="new-booking">New Booking</option>
                            <option value="existing-booking">Existing Booking</option>
                            <option value="others">Others</option>
                        </select>

                        <div class="checkbox" id="car-models" style="display: none;">
                            Preferred Models:
                            <div>
                                <input type="checkbox" name="sports_model" id="sports_model" value="sports_model">
                                <label for="sports_model">Sports</label>
                            </div>
                            <div>
                                <input type="checkbox" name="vintage_model" id="vintage_model" value="vintage_model">
                                <label for="vintage_model">Vintage</label>
                            </div>
                            <div>
                                <input type="checkbox" name="luxurious_model" id="luxurious_model" value="luxurious_model">
                                <label for="luxurious_model">Luxurious</label>
                            </div>
                        </div>

                        <div id="existing-booking-fields" style="display: none;">
                            <input type="text" placeholder="Reservation ID" name="reservation-id" />
                        </div>

                    </div>
                    <div class="right-side">
                        <input id="title-field" style="display: none;" type="text" placeholder="Title" name="title" />
                        <textarea placeholder="Your message to us (any addtional details or questions)." name="additional_details"></textarea>
                        <div class="small-text">Thank you for contacting us. We will get back to you shortly through email. We look forward to providing you with an exceptional rental experience. </div> 
                        <img src="../car-now-logo.png" width="55px" height="auto" style="border-radius: 6px; margin-top:1em" alt="logo">
                    </div>
                  </div>
                  <button type="submit" value="Submit" onclick="window.location.href='../LANDING_PAGE/landing_page.php'" >SUBMIT</button>   
            </form>
        </div>
      </div>

      <script>
          window.onload = function () {
            document.getElementById('message-purpose').addEventListener('change', function () {
                const purpose = this.value;
                const carModels = document.getElementById('car-models');
                const existingBookingFields = document.getElementById('existing-booking-fields');
                const titleField = document.getElementById('title-field');

                if (purpose === 'new-booking') {
                    carModels.style.display = 'block';
                    existingBookingFields.style.display = 'none';
                    titleField.style.display = 'none';
                } else if (purpose === 'existing-booking') {
                    carModels.style.display = 'none';
                    existingBookingFields.style.display = 'block';
                    titleField.style.display = 'block';
                } else if (purpose === 'others') {
                    carModels.style.display = 'none';
                    existingBookingFields.style.display = 'none';
                    titleField.style.display = 'block';
                } else {
                    carModels.style.display = 'none';
                    existingBookingFields.style.display = 'none';
                    othersField.style.display = 'none';
                }
            });
          }
      </script>
    </body>
</html>
