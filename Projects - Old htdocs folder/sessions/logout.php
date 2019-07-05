<?php

	error_reporting(E_ALL ^ E_NOTICE);
	session_start();
	$sid = session_id();
	$userid = $_SESSION['userid'];
	$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<title>Logout</title>
	</head>

	<body>
	<?php
		if(isset($_POST['add'])) // If the submit button has been pressed.
		{
		include 'connect.php';
		if(! $con ) // If connection fails, display error message.
		{
		  die('Could not connect: ' . mysql_error());
		}
		}
		
			$time = time();
			$actual_time = date('d M Y @ H:i:s', $time);

			if ($userid && $username) {
				session_destroy();

				require("./connect.php");

				mysqli_query($con, "UPDATE sessions SET session_end = '$actual_time' WHERE session_id = '$sid' AND session_end = ''");

				header( 'Location: ./login.php' ) ;

				mysqli_close($con);

			} else {
				echo "You are not logged in.";
			}
			
		?>

	</body>

</html>