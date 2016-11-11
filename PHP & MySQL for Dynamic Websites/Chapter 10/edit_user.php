<?php // This script accessed/executed via view_users.php.

	 $page_title = 'Edit a User';
	 include ('includes/header.html');
	 echo '<h1>Edit a User</h1>';
	
	 // Check for user ID, through GET/POST:
	 if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) { // Check GET/URL for variables
	 	 $id = $_GET['id'];
	 } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) { // Check POST/form for variables
	 	 $id = $_POST['id'];
	 } else { // If no valid ID found via GET/POST, exit script and display footer
	 	 echo '<p class="error">This page has been accessed in error.</p>';
	 	 include ('includes/footer.html');
	 	 exit();
	 }
	
	 require_once ('mysqli_connect.php');
	
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	 	 $errors = array();

		// Check for, and map, 'first_name' $_POST submission to variable
	 	 if (empty($_POST['first_name'])) {
	 	 	 $errors[] = 'You forgot to enter your first name.';
	 	 } else {
	 	 	 $fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	 	 }
	 	
	 	 // Check for, and map, 'last_name' $_POST submission to variable
	 	 if (empty($_POST['last_name'])) {
	 	 	 $errors[] = 'You forgot to enter your last name.';
	 	 } else {
	 	 	 $ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	 	 }
	
		// Check for, and map, 'email' $_POST submission to variable
	 	 if (empty($_POST['email'])) {
	 	 	 $errors[] = 'You forgot to enter your email address.';
	 	 } else {
	 	 	 $e = mysqli_real_escape_string	($dbc, trim($_POST['email']));
	 	 }
	 	
	 	 if (empty($errors)) { // If $errors array empty
	 	 	 $q = "SELECT user_id FROM users WHERE email='$e' AND user_id != $id"; // Query to see if email registered to another user
	 	 	 $r = @mysqli_query($dbc, $q);
	 	 	 if (mysqli_num_rows($r) == 0) { // If email not registered to another user
	 	 	 	$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e' WHERE user_id=$id LIMIT 1"; // Create query to change user's information
	 	 	 	$r = @mysqli_query ($dbc, $q);
	 	 	 	if (mysqli_affected_rows($dbc) == 1) { // If query successful
					echo '<p>The user has been edited.</p>';
				} else { // If query not successful
	 	 	 	 	 echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>';
	 	 	 	 	 echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>';
	 	 	 	}
	 	 	 } else { // Email already registered.
	 	 	 	 echo '<p class="error">The email address has already been registered.</p>';
	 	 	 }
	 	 } else { // Report the errors.
	 	 	 echo '<p class="error">The following error(s) occurred:<br />';
	 	 	 foreach ($errors as $msg) { // Print errors
	 	 	 	 echo " - $msg<br />\n";
	 	 	 }
	 	 	 echo '</p><p>Please try again.</p>';
	 	 }
	 }
	
	$q = "SELECT first_name, last_name, email FROM users WHERE user_id=$id"; // Query for user's information based on 'user_id'
	$r = @mysqli_query ($dbc, $q);
	
	if (mysqli_num_rows($r) == 1) { // Valid ID returned, show form
		$row = mysqli_fetch_array ($r, MYSQLI_NUM); // Fetch users information into array
	 	echo '<form action="edit_user.php" method="post"><p>First Name: <input type="text" name="first_name" size="15" maxlength="15" value="' . $row[0] . '" /></p>
		<p>Last Name: <input type="text" name="last_name" size="15" maxlength="30" value="' . $row[1] . '" /></p><p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="' . $row[2] . '" /></p><p><input type="submit" name="submit" value="Submit" /></p><input type="hidden" name="id" value="' . $id . '" /></form>'; // Display form with user's information
	 } else { // ID invalid
	 	echo '<p class="error">This page has been accessed in error.</p>';
	 }
	 mysqli_close($dbc);	 	
	 include ('includes/footer.html');
?>