<?php 
	$page_title = 'View the Current Users';
	include ('includes/header.html');
	
	echo '<h1>Registered Users</h1>';
	
	require ('mysqli_connect.php');
	 	 	
	//$q = "SELECT CONCAT(last_name, ', ', first_name) AS name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr FROM users ORDER BY registration_date ASC";	 	
	$q = "SELECT last_name, first_name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr, user_id FROM users ORDER BY registration_date ASC";
	$r = @mysqli_query ($dbc, $q);
	
	$num = mysqli_num_rows($r);

	 if ($num > 0) { // If OK, display records
		echo "<p>There are currently $num registered users.</p><br/>"; // Print number of users
		
	 	//echo '<table align="center" cellspacing="3" cellpadding="3" width="75%"><tr><td align="left"><b>Name</b></td><td align="left"><b>Date Registered</b></td></tr>';
	 	echo '<table align="center" cellspacing="3" cellpadding="3" width="75%"><tr><td align="left"><b>Edit</b></td><td align="left"><b>Delete</b></td><td align="left"><b>Last Name</b></td><td align="left"><b>First Name</b></td><td align="left"><b>Date Registered</b></td></tr>';
		
		
	 	 // Fetch and print all the records
	 	 while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	 	 	 //echo '<tr><td align="left">' . $row['name'] . '</td><td align="left">' . $row['dr'] . '</td></tr>';
			 echo '<tr><td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td><td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td><td align="left">' . $row['last_name'] . '</td><td align="left">' . $row['first_name'] . '</td><td align="left">' . $row['dr'] . '</td></tr>';
	 	 }
	 	 
		 echo '</table>';
	 	 mysqli_free_result ($r); // Free up resources.	
	 } else {
		echo '<p class="error">There are currently no registered users.</p>';
		echo '<p class="error">The current users could not be retrieved. We apologize for any inconvenience.</p>';
	 	echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
	 }
	 mysqli_close($dbc);
	 include ('includes/footer.html');
?>