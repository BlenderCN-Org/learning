<?php
include ('includes/header.html');

$tid = FALSE;

if (isset($_GET['tid']) && filter_var($_GET['tid'], FILTER_VALIDATE_INT, array('min_range' => 1))){
	$tid = $_GET['tid'];
	 
	if (isset($_SESSION['user_tz'])) { // If user logged in
		$posted = "CONVERT_TZ(p.posted_on, 'UTC', '{$_SESSION['user_tz']}')"; // Convert date 
	} else {
		$posted = 'p.posted_on';
	}
	
	$q = "SELECT t.subject, p.message, username, DATE_FORMAT($posted, '%e-%b-%y %l:%i %p') AS posted FROM threads AS t LEFT JOIN posts AS p USING (thread_id) INNER JOIN users AS u ON p.user_id = u.user_id WHERE t.thread_id = $tid ORDER BY p.posted_on ASC";
	$r = mysqli_query($dbc, $q);
	if (!(mysqli_num_rows($r) > 0)) { // Invalid ID
		$tid = FALSE; 
	}	 	
}
	
if ($tid) {	// Get messages in thread
	$printed = FALSE; // Flag variable.
	
	// Fetch each:
	while ($messages = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		if (!$printed) {
			echo "<h2>{$messages['subject']}</h2>\n";
			$printed = TRUE; // So subject's only printed once
		}
		echo "<p>{$messages['username']} ({$messages['posted']})<br />{$messages['message']}</p><br />\n"; // Print each message
	}
	 	 	
	// Show the form to post a message:
	include ('includes/post_form.php'); 	
} else { // Invalid thread ID!
	 	 echo '<p>This page has been accessed in error.</p>';
}
include ('includes/footer.html');
?>