<?php

	session_unset();
	session_destroy();
	session_write_close();
	setcookie(session_name(),'',0,'/');
	session_regenerate_id(true);
	header("Location: http://{$_SERVER['HTTP_HOST']}/students/n9431594/login.php");
	

?>