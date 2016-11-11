<?php
	DEFINE ('DB_USER', 'root');
	DEFINE ('DB_PASSWORD', '');
	DEFINE ('DB_HOST', 'localhost');
	DEFINE ('DB_NAME', 'sitename');
	
	$mysqli = new MySQLi(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); // Make DB connection
	
	if($mysqli->connect_error) { // Verify connection
		echo $mysqli->connect_error;
		unset($mysqli);
	}else{ 
		$mysqli->set_charset('utf8'); // Set encoding.
	}
?>