<?php

	require 'sqlconnect.php';
	
	//Here is some serverside vailidation to run...
	
	
	//THIS WILL NOT DO!
	if($_POST["fname"] == ""){
		
		echo "Must provide first name.";
		return;
				
	}
	
	if(preg_match('/\\d/', $_POST["fname"])){
		
		echo "First name cannot contain characters.";
		return;
		
	}
	
	
	$birthday = $_POST['bday_year'] . '-' . $_POST['bday_month'] . '-' . $_POST['bday_day'];
	
	$pdo->query('INSERT INTO members (fname, lname, email, mobilenum, birthday, password) VALUES ("' . $_POST["fname"] . '", "' . $_POST["lname"] . '", "' . $_POST["email"] . '", "' . $_POST["mobilenum"] . '", "' . $birthday . '", "' . $_POST["password1"] . '")');
	
	// try {
		// $result = $pdo->query('SELECT PuppyName, BreedName, Description, Price, Picture, ID '. 'FROM animals, breeds '. 'WHERE animals.BreedID = breeds.Breed AND Sold = 0');
	// } catch (PDOException $e) {
		// echo $e->getMessage();
	// }
	
	echo "Success!";


?>