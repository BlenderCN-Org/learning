<?php

echo '<img src="' . $_SERVER['PHP_SELF'] .
     '?=' . php_logo_guid() . '" alt="PHP Logo !" />';

?>

<?php

echo '<img src="' . $_SERVER['PHP_SELF'] .
     '?=' . zend_logo_guid() . '" alt="Zend Logo !" />';

?>

// Preg reaplce /e
//datefmt_set_timezone_id deprecated (use datefmt_set_timezone instead)