<?php 
	$page_title = 'Delete a User';
	include ('includes/header.html');
	echo '<h1>Delete a User</h1>';
	
	// Check for a valid GET or POST REQUEST
	 if ( (isset($_GET['id'])) && (is_numeric ($_GET['id'])) ) { // From view_users.php
	 	 $id = $_GET['id'];
	 } elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	 	 $id = $_POST['id'];
	 } else { // No valid ID, kill the script.
	 	 echo '<p class="error">This page has been accessed in error.</p>';
	 	 include ('includes/footer.html');
	 	 exit();
	 }
	
	 require_once ('mysqli_connect.php');
	 
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Check if submit button pressed
	
	 	 if ($_POST['sure'] == 'Yes') { // Delete record.
	 	 	 $q = "DELETE FROM users WHERE user_id=$id LIMIT 1";
	 	 	 $r = @mysqli_query ($dbc, $q);
	 	 	 if (mysqli_affected_rows($dbc) == 1) { // If DELETE query ran OK.
	 	 	 	 echo '<p>The user has been deleted.</p>';	
	
	 	 	 } else { // If DELETE query did not run OK.
	 	 	 	 echo '<p class="error">The user could not be deleted due to a system error.</p>';
	 	 	 	 echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>';
	 	 	 }
	 	 } else { // If $_POST['sure'] != "Yes"
	 	 	 echo '<p>The user has NOT been deleted.</p>';	
	 	 }
	 } else { // Show form
	 	 // Retrieve the user's information:
	 	 $q = "SELECT CONCAT(last_name, ', ', first_name) FROM users WHERE user_id=$id";
	 	 $r = @mysqli_query ($dbc, $q);

	 	 if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
	
	 	 	 $row = mysqli_fetch_array ($r, MYSQLI_NUM); // Put query results into array form
	 	 	
	 	 	 // Display the record being deleted:
	 	 	 echo "<h3>Name: $row[0]</h3>Are you sure you want to delete this user?";
	 	 	
	 	 	 // Display delete dialog
	 	 	 echo '<form action="delete_user.php" method="post"><input type="radio" name="sure" value="Yes" /> Yes<input type="radio" name="sure" value="No" checked="checked" /> No<input type="submit" name="submit" value="Submit" />
	 	 <input type="hidden" name="id" value="' . $id . '" /></form>';
	 	 } else { // if mysql_num_rows != 1
	 	 	 echo '<p class="error">This page has been accessed in error.</p>';
	 	 }
	 } // End of the main submit conditional.
	 mysqli_close($dbc);
	 include ('includes/footer.html');
?>