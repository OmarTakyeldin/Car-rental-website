<?php 
session_start();


	include("../FUNCTIONS/connection.php");
  include("../FUNCTIONS/functions.php");

	

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
    $full_name = $_POST['full_name'];
		$user_name = $_POST['user_name'];
    $email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//save to database
			$staff_id = random_num(11);
			$query = "insert into staff (staff_id,full_name,email,username,password) values ('$staff_id','$full_name','$email','$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: ../LOGIN_PAGE/login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Sign Up</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta charset="utf-8" />
      <link rel="stylesheet" type="text/css" href="signup_style.css" />
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
    </head>

    <body class="body">
      <div class="login-page">
        <div class="form">
          <form method="post">
            <img src="../car-now-logo.png" width="200px" height="auto" style="border-radius: 20px; margin-bottom: 20px;" alt="logo">
            <input type="text" placeholder="Full Name" name="full_name"/>
            <input type="text" placeholder="E-mail" name="email" />
            <input type="text" placeholder="Username" name="user_name" />
            <input type="password" id="password" placeholder="Password" name="password"/>
            <i class="fas fa-eye" onclick="show()"></i>
            <br>
            <br>
            <button type="submit" value="Signup">CREATE ACCOUNT</button>
            <div class="small-text">Already have an account?<a href="../LOGIN_PAGE/login.php">Log in</a></div>
          </form>
        </div>
      </div>
    </body>
    <script>
      function show() {
        var password = document.getElementById("password");
        var icon = document.querySelector(".fas");

        // ========== Checking type of password ===========
        if (password.type === "password") {
          password.type = "text";
        } else {
          password.type = "password";
        }
      }
    </script>

</html>
