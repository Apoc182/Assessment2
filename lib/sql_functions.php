<?php

	
	

	//Returns an array of suburbs in the database.
	function getSuburbs(){
		require 'sqlconnect.php';
		
		$suburbs = [];
		$sql = 'SELECT Suburb FROM items';
		
		$counter = 0;
		foreach ($pdo->query($sql) as $row){
			//Remove pesky postcodes and commas...
			$row[0] = preg_replace('/, [0-9]+/', '', $row[0]);
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
		
		if($rating == ""){
			
			return array();
			
		}
		
		$sql = "SELECT * FROM (SELECT items.`Wifi Hotspot Name`, items.id, ROUND(AVG(reviews.rating)) AS 'Average Rating' FROM items JOIN reviews ON items.id=reviews.iditem GROUP BY items.`Wifi Hotspot Name`, items.id) AS t WHERE t.`Average Rating` = " . $rating;
		$results = [];
		
		$counter = 0;
		foreach ($pdo->query($sql) as $row){
			
			$results[$counter] = array($row[0], $row[1]);
			$counter++;
			
		}
		
		//Send something back to indicate nothing was found
		if (count($results) < 1){
			
			return array("NONE");
			
		}
		return $results;
		
		
		
	}
	
	//Search on names
	function nameSearch($name){
		
		if($name == ""){
			
			return array();
			
		}
		
		require 'sqlconnect.php';
		
		$sql = "SELECT `Wifi Hotspot Name`, id FROM items WHERE `Wifi Hotspot Name` LIKE '%{$name}%'" ;
		$results = [];
		
		$counter = 0;
		foreach ($pdo->query($sql) as $row){
			
			$results[$counter] = array($row[0], $row[1]);
			$counter++;
			
		}
		
		//Send something back to indicate nothing was found
		if (count($results) < 1){
			
			return array(array("NONE",));
			
		}
		
		return $results;
		
	}
	
	function searchSuburb($suburb){
		
		if($suburb == ""){
			
			return array();
			
		}
		
		require 'sqlconnect.php';
		
		$sql = "SELECT `Wifi Hotspot Name`, id FROM items WHERE suburb LIKE '%{$suburb}%'" ;
		$results = [];
		
		$counter = 0;
		foreach ($pdo->query($sql) as $row){
			
			$results[$counter] = array($row[0], $row[1]);
			$counter++;
			
		}
		
		//Send something back to indicate nothing was found
		if (count($results) < 1){
			
			return array("NONE");
			
		}
		
		return $results;
		
	}
	
	


?>