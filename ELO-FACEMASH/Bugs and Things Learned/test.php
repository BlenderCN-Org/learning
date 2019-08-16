<?php
	// BUG: If an automatic global (superglobal) is not used, it may not be present in $GLOBALS
	// See: https://bugs.php.net/bug.php?id=65223&edit=2
	// See also: https://www.php.net/manual/en/reserved.variables.globals.php
	$_SERVER; // Comment this in/out to see how output changes
	echo '<pre>';
	print_r($GLOBALS);
	echo '/<pre>';
?>