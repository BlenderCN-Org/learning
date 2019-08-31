<!doctype html>
<html lang="en">
<head>
	<title>Updayte.com - Stay Updated!</title>
	<meta charset="utf-8">
	<meta name="keywords" content="release date, gone gold, technology, new, upcoming releases" />
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<div id="main">
	<header>
		<div id="logo"></div>
	</header>
		<div id="navbar">
			<ul>
			<li><a href="">Home</a></li>
			<li><a href="">Contact</a></li>
			<li><a href="">Links</a></li>
			<li><a href="">Sitemap</a></li>
			</ul>
		</div>
		<div id="sidebar_container">
		<div id="sidebar">
		Contents:<br/>
		<a href="index.php">Home</a><br/>
		<a href="">Contact</a></a><br/>
		<a href="">Links</a><br/>
		<a href="">Sitemap</a><br/>
		</div>
		<br/>
	</div>
<div id="content">
		<?php
		if(isset($_POST['add']))
		{
		include 'conn.php';
		if(! $conn )
		{
		  die('Could not connect: ' . mysql_error());
		}

		if(! get_magic_quotes_gpc() ) // Escape variables if magic quotes is NOT on. 
		{
		   $name = addslashes ($_POST['name']);
		   $location = addslashes ($_POST['location']);
		}
		else
		{
		   $name = $_POST['name'];
		   $location = $_POST['location'];
		}

		$sql = "INSERT INTO queue ".
			   "(title, location, date) ".
			   "VALUES('$name','$location',NOW())";
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
		<?php
	include 'conn.php';
	$data = mysql_query("SELECT * FROM queue ORDER BY date DESC");
		echo '<div id="tab">Technology</div>';
		echo '<div id="box">';
		echo '<table width=100%>';
		echo '<tr><td class="namecell"><strong>Name:</strong></td><td><strong>Estimated Release:</strong></td><td><strong>Author</strong></td><td><strong>Origin</strong></td><td><strong>Price</strong></td></tr>';
		echo '<tr><td colspan=5><hr/></td></tr>';
	while($info = mysql_fetch_array( $data )) 
	{
		$refined1 = strtoupper($info["title"]);
		echo "<tr>";
		echo '<td class="namecell">' . $refined1 . '</td>';
		echo '<td>' . $info["date"] . '</td>';
		echo '<td></td>';
		echo "</tr>";
	}
	echo '</table>';
	mysql_close();
	?>
		<br/>
		<form method="post" action="<?php $_PHP_SELF ?>">
		<table width="400" cellspacing="1" cellpadding="2" border="1">
		<tr>
		<td width="100">Name</td>
		<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
		<td width="100">Date</td>
		<td><input name="location" type="text" id="location"></td>
		<td>
		<input name="add" type="submit" id="add" value="Publish Comment">
		</td>
		</tr>
		</table>
		</form>
		<?php
		}
		echo '</div>';
		?>
</div>
</div>
</body>
</html>
