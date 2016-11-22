<?php
require ('includes/config.inc.php');
$page_title = 'Forgot Your Password';
include ('includes/header.html');
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL); // Connect to DB
	$uid = FALSE; // Default FALSE
	
	if (!empty($_POST['email'])) { // Validate the email address...
		
		// Check for the existence of that email address...
	 	$q = 'SELECT user_id FROM users WHERE email="'. mysqli_real_escape_string ($dbc, $_POST['email']) . '"';
	 	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	 	
		if (mysqli_num_rows($r) == 1) { // If query validating email returns result
			list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
		}else { // No database match made.
			echo '<p class="error">The submitted email address does not match those on file!</p>';
	 	}
 	 	
	}else{ // No 'email' value in $_POST
	 	 	 echo '<p class="error">You forgot to enter your email address!</p>';
	}
	 	
	if ($uid) { // If $uid has value
		$p = substr ( md5(uniqid(rand(), true)), 3, 10); // Create random password
		
	 	$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=$uid LIMIT 1"; // Update 'pass' DB field based on $uid
	 	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
		if (mysqli_affected_rows($dbc) == 1) { // If OK
	 	 	$body = "Your password to log into <whatever site> has been temporarily changed to '$p'. Please log in using this password and this email address. Then you may change your password to something more familiar.";
	 	 	
			mail ($_POST['email'], 'Your temporary password.', $body, 'From: admin@sitename.com'); // Send email
	 	 	 	
	 	 	// Print a message and wrap up:
	 	 	echo '<h3>Your password has been changed. You will receive the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</h3>';
	 	 	
			if(!LIVE){ // Echo message body, so link can be used w/o mail function
				echo '<strong>Message Body, for development/testing (Can be turned off with LIVE constant = FALSE):</strong><br/>' . $body;
			}
			
			mysqli_close($dbc);
	 	 	include ('includes/footer.html');
	 	 	exit();
	 	 	 	
	 	} else { // If not OK
			echo '<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';
	 	}
	}else{
		echo '<p class="error">Please try again.</p>';
	}
	
	mysqli_close($dbc);
}
?>
<h1>Reset Your Password</h1>
<p>Enter your email address below and your password will be reset.</p>
<form action="forgot_password.php" method="post">
<fieldset><p><b>Email Address:</b>
<input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
</fieldset>
<div align="center"><input type="submit" name="submit" value="Reset My Password" /></div>
</form>	
<?php include ('includes/footer.html');
?>