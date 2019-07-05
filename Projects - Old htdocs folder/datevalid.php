<?php
function valid_date($input){
$date_format = 'Y/m/d';
$input = trim($input);
$time = strtotime($input);
echo $time;
echo $is_valid = date($date_format, $time) === $input;
return ($is_valid ? 'yes' : 'no');
}
valid_date('2010/03/03');
?>