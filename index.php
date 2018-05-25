<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <div id="wrapper">
    <body>
      <?php include 'lib/header.php' ?>

        <div class="welcome">
          <h1>Search for great local wifi hotspots</h1>
        </div>

        <div id="searchbox">
          <form action="results.php" method="GET">
            <input type="text" name="search" placeholder="e.g. Ashgrove">
			<?php
			
				include 'lib/sql_functions.php';
				include 'lib/php_general.php';
				$suburbs = getSuburbs();
				echo dynamicSelect($suburbs, 'suburb', 'Suburb');
				$rating = [1, 2, 3, 4, 5];
				echo dynamicSelect($rating, 'rating', 'Rating');
			
			?>
            <input class="submitButton" type="submit" value="Search" >
          </form>
        </div>
     </div>

  </body>
</html>
