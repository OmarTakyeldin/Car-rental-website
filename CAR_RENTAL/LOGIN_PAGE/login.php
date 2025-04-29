
<?php 

session_start();

	include("../FUNCTIONS/connection.php");
	include("../FUNCTIONS/functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from staff where username = '$user_name' limit 1";
			$result = mysqli_query($con, $query);
    
			if($result){
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['staff_id'] = $user_data['staff_id'];
						header("Location: ../ADMIN_DASHBOARD/reservations.php");
						die;

					}
				}}
			echo "wrong username or password!";
		}else{
			echo "wrong username or password!";
		}
	}

?>

<!DOCTYPE HTML>
<html lang="en" >
<head>
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="login_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>  
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'> 
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

<body class="body">
	
<div class="login-page">
  <div class="form">

    <form method="post">
      <img src="../car-now-logo.png" width="200px" height="auto" style="border-radius: 20px; margin-bottom: 20px;" alt="logo">
      <input type="text" placeholder="&#xf007;  Username" name="user_name"/>
      <input type="password" id="password" placeholder="&#xf023;  Password" name="password"/>
      <i class="fas fa-eye" onclick="show()"></i> 
      <br>
      <br>
      <button type="submit" value="Login">LOGIN</button>
      <p class="message"></p>
    </form>

    <form class="login-form">
      <button  type="button" onclick="window.location.href='../SIGN_UP_PAGE/signup.php'">SIGN UP</button>
    </form>
  </div>
</div>

  <script>
    function show(){
      var password = document.getElementById("password");
      var icon = document.querySelector(".fas")

      // ========== Checking type of password ===========
      if(password.type === "password"){
        password.type = "text";
      }
      else {
        password.type = "password";
      }
    };
  </script>
</body>
</html>

