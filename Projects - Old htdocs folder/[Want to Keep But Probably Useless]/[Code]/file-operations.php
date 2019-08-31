<?php
// $fp = fopen('data.txt', 'w');
 // fwrite($fp, 'line1' . "\r" . 'line2');
// fclose($fp);
// echo 'File Get Contents: ';
// echo file_get_contents('data.txt');
// ?>


 <?php
// echo '<br/>';
// $loop = 100;
// $count = 1;
// while ($count < $loop)
// {
// $fp = fopen('data.txt', 'a');
 // fwrite($fp, 'line1' . "\r\n");
 // fwrite($fp, 'line2');
// $count++;
// }
// fclose($fp);
// echo 'File Get Contents: ';
// echo file_get_contents('data.txt');
// echo '<br/>';
?>


<?php
// echo '<br/><br/>';
// $file = 'data.txt';
// $current = file_get_contents($file);// Open file to get its content (if any)
// $current .= "\r\nHallo, nice website. Bye!\r\n";// using (.) we add a new comment
// file_put_contents($file, $current);// Write the content back to the file
// echo 'File Get Contents: ';
// echo file_get_contents($file);
?>

<?php
// $file = fopen("test.txt","r");
// fread($file,"10");
// fclose($file);
?>

<?php
// $file = fopen("links.txt","r");
// echo fread($file,filesize('links.txt'));
// fclose($file);
?>


<?php
// preg_match_all("|<[^>]+>(.*)</[^>]+>|U", "<b>example </b><b><div align=left>this is a test</div></b>", $out, PREG_PATTERN_ORDER);
	// echo '<br/>';
// echo  'One: ' . $out[0][0] . " Two:" . $out[0][1];
// echo '<br/>';
// echo '<br/>';
// echo $out[1][0] . " Two: " . $out[1][1];
?>



<?php
// The \\2 is an example of backreferencing. This tells pcre that
// it must match the second set of parentheses in the regular expression
// itself, which would be the ([\w]+) in this case. The extra backslash is
// required because the string is in double quotes.
$html = "<b>bold text</b> <a href=howdy.html>click me</a>";

preg_match_all("/(<([\w]+)[^>]*>)(.*?)(<\/\\2>)/", $html, $matches, PREG_SET_ORDER);
foreach ($matches as $val) {
    echo '$val[0]:' . $val[0] . "\n";
	echo '<br/>';
    echo '$val[1]:' . $val[1] . "\n";
	echo '<br/>';
    echo '$val[2]:' . $val[2] . "\n";
	echo '<br/>';
    echo '$val[3]' . $val[3] . "\n";
	echo '<br/>';
    echo '$val[4]' . $val[4] . "\n\n";
	echo '<br/><br/>';
}
?>




<?php

// $str = <<<FOO
// a: 1
// b: 2
// c: 3
// FOO;

// preg_match_all('/(?P<name>\w+): (?P<digit>\d+)/', $str, $matches);

// /* This also works in PHP 5.2.2 (PCRE 7.0) and later, however 
 // * the above form is recommended for backwards compatibility */
// preg_match_all('/(?<name>\w+): (?<digit>\d+)/', $str, $matches);
// echo '<pre>';
// print_r($matches);
// echo '</pre>';
// $matches2 = implode('-', $matches[2]);
// echo $matches2;
?>



<?php

$str = 'fooar: 2008';

preg_match('/(?P<name>\w+): (?P<digit>\d+)/', $str, $matches);

/* This also works in PHP 5.2.2 (PCRE 7.0) and later, however 
 * the above form is recommended for backwards compatibility */
// preg_match('/(?<name>\w+): (?<digit>\d+)/', $str, $matches);
echo '<pre>';
print_r($matches);
echo '</pre>';
?>


