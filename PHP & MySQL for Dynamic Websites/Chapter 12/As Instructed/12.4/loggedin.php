<?php # Script 12.4 - loggedin.php - User directed here from login.php
	 
	if (!isset($_COOKIE['user_id'])) {
		require('../login_functions.inc.php');
		redirect_user();
	}
	
	 $page_title = 'Logged In!';
	 include ('../includes/header.html');
	
	 // Print a customized message:
	 echo "<h1>Logged In!</h1><p>You are now logged in, {$_COOKIE['first_name']}!</p><p><a href=\"../includes/logout.php\">Logout</a></p>";
	 include ('../includes/footer.html');
?>