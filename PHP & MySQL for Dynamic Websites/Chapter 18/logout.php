<?php
require ('includes/config.inc.php');
$page_title = 'Logout';
include ('includes/header.html');

if (!isset($_SESSION['first_name'])) { //  Redirect if 'first_name' not in $_SESSION
	$url = BASE_URL . 'index.php';
	ob_end_clean( ); // Delete the buffer.
	header("Location: $url"); // Redirect
	exit(); // Quit the script.
} else { // Log out the user.
	$_SESSION = array(); // Empty session
	session_destroy(); // Destroy session
	setcookie (session_name(), '', time()-3600); // Destroy cookie
}

echo '<h3>You are now logged out.</h3>';
include ('includes/footer.html');
?>