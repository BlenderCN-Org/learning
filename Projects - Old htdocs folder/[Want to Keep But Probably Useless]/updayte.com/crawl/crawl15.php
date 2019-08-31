<html lang="en">
<head>
	<?php include 'css.php'; ?>
</head>
<body>
<div id="main">
		<header>
			<?php include 'head.php'; ?>
		</header>
<div id="content">
		<?php
		if(isset($_POST['add'])) // If the submit button has been pressed.
		{
		include 'conn.php';
		if(! $conn ) // If connection fails, display error message.
		{
		  die('Could not connect: ' . mysql_error());
		}

		if(! get_magic_quotes_gpc() ) // Escape variables if magic quotes is NOT on. 
		{
			$name = addslashes ($_POST['name']);
			  // Appends the variables to the post data
			$cat = addslashes ($_POST['whichDB123']);
			$url = addslashes ($_POST['url']);
		}
		else // Escapes Magic Quotes if it's *not* on.
		{
			$name = $_POST['name'];
			$url = $_POST['url'];
			$cat = $_POST['whichDB123'];
		}

		$sql = "INSERT INTO links ".
			   "(name, url) ".
			   "VALUES('$name','$url')";
			mysql_select_db('updayte');
			$retval = mysql_query( $sql, $conn ); // Checks to see if MySQL_Query Ran / is true
		if(! $retval )
		{
			die('Error: ' . mysql_error());
		}
			mysql_close();
			$page = $_SERVER['PHP_SELF'];
			$sec = "0.25";
			header("Refresh: $sec; url=$page");
		}
		else
		{
		include 'crawl14.php';
		/* include 'lform.php'; */
		include 'subbox.php';
		include 'lbox.php';
		}
		?>

</div>
</div>
		<?php include 'counter.php' ?>
</body>
</html>