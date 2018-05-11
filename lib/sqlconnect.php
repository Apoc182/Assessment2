<?php


		//This script simply connects to the db.
		//NOTE: When implemented to remote server, must update these details
		
		$pdo = new PDO('mysql:host=localhost;dbname=assessment2', 'justin', 'assessment2');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
	
	

?>