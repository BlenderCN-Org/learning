

<!-- There are a few ways to prevent session fixation (do all of them):

Set session.use_trans_sid = 0 in your php.ini file. This will tell PHP not to include the identifier in the URL, and not to read the URL for identifiers.

Set session.use_only_cookies = 1 in your php.ini file. This will tell PHP to never use URLs with session identifiers.

Regenerate the session ID anytime the session's status changes. That means any of the following:

User authentication
Storing sensitive info in the session
Changing anything about the session
etc...


$currentCookieParams = session_get_cookie_params(); 

$rootDomain = '.example.com'; 

session_set_cookie_params( 
    $currentCookieParams["lifetime"], 
    $currentCookieParams["path"], 
    $rootDomain, 
    $currentCookieParams["secure"], 
    $currentCookieParams["httponly"] 
); 

session_name('mysessionname'); 
session_start(); 

setcookie($cookieName, $cookieValue, time() + 3600, '/', $rootDomain); 
-->
<?php
$s = 'monkey';
$t = 'many monkeys';

printf("[%s]\n",      $s); // standard string output
printf("[%10s]\n",    $s); // right-justification with spaces
printf("[%-10s]\n",   $s); // left-justification with spaces
printf("[%010s]\n",   $s); // zero-padding works on strings too
printf("[%'#10s]\n",  $s); // use the custom padding character '#'
printf("[%10.10s]\n", $t); // left-justification but with a cutoff of 10 characters
?>

<?php




$num = 5;
$location = 'tree';

$format = 'There are %d monkeys in the %s';
// echo sprintf($format, $num, $location);
echo "<br/>";


$format = 'The %2$s contains %1$d monkeys.
           That\'s a nice %2$s full of %1$d monkeys.';
echo sprintf($format, $num, $location);
?>


<?php
$var1 = "Hello";
$var2 = "Hello";
if (strcmp($var1, $var2) !== 0) {
    echo '$var1 is not equal to $var2 in a case sensitive string comparison';
}
echo "<br/>";

?>


<?PHP
	session_start();
	$str = 'abcdefg';
	echo $str{4};
	echo $str[4];
	
	echo "<br/>";
	
	

	
	printf("Client library version: %s\n", mysqli_get_client_info());
	echo "<br/>";
	ini_set('session.hash_function','md5');
	session_regenerate_id();
	echo 'md5: ' . session_id();
	echo '<br/>';
	ini_set('session.hash_function','whirlpool');
	session_regenerate_id();
	echo 'wp: ' . session_id();
	echo '<br/>';
	ini_set('session.hash_function','tiger192,4');
	session_regenerate_id();
	echo 'tiger: ' . session_id();
	echo '<br/>';
		ini_set('session.hash_function','ripemd320');
	session_regenerate_id();
	echo 'ripe: ' . session_id();
	echo '<br/>';
			ini_set('session.hash_function','sha512');
	session_regenerate_id();
	echo 'sha512: ' . session_id();
	echo '<br/>';
	echo '<pre>';
	print_r(hash_algos());
	echo '</pre>';

if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}
$previous_name = session_name("WebsiteID");

echo session_name("WebsiteID");
ini_set('session.hash_function','whirlpool');
echo ini_get('session.hash_function');
print_r($_REQUEST);
?>
<?PHP

$value = 'something from somewhere';
setcookie("TestCookie", $value, time()+3600, "/~rasmus/", "example.com", 1);
echo $_COOKIE["TestCookie"];

?>



<?php
// We wouldn't know where $username came from but do know $_SESSION is
// for session data
if (isset($_SESSION['username'])) {

    echo "Hello <b>{$_SESSION['username']}</b>";

} else {

    echo "Hello <b>Guest</b><br />";
    echo "Would you like to login?";

}
?>


<?php
if (isset($_COOKIE['MAGIC_COOKIE'])) {

    // MAGIC_COOKIE comes from a cookie.
    // Be sure to validate the cookie data!

} elseif (isset($_GET['MAGIC_COOKIE']) || isset($_POST['MAGIC_COOKIE'])) {

   mail("admin@example.com", "Possible breakin attempt", $_SERVER['REMOTE_ADDR']);
   echo "Security violation, admin has been alerted.";
   exit;

} else {

   // MAGIC_COOKIE isn't set through this REQUEST

}
?>

<?php
echo realpath("current.txt");
?>