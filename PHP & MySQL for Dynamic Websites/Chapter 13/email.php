<!DOCTYPE html>
	 <html lang="en">
	 <head>
	 	 <meta charset="utf-8" />
	 	 <title>Contact Me</title>
	 </head>
<body>
<h1>Contact Me</h1>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Check for POST/submission
		
	function spam_scrubber($value) {
			
		$very_bad = array('to:', 'cc:', 'bcc:', 'content-type:', 'mime-version:', 'multipart-mixed:', 'content-transfer-encoding:'); // Bad values
			
		
		foreach ($very_bad as $v) { // Loop through $very_bad array
			if (stripos($value, $v) !== false) return ''; // If bad string found, return empty string
		}
			
		$value = str_replace(array( "\r", "\n", "%0a", "%0d"), ' ', $value); // Replace newline chars with spaces
			
		return trim($value);
	}
		
	// Call spam_scrubber() on each array element
	$scrubbed = array_map('spam_scrubber', $_POST); 
		
 	if(!empty($scrubbed['name']) && !empty($scrubbed['email']) && !empty($scrubbed['comments']) ) {
		//$body = "Name: {$_POST['name']}\n \nComments: {$_POST['comments']}"; // Old body
		$body = "Name: {$scrubbed['name']}\n\nComments: {$scrubbed['comments']}";
		$body = wordwrap($body, 70);
		
		if(mail('your_email@example.com', 'Contact Form Submission', $body, "From: {$scrubbed['email']}")){
			echo '<p><em>Thank you for contacting me. I will reply some day.</em></p>'; // Display message on success
			$_POST = array(); // Clear $_POST, so form is not sticky
		}else{
			echo '<p>Mail function failed!</p>';
		}
 	} else {
 	 	 echo '<p style="font-weight: bold; color: #C00">Please fill out the form completely.</p>';
 	}
}
?>
	<p>Please fill out this form to contact me.</p>
	<form action="email.php" method="post">
	<p>Name: <input type="text" name="name" size="30" maxlength="60" value="<?php if(isset($scrubbed['name'])) echo $scrubbed['name']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="30" maxlength="80" value="<?php if(isset($scrubbed['email'])) echo $scrubbed['email']; ?>" /></p>
	<p>Comments: <textarea name="comments" rows="5" cols="30"><?php if(isset($scrubbed['comments'])) echo $scrubbed['comments']; ?></textarea></p>
	<p><input type="submit" name="submit" value="Send!" /></p>
</form>
</body>
</html>