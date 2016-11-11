<!DOCTYPE html>
	 <html lang="en">
	 <head>
	 	 <meta charset="utf-8" />
	 	 <title>Post a Message</title>
	 </head>
<body>
<?php # Script 13.6 - post_message.php
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 	$dbc = mysqli_connect ('localhost', 'root', '', 'forum'); // Connect to DB
	
	$q = 'INSERT INTO messages (forum_id, parent_id, user_id, subject, body, date_entered) VALUES (?, ?, ?, ?, ?, NOW())'; // Create SQL with ? values
	$stmt = mysqli_prepare($dbc, $q); // Prepare statement
	mysqli_stmt_bind_param($stmt, 'iiiss', $forum_id, $parent_id, $user_id, $subject, $body); // Bind variables
	 	
	$forum_id = (int)$_POST['forum_id'];
	$parent_id = (int)$_POST['parent_id'];
	$user_id = 3; // Set $user_id manually
	$subject = strip_tags($_POST['subject']); // Remove potentially malicious HTML
	$body = strip_tags($_POST['body']); // Remove potentially malicious HTML
	
	mysqli_stmt_execute($stmt); // Execute prepared statement
	
	if (mysqli_stmt_affected_rows($stmt) == 1) { // Print message based on result
		echo '<p>Your message has been posted.</p>';
	 	}else{
			echo '<p style="font-weight: bold; color: #C00">Your message could not be posted.</p>';
			echo '<p>' . mysqli_stmt_error($stmt) . '</p>';
	}
	mysqli_stmt_close($stmt); // Close statement
	mysqli_close($dbc);
}
?>
	<form action="post_message.php" method="post">
 	<fieldset><legend>Post a message:</legend>	
 	<p><b>Subject</b>: <input name="subject" type="text" size="30" maxlength="100" /></p>
 	<p><b>Body</b>: <textarea name="body" rows="3" cols="40"></textarea></p></fieldset>
 	<div align="center"><input type="submit" name="submit" value="Submit" /></div>
 	<input type="hidden" name="forum_id" value="1" />
	<input type="hidden" name="parent_id" value="0" />
</form>
</body>
</html>