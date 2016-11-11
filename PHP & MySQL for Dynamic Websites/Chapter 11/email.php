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
		
	 	if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comments'])) { // Simple form validation
			$body = "Name: {$_POST['name']}\n \nComments: {$_POST['comments']}";
			$body = wordwrap($body, 70);
			
			if(mail('your_email@example.com', 'Contact Form Submission', $body, "From: {$_POST['email']}")){
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
	 <p>Name: <input type="text" name="name" size="30" maxlength="60" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" /></p>
	 <p>Email Address: <input type="text" name="email" size="30" maxlength="80" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
	 <p>Comments: <textarea name="comments" rows="5" cols="30"><?php if (isset($_POST['comments'])) echo $_POST['comments']; ?></textarea></p>
	 <p><input type="submit" name="submit" value="Send!" /></p>
</form>
</body>
</html>