<?php

	
	

	//Returns an array of suburbs in the database.
	function getSuburbs(){
		require 'sqlconnect.php';
		
		$suburbs = [];
		$sql = 'SELECT Suburb FROM items';
		
		$counter = 0;
		foreach ($pdo->query($sql) as $row){
			//Remove pesky postcodes and commas...
			$row[0] = preg_replace('/[0-9,]+/', '', $row[0]);
			$suburbs[$counter] = $row[0];
			$counter++;
			
		}
		
		return $suburbs;	
		
	}
	
	//Returns an array of names of items from the database.
	function getNames(){
		require 'sqlconnect.php';
		
		$names = [];
		$sql = 'SELECT `WiFi Hotspot Name` FROM items';
		
		$counter = 0;
		foreach ($pdo->query($sql) as $row){
			
			$suburbs[$counter] = $row[0];
			$counter++;
			
		}
		
		return $suburbs;
		
	}
	
	//Search on ratings.
	function ratingSearch($rating){
		require 'sqlconnect.php';
		
		$sql = "SELECT * FROM (SELECT items.`Wifi Hotspot Name`, ROUND(AVG(reviews.rating)) AS 'Average Rating' FROM items JOIN reviews ON items.id=reviews.iditem GROUP BY items.`Wifi Hotspot Name`) AS t WHERE t.`Average Rating` = " . $rating;
		$results = [];
		
		$counter = 0;
		foreach ($pdo->query($sql) as $row){
			
			$results[$counter] = $row[0];
			$counter++;
			
		}
		
		return $results;
		
		
		
	}
	
	


?>