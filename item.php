<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="JS/map.js"></script>
  </head>
  <div id="wrapper">
  <body>
	  <?php include 'lib/header.php'?>
      <div id="map2"></div>
      <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCnrMuizpvQ7jnYzVnpWBJw1ThoynhvLLY&callback=myMap'></script>
      <div id="item-desc">
          <?php 
		  
				include 'lib/sql_functions.php';
				//If there has been a review posted, better add it!
				if(!empty($_POST)){
					

					submitReview((int)$_GET['item_id'], $_POST['text'], (int)$_POST['rating'], (int)$_SESSION['userid']);
				
				}
				
				if(!empty($_GET['item_id'])){
					
					//Store the item id.
					$item_id = $_GET['item_id'];
					
					//Get the relevant data on the item.

					$item = getItem($item_id);
					
					//Get the average rating.
					$avg_rating = 0;
					$counter=0;
					foreach($item as $rating){
						
						$avg_rating += (int)$rating[9];
						$counter++;
						
					}
					
					$avg_rating = round($avg_rating/$counter);
					
					//Spit out the information on the selected location.
					echo "<h1>" . $item[0][0] . "</h1>";
					echo "<b><br>Address: </b>" . $item[0][1] . ", " . $item[0][2] . "<br>";
					echo "<b>Average Rating: </b>" . $avg_rating;
					echo "<p><h1>Reviews</h1></br>";
					
					//Lets iterate through the reviews.
					if($item[0][5] != null){
						foreach($item as $meta){
							
							echo "<p><b>" . $meta[5] . " " . $meta[6] . " said on " . $meta[7] . ":<br></b>";
							echo $meta[8] . "<br>";
							echo "<b>They rated this place: </b>" . $meta[9] . "</p><hr>";
							
						}
					}else{
						
						echo "This item currently has no reviews.";
						
					}
					
					//Lets handle a logged in user...

					if(!empty($_SESSION['loggedIn']) && empty($_POST)){
						
						require 'lib/php_general.php';
						
						//Lets build a form for them to submit a review.
						echo "<form method='POST' id='review_form' onsubmit='return true;'>";
						
						$rating = [1, 2, 3, 4, 5];
						echo dynamicSelect($rating, 'rating', 'Rating', true);
						
						echo "<br><textarea name='text' form='review_form' rows=10 cols=50 required></textarea>";
						echo "<input class='submitButton' type='submit' value='review'>";
						echo "</form><br>";
						
					}
					
					if(!empty($_POST)){
					
						echo "Thankyou for your review.";
					
					}
				}else{
					
					echo "No item specified.";
					
				}
		  
		  
			?>
	

      </div>


    </div>

  </body>
</html>
