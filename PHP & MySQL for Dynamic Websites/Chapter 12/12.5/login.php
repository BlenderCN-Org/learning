<?php # Script 12.5 - login.php
	
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Check if form has been submitted
	
	 	 require('../login_functions.inc.php'); // Include used functions
	 	 require('../loggedin.php');
	 	 	
	 	 list($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']); // Check login
	 	
	 	 if($check) { // If Login OK
			setcookie ('user_id', $data['user_id'], time()+3600, '/', '', 0, 0);
			setcookie ('first_name', $data['first_name'], time()+3600, '/', '', 0, 0);
			
			redirect_user('../loggedin.php');
	 	} else {
			$errors = $data;
	 	 }
	 	 	
	 	 mysqli_close($dbc);
	 }
	 include ('../login_page.inc.php');
?>