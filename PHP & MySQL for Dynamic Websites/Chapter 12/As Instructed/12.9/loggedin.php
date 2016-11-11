<?php # Script 12.9 - loggedin.php - User directed here from login.php
	 
	session_start();
	
	if (!isset($_SESSION['user_id'])) { // If no session value, redirect user
	 	 require ('includes/login_functions.inc.php');
	 	 redirect_user();
	 }
	
	 $page_title = 'Logged In!';
	 include ('../includes/header.html');
	
	 echo "<h1>Logged In!</h1><p>You are now logged in, {$_SESSION['first_name']}!</p><p><a href=\"../includes/logout.php\">Logout</a></p>";
	 include ('../includes/footer.html');
?>