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
	include 'conn.php';
	$table[0] = "Music";
	$c1 = 'Name';
	$c2 = 'Subject(s)';
	$c3 = 'Platform';
	$c4 = 'Estimated Release Date';
	include 'dybox.php';
	?>
</div>
</div>
	<?php include 'counter.php' ?>
</body>
</html>