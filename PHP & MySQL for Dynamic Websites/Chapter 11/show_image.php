<?php
	$name = FALSE;

	if (isset($_GET['image'])) { // If GET info found in URL
	
	$ext = strtolower(substr($_GET['image'], -4)); // Get extension of image
	 	
	 	 if (($ext == '.jpg') OR ($ext == 'jpeg') OR ($ext == '.png')) {
	
	 	 	$image = "{$_GET['image']}"; // Image path
			//$image = "uploads/{$_GET['image']}"; // Image path
	 	 	
			if (file_exists($image) && (is_file($image))) { // Check image exists and is file
	 	 	 	$name = $_GET['image'];	// Set name as current image
	 	 	 }
	 	 }
	 }

if (!$name) { // If problem, display default placeholder
	$image = 'unavailable.png';	
	$name = 'unavailable.png';
	 
}

$info = getimagesize($image); // Get image type
$fs = filesize($image); // Get image size
	
// Send header information
header ("Content-Type: {$info['mime']}\n");
header ("Content-Disposition: inline;filename=\"$name\"\n");
header ("Content-Length: $fs\n");

readfile ($image); // Send file
?>