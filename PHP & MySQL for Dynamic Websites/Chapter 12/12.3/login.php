<?php # Script 12.3 - login.php
	
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Check if form has been submitted
	
	 	 require('../login_functions.inc.php'); // Include used functions
	 	 require('../includes/mysqli_connect.php');
	 	 	
	 	 list($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']); // Check the login:
	 	
	 	 if($check) { // If Login OK
			setcookie('user_id', $data['user_id']);
			setcookie('first_name', $data['first_name']);
			redirect_user('../loggedin.php');
	 	} else {
			$errors = $data; // Assign $data to $errors for error reporting to login_page.inc.php
	 	 }
	 	 	
	 	 mysqli_close($dbc);
	 }
	 include ('../login_page.inc.php');
?>