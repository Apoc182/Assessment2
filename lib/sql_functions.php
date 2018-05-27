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
			
			return array(array());
			
		}
		
		$sql = "SELECT * FROM (SELECT items.`Wifi Hotspot Name`, items.id, items.Latitude, items.Longitude, ROUND(AVG(reviews.rating)) AS 'Average Rating' FROM items JOIN reviews ON items.id=reviews.iditem GROUP BY items.`Wifi Hotspot Name`, items.id) AS t WHERE t.`Average Rating` = " . $rating;
		$results = [];
		
		$counter = 0;
		foreach ($pdo->query($sql) as $row){
			
			$results[$counter] = array($row[0], $row[1], $row[2], $row[3]);
			$counter++;
			
		}
		
		//Send something back to indicate nothing was found
		if (count($results) < 1){
			
			return array(array("NONE"));
			
		}
		return $results;
		
		
		
	}
	
	//Search on names
	function nameSearch($name){
		require 'sqlconnect.php';
		if($name == ""){
			
			return array(array());
			
		}
		
		
		$sql = "SELECT `Wifi Hotspot Name`, id, Latitude, Longitude FROM items WHERE `Wifi Hotspot Name` LIKE '%{$name}%'" ;
		$results = [];
		
		$counter = 0;
		foreach ($pdo->query($sql) as $row){
			
			$results[$counter] = array($row[0], $row[1], $row[2], $row[3]);
			$counter++;
			
		}
		
		//Send something back to indicate nothing was found
		if (count($results) < 1){
			
			return array(array("NONE"));
			
		}
		
		return $results;
		
	}
	
	function searchSuburb($suburb){
		require 'sqlconnect.php';
		if($suburb == ""){
			
			return array(array());
			
		}
		
		
		$sql = "SELECT `Wifi Hotspot Name`, id, Latitude, Longitude FROM items WHERE suburb LIKE '%{$suburb}%'" ;
		$results = [];
		
		$counter = 0;
		foreach ($pdo->query($sql) as $row){
			
			$results[$counter] = array($row[0], $row[1],  $row[2], $row[3]);
			$counter++;
			
		}
		
		//Send something back to indicate nothing was found
		if (count($results) < 1){
			
			return array(array("NONE"));
			
		}
		
		return $results;
		
	}
	
	//Get locations within a certain distance.
	function distanceSearch($distance, $lat, $long){
		require 'sqlconnect.php';
		if($distance == ""){
			
			return array(array());
			
		}
		
		
		$sql = "SELECT `Wifi Hotspot Name`, id, Latitude, Longitude FROM items";
		$results = [];
		
		$counter = 0;
		foreach ($pdo->query($sql) as $row){
			if(distance($row[2], $row[3], $lat, $long) < $distance){
				$results[$counter] = array($row[0], $row[1],  $row[2], $row[3]);
				$counter++;
			}
			
		}
		
		//Send something back to indicate nothing was found
		if (count($results) < 1){
			
			return array(array("NONE"));
			
		}
		
		return $results;
		
	}
	
	//For the item page to gather the information it needs.
	function getItem($id){
		require 'sqlconnect.php';
		$sql = "SELECT a.`Wifi Hotspot Name`, a.Address, a.Suburb, a.Latitude, a.Longitude, c.fname, c.lname, b.date, b.review_text, b.rating FROM items a LEFT JOIN reviews b ON a.id=b.iditem LEFT JOIN members c ON b.iduser=c.userid WHERE a.id=" . $id . " ORDER BY b.date";
		
		
		$counter = 0;
		foreach ($pdo->query($sql) as $row){
			$results[$counter] = $row;
			$counter++;
			
		}
		
		
		return $results;
		
	}
	
	//For submitting a review.
	function submitReview($itemid, $text, $rating, $user_id){
		require 'sqlconnect.php';
		
		$sql = $pdo->prepare("INSERT INTO reviews (iditem, iduser, review_text, rating) VALUES (:itemid, :user_id, :text, :rating)");
		$sql->bindParam(':itemid', $itemid, PDO::PARAM_INT);
		$sql->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$sql->bindParam(':text', $text, PDO::PARAM_STR);
		$sql->bindParam(':rating', $rating, PDO::PARAM_INT);
		$sql->execute();
		

	
	
	
	
	}
		
		
		
	
	


?>