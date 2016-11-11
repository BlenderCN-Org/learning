<!DOCTYPE html>
	 <html lang="en">
	 <head>
	 	 <meta charset="utf-8" />
	 	 <title>Upload RTF Document</title>
	 </head>
	 <body>
<?php # Script 13.3 - upload_rtf.php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		// Check for an uploaded file:
		if(isset($_FILES['upload']) && file_exists($_FILES['upload']['tmp_name'])){
			
			// The below line needs "extension=php_fileinfo.dll" uncommented in php.ini
			$fileinfo = finfo_open(FILEINFO_MIME_TYPE); // Create the resource
			
			if (finfo_file($fileinfo, $_FILES['upload']['tmp_name']) == 'text/rtf') { // Make sure file is .rtf
				
				echo '<p><em>The file would be acceptable!</em></p>';

				unlink($_FILES['upload']['tmp_name']); // In theory, move the file over. In reality, delete the file:
					 } else { // Invalid type
						 echo '<p style="font-weight: bold; color: #C00">Please upload an RTF document.</p>';
					 }
			finfo_close($fileinfo); // Close resource
		}				
}
?>
	 <form enctype="multipart/form-data" action="upload_rtf.php" method="post">
	 	 <input type="hidden" name="MAX_FILE_SIZE" value="524288" />
	 	 <fieldset><legend>Select an RTF document of 512KB or smaller to be uploaded:</legend>
	 	 <p><b>File:</b> <input type="file" name="upload" /></p></fieldset>
	 	 <div align="center"><input type="submit" name="submit" value="Submit" /></div>
</form>
</body>
</html>