<!DOCTYPE html>
<html lang="en">
<head><meta charset=utf-8" /><title>PHP Template</title></head>
<body>
<p>This is standard HTML.</p>
<?php
//Define constants
define ('TODAY', 'March 16, 2011');

echo 'Today is <b>' . TODAY . '</b>';
echo '<br/><br/>';
echo 'This server is running version <b>' .
PHP_VERSION . '</b> of PHP on the <b>' .
PHP_OS . '</b> operating system.</p>';
?>
</body>
</html>