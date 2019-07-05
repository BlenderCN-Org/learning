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
	$num = 1;
	$Q = mysql_query("SHOW TABLES");
	while($table = mysql_fetch_array($Q)) 
	{
		if($table[0] <> 'links'){
		include 'dybox.php';
		}
	}
	mysql_close();
	?>
</div>
</div>
	<?php include 'counter.php'; ?>
</body></html>