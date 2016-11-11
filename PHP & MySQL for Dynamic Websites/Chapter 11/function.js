//function.js (used by show_image.php, images.php)

function create_window (image, width, height) {
	// Add some pixels to the width and height:
	width = width + 10;
	height = height + 10;
	
	if (window.popup && !window.popup.closed) { // If window already open, set new dimensions
		window.popup.resizeTo(width, height);
	}
	 	
	var specs = "location=no, scrollbars=no, menubars=no, toolbars=no, resizable=yes, left=0, top=0, width=" + width + ", height=" + height; // Set window properties
	var url = "show_image.php?image=" + image; // Set URL for new window 
	 
	popup = window.open(url, "ImageWindow", specs); // Create the new window
	popup.focus();
}

