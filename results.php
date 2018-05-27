<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registration</title>
            <link rel="stylesheet" type="text/css" href="CSS/main.css">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="JS/map.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <?php include 'lib/header.php';
			
				if(!empty($_GET)){
					include 'lib/sql_functions.php';
					include 'lib/php_general.php';
					
					//An array for result arrays to populate.
					$array_list = array();
					$array_index = 0;
					
					//Set search queries and search for them.
					if(!empty($_GET['search'])){
						$search = $_GET['search'];
						$search = nameSearch($search);
						$array_list[$array_index] = $search;
						$array_index++;
					}
					
					if(!empty($_GET['suburb'])){
						$suburb = $_GET['suburb'];
						$suburb = searchSuburb($suburb);
						$array_list[$array_index] = $suburb;
						$array_index++;
					}
					
					if(!empty($_GET['rating'])){
						$rating = $_GET['rating'];
						$rating = ratingSearch($rating);
						$array_list[$array_index] = $rating;
						$array_index++;
					}
					
				
					//Get the latitude and longitude if it was set.
					if(!empty($_GET['long']) && !empty($_GET['lat'])){
						$longitude = $_GET['long'];
						$latitude = $_GET['lat'];
						//Get the distance the user wishes the search to provide results under.
						if(!empty($_GET['distance'])){
							$distance = $_GET['distance'];
							$distance = distanceSearch($distance, $latitude, $longitude);
							$array_list[$array_index] = $distance;
						}
					}
				
					
					//Create an array of arrays containing only valid data
					// $array_list_clean = array();
					// $counter = 0;
					// foreach($array_list as $element){
						// if(count($element) > 0){
							// $array_list_clean[$counter] = $element;
							// $counter++;
						// }
						
					// }
					//Compare results and display the common elements.
					switch(count($array_list)){
						
						case 1:
							$result = $array_list[0];
							break;
						case 2:
							$result = array(array_intersect($array_list[0][0], $array_list[1][0]));
							break;
						case 3:
							$result = array(array_intersect($array_list[0][0], $array_list[1][0], $array_list[2][0]));
							break;
							
						case 4:
							$result = array(array_intersect($array_list[0][0], $array_list[1][0], $array_list[2][0].  $array_list[3][0]));
							break;
						default:
							$result = array();
						
						
					}


					foreach($result as $row){
						
						if(empty($row[0])){
							
							continue;
							
						}
						
						//Reset results if they contain a NONE
						if($row[0] == "NONE"){
							
							$result = array();
							continue;
							
						}
					
					}

					
					echo "<table style='width:100%'><tr><th>Name</th>";
					if(!empty($latitude)){
						 echo "<th>Distance</th>";
					}
					if(!empty($result[0][0])){
						foreach($result as $row){
							if(!empty($latitude)){
								echo "<tr><td><a href='item.php?item_id=" . $row[1] . "'>" . $row[0] . "</a></td><td>" . round(distance($row[2], $row[3], $latitude, $longitude)) . "</td></tr>";
							}else{
								echo "<tr><td><a href='item.php?item_id=" . $row[1] . "'>" . $row[0] . "</a></td></tr>";								
							}

							
						}
						echo "</table>";
					}

				}
					
					
					
					
					

					//Going to have to have issets in here and build a master SQL query based on what we have.
					
					// if(isset($_GET['search']) && $_GET['search'] != "") $sql .= "`Wifi Hotspot Name`, ";
					// if(isset($_GET['suburb']) && $_GET['suburb'] != "") $sql .= "Suburb, ";
					// if(isset($_GET['rating']) && $_GET['rating'] != "") $stuff = ratingSearch($_GET['rating']);
					// var_dump($stuff);
					
					// if($sql == 'SELECT '){
						
						// echo "Please enter something to search on...";
						// exit();
						
					// }
					

			?>
					

			</div>

    </body>
</html>
