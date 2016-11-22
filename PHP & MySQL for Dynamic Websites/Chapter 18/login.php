<?php
require ('includes/config.inc.php');
$page_title = 'Login';
include ('includes/header.html');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	require (MYSQL); // Connect to DB
	
	// Validate email
	if (!empty($_POST['email'])) {
		$e = mysqli_real_escape_string($dbc, $_POST['email']);
	} else {
	 	$e = FALSE;
	 	echo '<p class="error">You forgot to enter your email address!</p>';
	}
	 	
	// Validate password
	if (!empty($_POST['pass'])) {
		$p = mysqli_real_escape_string($dbc, $_POST['pass']);
	} else {
		$p = FALSE;
	 	echo '<p class="error">You forgot to enter your password!</p>';
	}
	 	
	if ($e && $p) { // Email/password have been validated, above
	 	$q = "SELECT user_id, first_name, user_level FROM users WHERE (email='$e' AND pass=SHA1('$p')) AND active IS NULL";	//Find user/pass combination	
	 	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	 	
		if (@mysqli_num_rows($r) == 1) { // If row returned
	 	 	$_SESSION = mysqli_fetch_array($r, MYSQLI_ASSOC); // Transfer array of result into $_SESSION
	 	 	mysqli_free_result($r);
	 	 	mysqli_close($dbc);
	 	 	//$url = BASE_URL . 'index.php';
	 	 	$url = BASE_URL . 'index.php';
			ob_end_clean();
	 	 	header("Location: $url"); // Redirect user
	 	 	exit();
	 	 	
	 	} else { // No row returned
			echo '<p class="error">Either the email address and password entered do not match those on file or you have not yet activated your account.</p>';
	 	}
	 	 	
	} else { // If everything wasn't OK.
		echo '<p class="error">Please try again.</p>';
	} 	
	mysqli_close($dbc);	
}
?>
<h1>Login</h1>
<p>Your browser must allow cookies in order to log in.</p>
<form action="login.php" method="post">
<fieldset>
<p><b>Email Address:</b> <input type="text" name="email" size="20" maxlength="60" /></p>
<p><b>Password:</b> <input type="password" name="pass" size="20" maxlength="20" /></p>
<div align="center"><input type="submit" name="submit" value="Login" /></div>
</fieldset>
</form>	
<?php include ('includes/footer.html'); 
?>