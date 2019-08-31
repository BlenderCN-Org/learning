<html lang="en">
<head>
	<?php include 'css.php'; ?>
</head><body>
<div id="main">
		<header>
			<?php include 'head.php'; ?>
		</header>
<div id="content">
<?php
	include 'conn.php';
	$query1 = mysql_query("SHOW TABLES");
	while($table = mysql_fetch_array($query1)) 
	{
		include 'box.php';
	}
	mysql_close();
	?>
</div>
</div>
	<?php include 'counter.php' ?>
</body></html>