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
			$time = time();
			$actual_time = date('d M Y @ H:i:s', $time);

			if ($userid && $username) {
				session_destroy();

				require("./connect.php");

				mysql_query("UPDATE sessions SET session_end = '$actual_time' WHERE session_id = '$sid' AND session_end = ''");

				header( 'Location: ./login.php' ) ;

				mysql_close();

			} else {
				echo "You are not logged in.";
			}
			
		?>

	</body>

</html>