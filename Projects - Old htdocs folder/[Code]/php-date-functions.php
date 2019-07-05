<?php
echo date_default_timezone_get() . ' => ' . date('e') . ' => ' . date('T');
echo '<br/>';
/* date_default_timezone_set("Asia/Bangkok"); */

date_default_timezone_set("America/New_york");

$date = 'July 25 2014';
echo date('d/m/Y', strtotime($date));

echo '<br/><br/>';

$date = date_parse('July');
var_dump($date['month']); // Returns 'int(7)'

echo '<br/><br/>';

if (date_default_timezone_get()) {
    echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
}

if (ini_get('date.timezone')) {
    echo 'date.timezone: ' . ini_get('date.timezone');
}

echo '<br/><br/>';

$script_tz = date_default_timezone_get();

if (strcmp($script_tz, ini_get('date.timezone'))){
    echo 'Script timezone differs from ini-set timezone.';
} else {
    echo 'Script timezone and ini-set timezone match.';
}

echo '<br/><br/>';

echo date_default_timezone_get() . ' => ' . date('e') . ' => ' . date('T');

echo '<br/><br/>';

echo 'String to Time: ' . var_dump(strtotime("December 12 1983")) . '<br/>';
?>
