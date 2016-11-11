<?php
if (!isset($words)) {
	header ("Location: http://www.example.com/index.php"); // Redirect
	exit();
}
	

if (isset($_SESSION['user_id'])) { // Display form if user logged in
	
	echo '<form action="post.php" method="post" accept-charset="utf-8">';
	
	if (isset($tid) && $tid) { // If on read.php...
	 	echo '<h3>' . $words['post_a_reply'] . '</h3>';
	 	echo '<input name="tid" type="hidden" value="' . $tid . '" />'; // Add the thread ID as a hidden input:
	}else{ // New thread
		echo '<h3>' . $words['new_thread'] . '</h3>'; // Print Caption
	 	
	 	echo '<p><em>' . $words['subject'] . '</em>: <input name="subject" type="text" size="60" maxlength="100" '; // Create subject input:

	 	if (isset($subject)) { // Check for existing value:
			echo "value=\"$subject\" ";
	 	}
		echo '/></p>';
	}
	
	echo '<p><em>' . $words['body'] . '</em>: <textarea name="body" rows="10" cols="60">'; // Create the body textarea:
	
	if (isset($body)) {
		echo $body;
	}
	
	echo '</textarea></p><input name="submit" type="submit" value="' . $words['submit'] . '" /></form>';
} else {
	echo '<p>You must be logged in to post messages.</p>';
}
?>