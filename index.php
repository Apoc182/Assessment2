<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welcome!</title>
            <link rel="stylesheet" type="text/css" href="CSS/main.css">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="JS/map.js"></script>
    </head>
    <body>
	
		<?php
			require 'lib/login.php';
			$status = loginCheck();
			
		?>
	
	
		<div id="wrapper">
			<?php include 'lib/header.php' ?>
		<center>Welcome back!
		<form method="POST" onsubmit="return true;">
			<input type="text" placeholder="Email address" name="email">
			<input type="text" placeholder="Password" name="password">
			<input type="submit">
			
		</form>
		</center>
		<span><?php echo $status . "<br>"; ?></span>
		<a href="register.php">New user?</a>
		</div>
	</body>
</html>