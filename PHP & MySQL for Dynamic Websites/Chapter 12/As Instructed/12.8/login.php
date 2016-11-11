<?php # Script 12.8 - login.php
// Login with sessions
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Check if form has been submitted
	
	 	 require('../login_functions.inc.php'); // Include used functions
	 	 require('../includes/mysqli_connect.php');
	 	 	
	 	 list($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']); // Check the login:
	 	
	 	 if($check) { // If Login OK
			session_start();
			$_SESSION['user_id'] =  $data'user_id'];
			$_SESSION['first_name'] =  $data['first_name'];
			
			redirect_user('../12.9/loggedin.php');
	 	} else {
			$errors = $data; // Assign $data to $errors for error reporting to login_page.inc.php
	 	 }
	 	 	
	 	 mysqli_close($dbc);
	 }
	 include ('../login_page.inc.php');
?>