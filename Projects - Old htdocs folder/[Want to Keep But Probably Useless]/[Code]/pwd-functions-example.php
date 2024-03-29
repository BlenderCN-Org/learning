<?php

// THESE FUNCTIONS WILL WORK WITH PHP 5.5
// if you want to use them with PHP 5.3 or 5.4 you'll need to include
// the lib/password.php file from this project:
// https://github.com/ircmaxell/password_compat/

echo "Please note: These functions need at least PHP 5.3.7<br/>";
echo "You are running PHP ".phpversion();
echo "<br/>";

// hashing & salting a password (salt will be auto-generated)
$pass = 'mysecretpassword';
$hash = password_hash($pass, PASSWORD_DEFAULT);
echo $hash;
echo "<br/>";
echo "Length hash: ".strlen($hash)."<br/>";

// checking if the password fits to the saved hash/salt-string
var_dump(password_verify($pass, $hash));
echo "<br/>";

// checking if the password fits to the saved hash/salt-string
// intentionally using a wrong password
$wrong_pass = 'atotallywrongpassword';
var_dump(password_verify($wrong_pass, $hash));
echo "<br/>";

// getting info from hash string, useful for checking if the hash
// is outdated (happens when your hashes are hashed with cost
// factor 7, but after some time you decide to increase it to 8)
var_dump(password_get_info($hash));
echo "<br/>";

// checking the password rehash function
// same cost factor like before, so the function should return false
$options['cost'] = 10;
var_dump(password_needs_rehash($hash, PASSWORD_DEFAULT, $options));
echo "<br/>";

// we increase the cost factor, so the function should return true
$options['cost'] = 11;
var_dump(password_needs_rehash($hash, PASSWORD_DEFAULT, $options));
echo "<br/>";

// let's rehash a password with the new cost factor from $options:
// (btw 10 is the internal standard)
$hash = password_hash($pass, PASSWORD_DEFAULT, $options);
echo $hash;
echo "<br/>";
echo "Length hash: ".strlen($hash)."<br/>";

// finally, some time tests: cost factor 7
$options['cost'] = 7;
$runtime_start = microtime(true);
password_hash($pass, PASSWORD_DEFAULT, $options);
$runtime_end = microtime(true);
$runtime_total = $runtime_end - $runtime_start;
echo "Runtime with cost factor 7: ".$runtime_total." seconds<br/>";

// finally, some time tests: cost factor 10
$options['cost'] = 10;
$runtime_start = microtime(true);
password_hash($pass, PASSWORD_DEFAULT, $options);
$runtime_end = microtime(true);
$runtime_total = $runtime_end - $runtime_start;
echo "Runtime with cost factor 10: ".$runtime_total." seconds<br/>";

?>