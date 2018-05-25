<header>
<ul>
	<li><a href="index.php">Home</a></li>
	<?php 
		session_start();
		if(!isset($_SESSION['loggedIn'])){
			
			echo '<li><a href="login.php">Login</a></li>';
			
		}else{
			
			echo '<li><a href="logout.php">Logout</a></li>';
			
		}
		
		
	
	?>
	
	<li><a href="register.php">Registration</a></li>
	
	
</ul>
</header>