 <?php
// session_start();
echo '<br/>';
echo 'POST DATA:' ;
print_r($_POST);
error_reporting(E_ALL ^ E_NOTICE);
$fp = fopen("data.txt", 'w');
$text  = $_POST["file_contents"];
echo '<br/>';
echo 'gettype fp: ' . gettype($fp);
echo '<br/>';
echo 'gettype$text: ' . gettype($text);
echo '<br/>';
echo '$fp: <br/>';
echo $fp;
echo '<br/>';
print_r($fp);
echo '<br/>';
echo '$text: ';
print_r($text);
echo $text;
if(!fwrite($fp,$text))
{
    $_SESSION['error'] = '<font color="red">There was an error</font>';
}else{
    $_SESSION['error'] = '<font color="red">File edited successfully</font>';
}
fclose($fp);
/* header("Location: fileform.php"); */
?> 