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
		<title>Login</title>
	</head>

	<body>
		<?php

			if ($userid && $username) {
				echo "You are already logged in as <b>$username</b>. Do you wish to <a href = './logout.php'>logout</a>?";

			} else {
			
				$form = "<form action = './login.php' method = 'POST'>
					<table>
						<tr>
							<td>Username:</td>
							<td><input type = 'text' name = 'user' /></td>

						</tr>

						<tr>
							<td>Password:</td>
							<td><input type = 'password' name = 'password' /></td>

						</tr>

						<tr>
							<td></td>
							<td><input type = 'submit' name = 'loginbtn' value = 'Login'/></td>

						</tr>

					</table>

				</form>";

				if ($_POST['loginbtn']) {
					$user = $_POST['user'];
					$password = $_POST['password'];

					if ($user) {
						if ($password) {
							require("connect.php");

							$query = "SELECT * FROM users WHERE username = '$user'";
							$query_run = mysql_query($query);
							$numrows = mysql_num_rows($query_run);
							if ($numrows == 1) {
								$row = mysql_fetch_assoc($query_run);
								$dbid = $row['id'];
								$dbuser = $row['username'];
								$dbpass = $row['password'];

								if ($password == $dbpass) {			
									$_SESSION['userid'] = $dbid;
									$_SESSION['username'] = $dbuser;

									$http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
									$http_x_fowarded_for = $_SERVER['HTTP_X_FOWARDED_FOR'];
									$remote_addr = $_SERVER['REMOTE_ADDR'];

									if (!empty($http_client_ip)) {
										$ip = $http_client_ip;
									} elseif (!empty($http_x_fowarded_for)) {
										$ip = $http_x_fowarded_for;
									} else {
										$ip = $remote_addr;
									}

									$time = time();
									$actual_time = date('d M Y @ H:i:s', $time);

									mysql_query("INSERT INTO sessions VALUES ('$sid', '$dbid', '$dbuser', '$ip', '$actual_time', '')");

									echo "You have been logged in as <b>$dbuser</b>. Click <a href = './logout.php'>here<a> to logout.";
									
								} else {
									echo "You did not enter the correct password. $form";
								}
								
							} else {
								echo "The username: <b>$user</b> was not found. $form";
							}
							
							mysql_close();

						} else {
							echo "You must enter your password. $form";
						}
						
					} else {
						echo "You must enter your username. $form";
					}
					
					
				} else {
					echo $form;
				}
			
			}

		?>

	</body>

</html>