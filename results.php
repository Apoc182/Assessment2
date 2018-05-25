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

					//Going to have to have issets in here and build a master SQL query based on what we have.
					
					if(isset($_GET['search']) && $_GET['search'] != "") $sql .= "`Wifi Hotspot Name`, ";
					if(isset($_GET['suburb']) && $_GET['suburb'] != "") $sql .= "Suburb, ";
					if(isset($_GET['rating']) && $_GET['rating'] != "") $stuff = ratingSearch($_GET['rating']);
					var_dump($stuff);
					
					if($sql == 'SELECT '){
						
						echo "Please enter something to search on...";
						exit();
						
					}
					
				}
			?>
					

			</div>

    </body>
</html>
