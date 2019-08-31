<?PHP

$key = 'password to (en/de)crypt';
$string = 'string to be encrypted';

$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($key))), "\0");

var_dump($encrypted);
echo "<br/>";
var_dump($decrypted);


?>