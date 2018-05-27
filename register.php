<!DOCTYPE html>


<html lang="en">


<?php 
	session_start();

	//If the user is logged in and tries to register again, this logs them out.
	if(isset($_SESSION['loggedIn']) && empty($_POST)){
		
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',0,'/');
		session_regenerate_id(true);
		
	}

	if(!empty($_POST)){
		require 'lib/newuser.php';	
		$errors = [];
		array_push($errors, validateName($_POST['fname'], "first"));
		array_push($errors, validateName($_POST['lname'], "last"));
		array_push($errors, validateEmail($_POST['email']));
		array_push($errors, validateMobileNum($_POST['mobilenum']));
		array_push($errors, validateBirthday($_POST['bday_day'], $_POST['bday_month'], $_POST['bday_year']));
		array_push($errors, validatePassword($_POST['password1'], $_POST['password2']));

		// validatePassword();
		$isError = false;
		foreach($errors as $error){
			
			//This means we have an error.
			if($error != ""){
				
				$isError = true;
				break;
				
			}
			
			
		}
		
		if(!$isError){
			
			$errors[0] = executeQuery();
			
		}
		
	}



?>

  <head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <div id="wrapper">
    <body>
      <?php include 'lib/header.php'?>
      <div class="welcome">
        <h1>To save your favourite wifi hotspots, please enter your details below:</h1>
      </div>

      <div id="form_page">
        <form method="POST" onsubmit="checkForm(); return false;">
		  <div class="name">
			<p>Name:</p>
			<input type="text" name="fname" id="firstname" placeholder="First">
			<input type="text" name="lname" id="lastname" placeholder="Last">
			<p class="error"></p>
		  </div>

		  <div class="email">
			<p>Email:</p>
			<input type="text" name="email" id="email" placeholder="example@gmail.com">
			<p class="error"></p>
		  </div>

		  <div class="phone">
			<p>Mobile:</p>
			<input type="tel" name="mobilenum" id="phone" placeholder="0455 555 555">
			<p class="error"></p>
		  </div>

		  <div class="birthday">
			<p>Birthday:</p>
			<input type="number" name="bday_day" id="day" placeholder="Day">
			<input type="number" name="bday_month" id="month" placeholder="Month">
			<input type="number" name="bday_year" id="year" placeholder="Year">
			<p class="error"></p>
		  </div>

		  <div class="password">
			<p>Create a Password:</p>
			<input type="password" name="password1" id="password" placeholder="Password">
			<input type="password" name="password2" id="confirm" placeholder="Confirm Password">
			<p class="error"></p>
		  </div>
		  


          <div class="submitButton">
            <input type="Submit" id="submit">
            <p class="error"></p>
          </div>
        </form>
		<?php 
				if(!empty($errors)){
					foreach($errors as $error){
						if($error != ""){
							echo $error . "<br>";
						}
						
					}
				}
			?>
      </div>
    </div>
 <!-- <script type="text/javascript" src="JS/validation.js"></script> -->
  </body>
</html>
