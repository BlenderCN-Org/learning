<?php 
require ('includes/config.inc.php');
$page_title = 'Register';
include ('includes/header.html');
	
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	require (MYSQL); // Connect to DB
	 
	$trimmed = array_map('trim', $_POST); // Trim all $_POST data
	
	$fn = $ln = $e = $p = FALSE; // Create invalid values
	 	
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) { // Validate first_name
		$fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);
	} else {
		echo '<p class="error">Please enter your first name!</p>';
	}
	
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) { // Validate last_name
		$ln = mysqli_real_escape_string($dbc, $trimmed['last_name']);
	} else {
		echo '<p class="error">Please enter your last name!</p>';
	}

	if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) { // Validate email
		$e = mysqli_real_escape_string($dbc, $trimmed['email']);
	} else {
		echo '<p class="error">Please enter a valid email address!</p>';
	}
	
	if (preg_match ('/^\w{4,20}$/', $trimmed['password1'])){ // Validate password
		if ($trimmed['password1'] == $trimmed['password2']){ // Make sure passwords match
			$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
	 	} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
	 	}
	} else {
		echo '<p class="error">Please enter a valid password!</p>';
	}
	 	
	if ($fn && $ln && $e && $p) { // If all OK
	 	$q = "SELECT user_id FROM users WHERE email='$e'"; // Get user_id from email
	 	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	 	 	
	 	if (mysqli_num_rows($r) == 0) { // Available, since no rows returned
	 	 	$a = md5(uniqid(rand( ), true)); // Create activation code
	
	 	 	// Add user to database
	 	 	$q = "INSERT INTO users (email, pass, first_name, last_name, active, registration_date) VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$a', NOW())";
	 	 	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	 	 	if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
	 	 	 	$body = "Thank you for registering at <whatever site>. To activate your account, please click on this link:\n\n";
	 	 	 	$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
	 	 	 	mail($trimmed['email'], 'Registration Confirmation', $body, 'From: admin@sitename.com');
	 	 	 	echo '<h3>Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</h3>';
				
				if(!LIVE){ // Echo message body, so link can be used w/o mail function
						echo '<strong>Message Body, for development/testing (Can be turned off with LIVE constant = FALSE):</strong> ' . '<a a href="' . 'activate.php?x=' . urlencode($e) . "&y=$a" . '">' . 'activate.php?x=' . urlencode($e) . "&y=$a" . '</a>';
				}
				
	 	 	 	include ('includes/footer.html');
	 	 	 	exit();
	 	 	} else { // If it did not run OK
				echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
	 	 	}
	 	} else { // Email not available
			echo '<p class="error">That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.</p>';
	 	}
	} else { // If one of the if statements failed
		echo '<p class="error">Please try again.</p>';
	}
	mysqli_close($dbc);
}
?>
<h1>Register</h1><form action="register.php" method="post"><fieldset>
<p><b>First Name:</b> <input type="text" name="first_name" size="20" maxlength="20" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" /></p>
<p><b>Last Name:</b> <input type="text" name="last_name" size="20" maxlength="40" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" /></p>
<p><b>Email Address:</b> <input type="text" name="email" size="30" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" /></p>
<p><b>Password:</b> <input type="password" name="password1" size="20" maxlength="20" value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>" /> <small>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</small></p>
<p><b>Confirm Password:</b> <input type="password" name="password2" size="20" maxlength="20" value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>" /></p>
</fieldset>
<div align="center"><input type="submit" name="submit" value="Register" /></div>
</form>
<?php include ('includes/footer.html'); ?>