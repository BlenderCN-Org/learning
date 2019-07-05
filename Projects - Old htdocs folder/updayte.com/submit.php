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
			$location = addslashes ($_POST['location']);  // Appends the variables to the post data
			$cat = addslashes ($_POST['whichDB123']);
			$date = addslashes ($_POST['date']);
			$author = addslashes ($_POST['author']);
			$source = addslashes ($_POST['source']);
		}
		else // Escapes Magic Quotes if it's *not* on.
		{
			$name = $_POST['name'];
			$author = $_POST['author'];
			$location = $_POST['location'];
			$cat = $_POST['whichDB123'];
			$date = $_POST['date'];
			$source = $_POST['source'];
			
		}

		$sql = "INSERT INTO queue ".
			   "(title, date, author, source, cat) ".
			   "VALUES('$name','$date','$author','$source','$cat')";
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
		include 'sform.php';
		include 'qbox.php';
		}
		?>
</div>
</div>
		<?php include 'counter.php' ?>
</body>
</html>