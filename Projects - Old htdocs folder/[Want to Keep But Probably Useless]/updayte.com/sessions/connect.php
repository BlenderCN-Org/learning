<?php
	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_password = '';
	$mysql_database = 'books';

	/* mysql_connect($mysql_host, $mysql_user, $mysql_password); */
	mysql_select_db($mysql_database);
	
	$con = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);
	mysqli_select_db($mysql_database);

	// Check connection
	if (mysqli_connect_errno())
	{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

?>