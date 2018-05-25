<?php

	//NOTE: Going to need some server side validation here...

	require 'sqlconnect.php';
	
	function validateName($validation_string, $string_name){
	
		
		if($validation_string == ""){
			return "The " . $string_name . " name cannot be empty.";

		
		}
		
		if(preg_match('~[0-9]~', $validation_string)){
		
			return "The " . $string_name . " name cannot contain numbers.";
 
		
		
		}
		
		
	}
	
	function validateEmail($email){
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  
		  return "Email invalid."; 
		  
		}
				
	}
	
	function validateMobileNum($mobilenum){
		
		if($mobilenum == ""){
			
			return "Please fill in phone number field.";
			
		}
		
		if (!is_numeric($mobilenum)) {
		  
		  return "Mobile number must consist of only numbers."; 
		  
		}
		
		if (strlen($mobilenum) != 10){
			
			return "Phone number must be 10 digits long.";
			
		}

				
	}
	

	function validateBirthday($day, $month, $year){
		
		if ($day == "" || $month == "" || $year == "") {
		  
		  return "Please fill in all birthday fields."; 
		  
		}
		
		if (!is_numeric($day) || !is_numeric($month) || !is_numeric($year)) {
		  
		  return "Birthday must be numeric."; 
		  
		}
		
	}
	
	function validatePassword($pass1, $pass2){
		
		if($pass1 == "" && $pass2 == ""){
			
			return "Please enter a password.";
			
		}
		
		if($pass1 != $pass2){
			
			return "Your passwords do not match.";
			
		}
		
	}
	
	
	
	function executeQuery(){
		require 'sqlconnect.php';

		//Put birthday string together
		$birthday = $_POST['bday_year'] . '-' . $_POST['bday_month'] . '-' . $_POST['bday_day'];
		
		//Hash the password.
		$hashed_password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
		
		//Here is the SQL Query.
		$sql = 'INSERT INTO members (fname, lname, email, mobilenum, birthday, password) VALUES (:fname, :lname, :email, :mobilenum, :birthday, :hashed_password)';
		
		//Prepare the query.
		$query = $pdo->prepare($sql);
		
		//Execute the query.
		try{
			$query->execute(array(
				'fname' => $_POST['fname'],
				'lname' => $_POST['lname'],
				'email' => $_POST['email'],
				'mobilenum' => $_POST['mobilenum'],
				'birthday' => $birthday,
				'hashed_password' => $hashed_password
					
			));
		}catch (PDOException $e){
			
			if($e->getCode() == 23000){
				
				return "This email address is already in use.";
				
			}else{	
				return "Sorry, something went wrong: " . $e->getMessage();
			}
			
			
		}
		header('Location: index.php'); 

	}

?>