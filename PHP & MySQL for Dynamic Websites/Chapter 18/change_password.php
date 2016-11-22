<?php
require ('includes/config.inc.php');
$page_title = 'Change Your Password';
include ('includes/header.html');

if (!isset($_SESSION['user_id'])) { // If no first_name in $_SESSION, redirect user
	$url = BASE_URL . 'index.php';
	ob_end_clean();
	header("Location: $url");
	exit();
}
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
	 	 	 	
	$p = FALSE;
	if (preg_match ('/^(\w){4,20}$/', $_POST['password1']) ) { // Validate password
		if ($_POST['password1'] == $_POST['password2']) { // Make sure both fields match
			$p = mysqli_real_escape_string($dbc, $_POST['password1']); 
	 	} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
	 	}
	} else {
		echo '<p class="error">Please enter a valid password!</p>';
	}
	 	
	if ($p) { // If OK
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id={$_SESSION['user_id']} LIMIT 1";
	 	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	 	if (mysqli_affected_rows($dbc) == 1) {
			echo '<h3>Your password has been changed.</h3>';
			
			if(!LIVE){ // Echo message body, so link can be used w/o mail function
				echo '<strong>The query itself, for development/testing (Can be turned off with LIVE constant = FALSE):</strong><br/>' . $q;
			}
			
	 	 	mysqli_close($dbc);
	 	 	include ('includes/footer.html');
	 	 	exit();
	 	} else { // If not OK
			echo '<p class="error">Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think an error occurred.</p>';
	 	}
	} else { // Failed validation
		echo '<p class="error">Please try again.</p>';	 	
	}
	mysqli_close($dbc);
}
?>
<h1>Change Your Password</h1>
<form action="change_password.php" method="post">
<fieldset>
<p><b>New Password:</b>
<input type="password" name="password1" size="20" maxlength="20" />
<small>Use letters, numbers, and the underscore, between 4 and 20 characters long.</small></p>
<p><b>Confirm New Password:</b> <input type="password" name="password2" size="20" maxlength="20" /></p>
</fieldset>
<div align="center">
<input type="submit" name="submit" value="Change My Password" /></div>
</form>
<?php include ('includes/footer.html');
?>