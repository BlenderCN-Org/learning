<!doctype html>
<html lang="en">
<head>
	<title>Updayte!</title>
	<meta charset="utf-8" />
	<meta name="keywords" content="release date, gone gold, technology, new, upcoming releases" />
	<link rel="stylesheet" href="beta10.css" />
	<link rel="shortcut icon" href="udfavicon.ico" type="image/x-icon" />
	<link rel="icon" href="udfavicon.ico" type="image/x-icon" />
</head>
<body>
<div id="main">
	<header>
		<div id="logo"></div>
		<div id="cdate">
		<?php
		$DOW = $jd=cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
		echo(jddayofweek($jd,1)) . ", " . date("m/d/Y");
		?>
		</div>
	
		<nav id="navbar">
			<ul>
			<?php include 'nav.php'; ?>
			</ul>
		</nav>
	</header>
		<!-- <div id="sidebar_container">
		<div id="sidebar">
		Contents:
		<?php include 'side.php'; ?>
		</div>
		</div> -->
<div id="content">
		<?php
		if(isset($_POST['add'])) // If the submit button has been pressed.
		{
		$dbhost = 'mysql11.000webhost.com';
		$dbuser = 'a9736173_updayte';
		$dbpass = 'Kermit555';
		$conn = mysql_connect($dbhost, $dbuser, $dbpass);
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
		else // Escapes Magic Quotes if it's not on.
		{
			$name = $_POST['name'];
			$author = $_POST['author'];
			$location = $_POST['location'];
			$cat = $_POST['whichDB123'];
			$date = $_POST['date'];
			$source = $_POST['source'];
			
		}

		$sql = "INSERT INTO queue ".
			   "(title, location, date, author, source, cat) ".
			   "VALUES('$name','$location','$date','$author','$source','$cat')";
			mysql_select_db('a9736173_updayte');
			$retval = mysql_query( $sql, $conn ); // Checks to see if MySQL_Query Ran and is true
		if(! $retval )
		{
			die('Could not enter data: ' . mysql_error());
		}
			mysql_close($conn);
			$page = $_SERVER['PHP_SELF'];
			$sec = "0.25";
			header("Refresh: $sec; url=$page");
		}
		else
		{
		?>
		<div id="tab">Submit Date</div>
		<div id="box">
		<center>
		<form method="post" action="<?php $_PHP_SELF ?>">
		<table cellspacing="1" cellpadding="2" border="1">
		<tr>
		<td>Database:</td>
		<td class="center"><select name="whichDB123">
		<option value=""></option>
		<option value="Books">Books</option>
		<option value="Games">Games</option>
		<option value="Mobile">Mobile</option>
		<option value="Movies">Movies</option>
		<option value="Music">Music</option>
		<option value="Technology">Technology</option>
		</select></td></tr>
		<tr>
		<td width="100">Name/Title</td>
		<td><input name="name" type="text" id="name"></td></tr>
		<tr><td>Author/Organization</td><td><input name="author" type="text" id="author"></td></tr>
		<tr><td width="100">Release Date</td><td><input name="date" type="text" id="date"></td></tr>
		<tr><td>Location</td><td><input name="location" type="text" id="location"></td></tr>
		<tr><td>Source</td><td><input name="source" type="text" id="source"></td></tr>
		<tr><td></td><td class="center"><input name="add" type="submit" id="add" value="Submit Update!"></td></tr>
		</table>
		</form>
		</div>
		</center>
		<?php
	mysql_connect("mysql11.000webhost.com", "a9736173_updayte", "Kermit555");
	mysql_select_db("a9736173_updayte");
	$data = mysql_query("SELECT * FROM queue ORDER BY date DESC");
		echo '<div id="tab">Current Queue</div>';
		echo '<div id="box">';
		echo '<table width=100%>';
		echo '<tr class="ttop"><td class="namecell">Name</td><td class="acell">Author</td><td>Location</td><td class="test">Source</td></td><td>Category</td><td>Release Date</td></tr>';
		echo '<tr><td colspan=6><hr/></tr>';
	while($info = mysql_fetch_array( $data )) 
	{
		echo "<tr>";
		echo '<td class="namecell">' . $info["title"] . '</td>';
		echo '<td>' . $info["author"] . '</td>';
		echo '<td>' . $info["location"] . '</td>';
		echo '<td>' . $info["source"] . '</td>';
		echo '<td>' . $info["cat"] . '</td>';
		echo '<td>' . $info["date"] . '</td>';
		echo "</tr>";
	}
	echo '</table>';
	mysql_close();
	?>
		<!-- Where form used to be -->
		<?php
		}
		echo '</div>';
		?>
</div>
</div>
</body>
</html>
