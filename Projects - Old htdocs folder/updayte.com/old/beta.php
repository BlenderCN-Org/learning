<!doctype html>
<html lang="en">
<head>
	<title>Updayte!</title>
	<meta charset="utf-8" />
	<meta name="keywords" content="release date, gone gold, technology, new, upcoming releases" />
	<?php include 'css.php'; ?>
	<link rel="shortcut icon" href="udfavicon.ico" type="image/x-icon" />
	<link rel="icon" href="udfavicon.ico" type="image/x-icon" />
</head>
<body>
<div id="main">
		<header>
			<?php
			$conn = mysql_connect("localhost", "root", "TyE8qpFEFRwQPRR2");
			mysql_select_db('a9736173_updayte');
			require_once 'openid.php';
			$openid = new LightOpenID("updayte.com");

			$openid->identity = 'https://www.google.com/accounts/o8/id';
			$openid->required = array(
			  'namePerson/first',
			  'namePerson/last',
			  'contact/email',
			  'contact/country/home',
			  'pref/language',
			  'birthdate',
			);
			$openid->returnUrl = 'https://updayte.com/index.php';
				if(isset($_GET['logout']))
			{
				
				$sql2 = "DELETE * FROM users WHERE email='$email'";
				$retval = mysql_query( $sql2, $conn );
			}
		echo '<div id="socbutt" class="lbox">';
		$data = $openid->getAttributes();
        $email = $data['contact/email'];
        $first = $data['namePerson/first'];
		$last =  $data['namePerson/last'];
		$countryloc = $data['contact/country/home'];
		$preflang = $data['pref/language'];
		$user = $first . $last;
		$authid = $openid->identity;
		
		$userquery = mysql_query("SELECT * FROM users WHERE email='$email'");
		$userexist = mysql_query($userquery) or die(mysql_error());
		if (mysql_num_rows($userexist))
		{
			echo '<div class="zocial google" id="gbutton"><a href="index.php?logout="">Log Out</a></div>';
		}
		else
		{
			echo '<div class="zocial google" id="gbutton"><a href="' . $openid->authUrl() . '">Sign-in!</a></div>';
			$sql = "INSERT INTO users ".
		   "(date, first, last, email, lang, location, user, authid) ".
		   "VALUES ( NOW(), '$first', '$last', '$email', '$preflang', '$countryloc', '$user', '$authid' )";
		   $retval = mysql_query( $sql, $conn );
		}
		include 'head.php'; 
		?>
		</form>
		<div id="navbar">
			<ul>
			<?php include 'nav.php'; ?>
			</ul>
		</div>
		</header>
<div id="content">
<?php
	mysql_connect("localhost", "root", "TyE8qpFEFRwQPRR2");
	mysql_select_db("updayte");
	$query1 = mysql_query("SHOW TABLES");
	while($table = mysql_fetch_array($query1)) 
	{
		include 'box.php';
	}
	?>
</div>
</div>
<?php include 'counter2.php';?>
</body>
</html>