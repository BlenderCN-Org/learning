<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset=utf-8" />
	<title>Images</title>
	<script type="text/javascript" charset="utf-8" src="function.js"></script>
</head>
<body>
<p>Click on an image to view it in a separate window.</p>
<ul>
<?php
date_default_timezone_set ('America/New_York');
$dir = './uploads'; // Set directory
$files = scandir($dir); // Read images into array
//echo '</br><pre>';print_r($files);echo '</pre></br>';

foreach ($files as $image) { // Display each image
	if (substr($image, 0, 1) != '.') { //Ignore elements in $files containing periods
		$image_size = getimagesize("$dir/$image");
		$file_size = round((filesize ("$dir/$image")) / 1024) . "kb";
		$image_date = date("F d, Y H:i:s", filemtime("$dir/$image"));
		$image_name = urlencode($image); // make URL safe

		echo "<li><a href=\"javascript:create_window('$dir/$image_name',$image_size[0],$image_size[1])\">$image</a> $file_size ($image_date)</li>\n"; // Modified so you only need to change directory in this file, and not show_image.php
	} 	
}
?>
</ul>
</body>
</html>