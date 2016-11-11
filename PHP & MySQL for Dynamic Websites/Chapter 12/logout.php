<?php # Script 12.11 - logout.php
	
	 if (!isset($_COOKIE['user_id'])) {
	 	 require ('login_functions.inc.php');
	 	 redirect_user('login_page.inc.php');
	 } else {
		$_SESSION = array(); // Clear _SESSION variables.
		@session_destroy(); // Destroy session
		setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy cookie
	 }
	
	 $page_title = 'Logged Out!';
	 include ('/includes/header.html');
	
	 echo "<h1>Logged Out!</h1><p>You are now logged out, {$_COOKIE['first_name']}!</p>";
	 include ('/includes/footer.html');
?>