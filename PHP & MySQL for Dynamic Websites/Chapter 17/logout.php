<?php
	include ('includes/header.html');
	$_SESSION = array(); // Clear _SESSION variables.
	session_destroy(); // Destroy session
	
	
	
	echo '<b>You are now logged out!</b>';
	//echo '<pre>';
	//print_r($_SESSION);
	//echo '</pre>';
	 
	include ('includes/footer.html');
?>