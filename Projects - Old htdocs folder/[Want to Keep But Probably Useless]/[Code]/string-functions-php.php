
<?php
$subject = "def";
$pattern = '/^def/';
preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE, 3);
echo '<pre>';
print_r($matches);
echo '</pre>';
?>

<?php
$subject = "abcdef";
$pattern = '/^def/';
preg_match($pattern, substr($subject,3), $matches, PREG_OFFSET_CAPTURE);
echo '<pre>';
print_r($matches);
echo '</pre>';
echo '<br/>';
?>


<?php
/* The \b in the pattern indicates a word boundary, so only the distinct
 * word "web" is matched, and not a word partial like "webbing" or "cobweb" */
if (preg_match("/\bweb\b/i", "PHP is the scripting language of choice.")) {
    echo "A match was found.";
} else {
    echo "A match was not found.";
}

echo '<br/><br/>';

if (preg_match("/\bweb\b/i", "PHP is the website scripting language of choice.")) {
    echo "A match was found.";
} else {
    echo "A match was not found.";
}
?>


<?php
echo '<br/><br/>';
// The "i" after the pattern delimiter indicates a case-insensitive search
if (preg_match("/php/i", "PHP is the web scripting language of choice.")) {
    echo "A match was found.";
} else {
    echo "A match was not found.";
}
?>



<?php
echo '<br/><br/>';
// get host name from URL
preg_match('@^(?:http://)?([^/]+)@i',
    "http://www.php.net/index.html", $matches);
$host = $matches[1];

// get last two segments of host name
preg_match('/[^.]+\.[^.]+$/', $host, $matches);
echo "domain name is: {$matches[0]}\n";
?>



<?php
echo '<br/><br/>';
$str = 'foobar: 2008';

preg_match('/(?P<name>\w+): (?P<digit>\d+)/', $str, $matches);

/* This also works in PHP 5.2.2 (PCRE 7.0) and later, however 
 * the above form is recommended for backwards compatibility */
// preg_match('/(?<name>\w+): (?<digit>\d+)/', $str, $matches);

print_r($matches);

?>



<?php
echo '<br/><br/>';
// The "i" after the pattern delimiter indicates a case-insensitive search
if (preg_match("/[!@#$%^&*()]/i", "aaaertertrt")) {
    echo "A match was found.";
} else {
    echo "A match was not found.";
}
echo '<br/><br/>';
?>



<?php
$userinput = 'Russ';
echo '<a href="mycgi?foo=', urlencode($userinput), '">aaa</a>';
echo '<br/><br/>';
?>


<?php
// URLEncode with HTML Entitities
$foo = 'Russ';
$bar = 'Rounds';
$query_string = 'foo=' . urlencode($foo) . '&bar=' . urlencode($bar);
echo "<a href=mycgi?" . htmlentities($query_string) . '>Russ</a>';

?>



<?php
echo '<br/><br/>';
$str = "Is your name O'reilly?";

// Outputs: Is your name O\'reilly?
echo addslashes($str);
echo '<br/>';
?>



<?php
$new = htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);
print $new; // &lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;
?>

<?php
$str = "The quick brown fox jumps over the lazy dog."
$str2 = substr($str, 4); // "quick brown fox jumps over the lazy dog."
?>