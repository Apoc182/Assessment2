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
					
					require 'lib/sqlconnect.php';
					$search = $_GET['search'];
					
					$sql = "SELECT * FROM items WHERE `Wifi Hotspot Name` LIKE concat('%', :search, '%')";
					$results = $pdo->prepare($sql);
					
					$results->bindValue(":search", $search);
					
					if($results->execute()){
						
						while($row = $results->fetch()){
							
							echo $row['Wifi Hotspot Name'] . "<br>";
							
						}
						
					}
					
						
						
				}else{
					
					echo "There were no results.";
					
				}
					
					
					
			
			
			?>

<!--            <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCnrMuizpvQ7jnYzVnpWBJw1ThoynhvLLY&callback=myMap'></script>

        <table id="results_table">
              <tr>
                <th>Name</th>
                <th>Suburb</th>
                <th>Location</th>
              </tr>
              <tr>
                <td>Grave Park</td>
                <td>Townsville</td>
                <td>123.666 E 999.124 N</td>
              </tr>
              <tr>
                <td>Cattle Station</td>
                <td>Jacksonville</td>
                <td>458.273 E 224.182 N</td>
              </tr>
            </table>
        </div>
-->
    </body>
</html>
