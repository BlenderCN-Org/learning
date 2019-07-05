chsnyder writes that the data is limited to 936 bits in his implementation.

Actually, it has nothing to do with RSA being CPU intensive, RAM or anything of the sort.

Basically when you encrypt something using an RSA key (whether public or private), the encrypted value must be smaller than the key (due to the maths used to do the actual encryption). So if you have a 1024-bit key, in theory you could encrypt any 1023-bit value (or a 1024-bit value smaller than the key) with that key.

However, the PKCS#1 standard, which OpenSSL uses, specifies a padding scheme (so you can encrypt smaller quantities without losing security), and that padding scheme takes a minimum of 11 bytes (it will be longer if the value you're encrypting is smaller). So the highest number of bits you can encrypt with a 1024-bit key is 936 bits because of this (unless you disable the padding by adding the OPENSSL_NO_PADDING flag, in which case you can go up to 1023-1024 bits). With a 2048-bit key it's 1960 bits instead.

But as chsnyder correctly wrote, the normal application of a public key encryption algorithm is to store a key or a hash of the data you want to respectively encrypt or sign. A hash is typically 128-256 bits (the PHP sha1() function returns a 160 bit hash). And an AES key is 128 to 256 bits. So either of those will comfortably fit inside a single RSA encryption.

 
 echo '<li' . ($item == $menu_current ? ' class="active"' : '') . '>';

zend_extension=opcache.so
opache.enable = 1
opcache.enable_cli = 1

PHP compiled on-the-fly and outputted to browser.

APC - Alternative PHP Cache

Zend Optomizer - Open source, renamed to OpCache

pack()
unpack()

boolval($var); //Returns boolean

echo 'Hello'[1];
$variable = array['a','b','c','d'][rand(0, 2)];
Dereferencing - Get the value of something that's stored elsewhere.  Great way to obsfucate code.

Finally - Executes after try statement but before program resolution after an error.

try{
}
catch{
}
finally{
}

PHP and Javascript can only communicate via strings.
The answer is serialization. In case of PHP/Javascript, JSON is actually the better serialization format:



I think rotating the session ID (SID) when logging in is necessary even if it is stored in a cookie. Consider this: The attacker browses the website on a shared computer and gets assigned a SID (but doesn't login). Then the attacker walks away. If the next user then logs in and the SID isn't rotated, then the attacker knows the SID and can use it to masquerade as the user which logged in. This scenario is a little far-fetched (hopefully the shared computer still has separate accounts), but possible. –  David Underhill May 17 '10 at 3:42 

The solution is uncommenting lines in the php.ini file which can be found in /MAMP Directory/bin/php/php5.5.3/conf/php.ini

Comment out Opcache:

[OPcache]
;zend_extension="/Applications/MAMP/bin/php/php5.5.3/lib/php/extensions/no-debug-non-zts-20121212/opcache.so"
;  opcache.memory_consumption=128
;  opcache.interned_strings_buffer=8
;  opcache.max_accelerated_files=4000
;  opcache.revalidate_freq=60
;  opcache.fast_shutdown=1
;  opcache.enable_cli=1

Remember that MyISAM tables do not support rollbacks.

I would take the browser out of the equation and use Terminal to do either a manual HTTP request with telnet or run php -r 'echo file_get_contents('http://<yourlocalserver>/<yourscriptpath>');' – 

If the string starts with valid numeric data, this will be the value used. 

1) As a finesse thing, I use single quotes around strings whenever possible (e.g. strings that don't contain variables, single quotes, \n, etc.). This is supposed to make less work for the PHP parser.

2) When an array variable isn't in a string, put quotes around string-literal keys so they are not regarded as constants:

PHP Code:
// OK 
echo $row[$key]; 

// Wrong, unless key is a constant 
echo $row[key]; 

// Right 
echo $row['key']; 

// OK, since it's in a string 
echo "Text: $row[key]";  
3) Remember, you can break out of PHP mode for large sections of HTML. This is faster than echo'ing and you don't need to escape quotes.


curl ifconfig.me
 Learning Three.js: The JavaScript 3D Library for WebGL).
http://instance-data/latest/meta-data/local-ipv4
http://instance-data/latest/meta-data/public-ipv4

<?php
$con=mysqli_connect("localhost","my_user","my_password","my_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="SELECT Lastname,Age FROM Persons ORDER BY Lastname";
$result=mysqli_query($con,$sql)

// Numeric array
$row=mysqli_fetch_array($result,MYSQLI_NUM);
printf ("%s (%s)\n",$row[0],$row[1]);

// Associative array
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
printf ("%s (%s)\n",$row["Lastname"],$row["Age"]);

// Free result set
mysqli_free_result($result);

mysqli_close($con);
?>

Definition and Usage
The mysqli_free_result() function frees the memory associated with the result.

Syntax
mysqli_free_result(result);

// destroy more than one variable
unset($foo1, $foo2, $foo3);

To unset() a global variable inside of a function, then use the $GLOBALS array to do so:
To open a DB using PHP5 and SQLite we need to use a PDO and not the sqlite_open() function.
<?php
function foo() 
{
    unset($GLOBALS['bar']);
}

$bar = "something";
foo();
?>


The include and require statements are identical, except upon failure:

require will produce a fatal error (E_COMPILE_ERROR) and stop the script
include will only produce a warning (E_WARNING) and the script will continue

If you include a file that does not exist with include_once, the return result will be false. 

If you try to include that same file again with include_once the return value will be true.

Example:
<?php
var_dump(include_once 'fakefile.ext'); // bool(false)
var_dump(include_once 'fakefile.ext'); // bool(true)
?>

This is because according to php the file was already included once (even though it does not exist).

If $_SESSION (or $HTTP_SESSION_VARS for PHP 4.0.6 or less) is used, use isset() to check a variable is registered in $_SESSION.


Caution
Do NOT unset the whole $_SESSION with unset($_SESSION) as this will disable the registering of session variables through the $_SESSION superglobal.
$currentCookieParams = session_get_cookie_params(); 

session_start();

$_SESSION['login_ok'] = true;
$_SESSION['nome'] = 'sica';
$_SESSION['inteiro'] = 34;

echo session_encode();

session.hash-bits-per-character=5

And sample regex to check session id:

preg_match('/^[a-zA-Z0-9,-]{22,40}$/', $sessionId)

tep_session_start() checks for session ID "sanity". The problem is that setting hash_bits_per_character=6 may produce session ID characters different from a-zA-Z0-9. This will lead to intermittent session failures which are extremely hard to track down.

session.cookie_httponly boolean
Marks the cookie as accessible only through the HTTP protocol. This means that the cookie won't be accessible by scripting languages, such as JavaScript. This setting can effectively help to reduce identity theft through XSS attacks (although it is not supported by all browsers).

If you don’t delete the old session then it is still vulnerable to hijacking and whatever access it had can be granted to an attacker. If you’re changing the session ID often without deleting the old ones you could be creating more holes by leaving a trail of old, but valid, sessions.

// Use of session_register() is deprecated

Cookies names can be set as array names and will be available to your PHP scripts as arrays but separate cookies are stored on the user's system. Consider explode() to set one cookie with multiple names and values. It is not recommended to use serialize() for this purpose, because it can result in security holes.

session.hash_function
4.1.0	Introduced $_COOKIE that deprecated $HTTP_COOKIE_VARS.

(PHP 4 >= 4.1.0, PHP 5)
$_ENV -- $HTTP_ENV_VARS [deprecated] — Environment variables

Sets the order of the EGPCS (Environment, Get, Post, Cookie, and Server) variable parsing

register_globals boolean
Whether or not to register the EGPCS (Environment, GET, POST, Cookie, Server) variables as global variables.

Note:
The content and order of $_REQUEST is also affected by this directive.

//URLencode different URLs into the dropdown box.
// Use a database counter to keep track of position in DB
<input type="date"> // New

Using Register Globals ¶

Warning
This feature has been DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0.

<?php
// define $authorized = true only if user is authenticated
if (authenticated_user()) {
    $authorized = true;
}

// Because we didn't first initialize $authorized as false, this might be
// defined through register_globals, like from GET auth.php?authorized=1
// So, anyone can be seen as authenticated!
if ($authorized) {
    include "/highly/sensitive/data.php";
}
?>
<?php
unset($_SESSION['cow'], $_SESSION['favorite']);

$people = array("Peter", "Joe", "Glenn", "Cleveland");

reset($people);

while (list($key, $val) = each($people))
  {
  echo "$key => $val<br>";
  }
?>

<?php
$people = array("Peter", "Joe", "Glenn", "Cleveland");

echo current($people) . "<br>"; // The current element is Peter
echo next($people) . "<br>"; // The next element of Peter is Joe
echo current($people) . "<br>"; // Now the current element is Joe
echo prev($people) . "<br>"; // The previous element of Joe is Peter
echo end($people) . "<br>"; // The last element is Cleveland
echo prev($people) . "<br>"; // The previous element of Cleveland is Glenn
echo current($people) . "<br>"; // Now the current element is Glenn
echo reset($people) . "<br>"; // Moves the internal pointer to the first element of the array, which is Peter
echo next($people) . "<br>"; // The next element of Peter is Joe

print_r (each($people)); // Returns the key and value of the current element (now Joe), and moves the internal pointer forward
?>


<?php
header("Content-Type: text/plain");

 isset( $value ) AND print( $value );
 
foreach ($_GET['select2'] as $selectedOption)
  echo $selectedOption."\n";
  
 
  	if(preg_match('/^[A-Fa-f0-9]{32}$/', $table) > 0) {
    // All good
	}
	
	// $id =$_REQUEST['BookID'];
	
	
			// $result = mysql_query("SELECT * FROM $table WHERE id = $row");
		// while($fetch = mysql_fetch_array($result)) 
		// {
			// $date = $fetch['date'];
			// $DBid = $fetch['id'];
			// $title = $fetch['title'];
			// $source = $fetch['source'];
			// $author = $fetch['author'];
			// $pform = $fetch['platform'];
			// if(isset($fetch['author2'])){
			// $author2 = $fetch['author2'];
			// }
			// if(isset($fetch['author3'])){
			// $author3 = $fetch['author3'];
			// }
			// if(isset($fetch['author4'])){
			// $author4 = $fetch['author4'];
			// }
			
		// }
		
		
		if ($platform2[$x] != '&nbsp;'){
		
		http://www.amazon.com/s/ref=sr_pg_2?rh=n:2625373011,n:!2625374011,n:2649513011,p_69:1y-700y,p_n_format_browse-bin:2650305011|6259461011|2650304011&page=2
		
		 dN6UFR8GC6K6LYax - up