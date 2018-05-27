<!DOCTYPE html>

<?php
	function loginCheck(){

		if(!empty($_POST)){
			
			require 'lib/sqlconnect.php';
			$stmt = $pdo->query('SELECT email, password, userid FROM members WHERE email ="' . $_POST['email'] . '"');
			while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
				
				$result = $row;
				
			}
			
			
			if(count($result) > 0){
				$pass = $result['password'];
				$userid = $result['userid'];

				
				if(password_verify($_POST['password'], $pass)){
				
					session_start();
					$_SESSION['loggedIn'] = true;
					$_SESSION['userid'] = $userid;

					
					//This generally should be an absolute URL
					header("Location: http://{$_SERVER['HTTP_HOST']}/assessment2/index.php");
	
					
					
				}
				
				return  "Right email, wrong password";
				
			}else{
				
				return "Invalid username and/or password.";
				
			}
			
			
			
			
			
		}
	}

?>


<html lang="en">
    <head>
        <title>Welcome!</title>
            <link rel="stylesheet" type="text/css" href="CSS/main.css">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="JS/map.js"></script>
    </head>
    <body>
	
		<?php
			$status = loginCheck();		
		?>
	
	
		<div id="wrapper">
			<?php include 'lib/header.php' ?>
		<center>Welcome back!
		<form method="POST" onsubmit="return true;">
			<input type="text" placeholder="Email address" name="email">
			<input type="password" placeholder="Password" name="password">
			<input type="submit">
			
		</form>
		</center>
		<span><?php echo $status . "<br>"; ?></span>
		<a href="register.php">New user?</a>
		</div>
	</body>
</html>