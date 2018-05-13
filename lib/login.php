<?php

	function loginCheck(){

		if(!empty($_POST)){
			
			require 'sqlconnect.php';
			$sql = 'SELECT email, password FROM members WHERE email ="' . $_POST['email'] . '"';	
			$results = $pdo->query($sql);
			
			if(!$results->rowCount() == 0){
				
				$pass = $results->fetchColumn(1);
				
				if(password_verify($_POST['password'], $pass)){
				
					return "Successfully logged in!";
				}
				
				return  "Right email, wrong pass";
				
			}else{
				
				return "Mission failed...";
				
			}
			
			
			
			
			
		}
	}

?>