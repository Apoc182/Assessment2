<?php

	if (!isset($_SESSION['loggedIn'])) {
		exit();
	}
	session_start();

?>