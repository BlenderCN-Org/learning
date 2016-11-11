<?php # Script 12.5 - login.php
// Login w/ custom cookie
	
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Check if form has been submitted
	
	 	 require('../login_functions.inc.php'); // Include used functions
	 	 require('../includes/mysqli_connect.php');
	 	 	
	 	 list($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']); // Check the login:
	 	
	 	 if($check) { // If Login OK
			setcookie ('user_id', $data['user_id'], time()+3600, '/', '', 0, 0);
			setcookie ('first_name', $data['first_name'], time()+3600, '/', '', 0, 0);
			
			redirect_user('../12.4/loggedin.php');
	 	} else {
			$errors = $data; // Assign $data to $errors for error reporting to login_page.inc.php
	 	 }
	 	 	
	 	 mysqli_close($dbc);
	 }
	 include ('../login_page.inc.php');
?>