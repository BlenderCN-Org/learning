 <?php
	include 'conn.php';
	$userexist = mysql_query("SELECT * FROM users WHERE email='$user_data->email' LIMIT 1");
	/* if(mysql_fetch_array($userexist) == false) // Checks to see if User Exists
	{ */
	$sql = "INSERT INTO users ".
	"(date, first, last, email, lang, location, user, authid) ".
	"VALUES ( NOW(), '$user_data->firstName', '$user_data->lastName', '$user_data->email', '$user_data->language', '$user_data->country', '$user_data->displayName', '$user_data->profileURL' )";
	$retval = mysql_query( $sql, $conn );
	if(! $retval )
	{
	die('Could not enter data: ' . mysql_error());
	}
	/* } */
?>