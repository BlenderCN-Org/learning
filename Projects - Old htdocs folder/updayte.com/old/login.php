<?php // login.php
require_once 'openid.php';
$openid = new LightOpenID("updayte.com");

if ($openid->mode) 
{
    if ($openid->mode == 'cancel') 
	{
        echo "User has canceled authentication!";
    } 
	if($openid->validate())
		{
		$data = $openid->getAttributes();
        $email = $data['contact/email'];
        $first = $data['namePerson/first'];
		$last =  $data['namePerson/last'];
		$countryloc = $data['contact/country/home'];
		$preflang = $data['pref/language'];
		$user = $first . $last;
		$authid = $openid->identity;
		<?php include 'conn.php'; ?>
		$userexist = mysql_query("SELECT * FROM users WHERE authid='$authid' LIMIT 1");
		if(mysql_fetch_array($userexist) == false) // Checks to see if User Exists
		{
			$sql = "INSERT INTO users ".
		   "(date, first, last, email, lang, location, user, authid) ".
		   "VALUES ( NOW(), '$first', '$last', '$email', '$preflang', '$countryloc', '$user', '$authid' )";
			$retval = mysql_query( $sql, $conn );
			if(! $retval )
			{
				die('Could not enter data: ' . mysql_error());
			}
			mysql_close($conn);
			echo 'You have successfully logged in!  You are being redirected back to the homepage!';
			$_SESSION['identity'] = $openid->identity;
			$page = 'https://www.updayte.com/index.php';
			$sec = "0.65";
			header("Refresh: $sec; url=$page");
			}
		else // If user exists in My DB
		{
			/* echo 'Country: ' . $countryloc . '<br/>';
			echo 'Language: ' . $preflang . '<br/>';
			echo 'Email: ' . $email . '<br/>';
			echo 'First name ' . $first . '<br/>';
			echo 'Last name ' . $last . '<br/>';
			echo 'AuthID: ' . $authid . '<br/>'; */
			echo 'You are already logged in ' . $email . '. You are now being redirected back to the homepage!';
			$page = 'https://www.updayte.com/index.php';
			$sec = "0.65";
			header("Refresh: $sec; url=$page");
		}
	}
}
?>