<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'ch18');

$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
if (!$dbc) { // If not OK, trigger error
	trigger_error ('Could not connect to MySQL: ' . mysqli_connect_error());
} else { // Set encoding
	mysqli_set_charset($dbc, 'utf8');
}

