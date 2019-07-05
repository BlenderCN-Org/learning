<!-- http://en.wikipedia.org/wiki/Tiger_%28cryptography%29 -->
<!-- Oh, and in your en_crypt() function, put the salt behind the password. This makes brute forcing harder, or better said, it slows it down. Which is a good thing. -->
<!-- Notes 

https://en.wiktionary.org/wiki/XOR#English

Salt is a generic term referring to the addition of some random data to an algorithm, to randomize its output (a process also referred to as "salting"). You can salt encryption or hashing, for example.

IV stands for initialization vector and is a specific way in which block encryption algorithms are salted - the IV is a random first block that is used to initialize the feedback register of the encryption algorithm.

The most important point: Encryption DOES NOT provide any proof of data integrity or authentication WHATSOEVER. If 
you need to be sure that the data is secret and not tampered with, you need to encrypt THEN use a keyed HMAC.

In most cases it is best to omit the salt parameter. Without this parameter, the function will generate a cryptographically safe salt, from the random source of the operating system.

You are using out of date functions, you might want to use bcrypt and SHA-256 for the IV (only use the 16 - blocksize - left most bytes)

   # the key should be random binary, use scrypt, bcrypt or PBKDF2 to
    # convert a string into a key
	#key specified in hex

Salts are used in cryptographic hashing in order to eliminate the rainbow table method of cracking. (A rainbow table being a reverse lookup table of hashes to passwords)
IVs are used in encryption of larger files to avoid similar sections from encrypting to the same thing.
They are extremely similar, but here are the differences.
Salts are typically added before or after what they are encrypting (to my knowledge). This means that the encryption is also performed on the salt.
IVs are always XORed with the result of the encryption. The reason it is done afterwords is because only the first chunk uses the IV, the rest use the previous chunk for this XORing.
The distinction is important because a salt that is XORed with the encrypted form of a password is easily broken, and IVs are designed to stop pattern recognition style attacks versus the dictionary attacks of password files.

The salt is used so that the same password does not always generate the same key - this means, among other things, that an attacker cannot offline build a dictionary of passwords-to-keys. An IV similarly ensures that the same plaintext does not produce the same ciphertext - this means that an attacker can't build up a set of cribs

Use hash for hashing, for example in integrity checks. It directly uses the specified hashing algorithm.
crypt is a special purpose function. It's used for password hashing and key derivation. You'll need to pass in a salt, which indirectly determines the hashing scheme used. Even if you choose CRYPT_SHA512 this isn't plain SHA512. It's a key derivation function that uses SHA512 as building block. In particular such a scheme is deliberately slow(hider brute-force attacks) and combines salt and password in a secure way.
For password hashing in a log system, crypt is clearly the right choice.

Hashing, as used by hash, is meant to verify data (like files), normally as a checksum sort of thing. It is fast, which is why we don't use it for secure data.
Crypt (when used correctly) uses a slow hashing algorithm (ideally, Blowfish). The reason a slow hashing algorithm is important is because it makes it difficult for someone to brute-force the hash. If the slow hashing algorithm takes even 0.1 milliseconds longer than the fast hashing algorithm, then trying 10000 passwords will take a second, and of course, brute-forcing would require millions of tries.

-->
<?php
// in Review

// By default, crypt uses /dev/urandom to create the salt, which is based on noise from device drivers.

And on Windows, it uses CryptGenRandom(). 


To Store a Password

    1. Generate a long random salt using a CSPRNG.
    2. Prepend the salt to the password and hash it with a standard cryptographic hash function such as SHA256.
    3. Save both the salt and the hash in the user's database record.

To Validate a Password

    1. Retrieve the user's salt and hash from the database.
    2. Prepend the salt to the given password and hash it using the same hash function.
    3. Compare the hash of the given password with the hash from the database. If they match, the password is correct. Otherwise, the password is incorrect.


password_verify($pass, $hash);

password_hash($pass, PASSWORD_DEFAULT);


$options['cost'] = 10;
password_needs_rehash($hash, PASSWORD_DEFAULT, $options); // Checks to see if it needs to be rehashed

password_get_info($hash); // Reads Hashing Info
?>

<?php // MISC

ini_set('session.hash_function', 'whirlpool');

hash("tiger192,$rounds", $data, true)

mhash_get_hash_name()
?>

<?php
     // Author: holdoffhunger@gmail.com
    $sha1_first_value = sha1("secret", FALSE);
	// Is the same as:
    $sha1_second_value = hash("sha1", "secret", FALSE);
?>

<?php
// Set the password
$password = 'mypassword';
// Get the hash, letting the salt be automatically generated
$hash = crypt($password);
?>

<?php
$mhash_whirlpool_results = bin2hex(mhash(MHASH_WHIRLPOOL, "secret"));
$hash_mdf_whirlpool_results = hash("whirlpool", "secret", FALSE);

print("MHash Whirlpool: $mhash_whirlpool_results .<br>");
print("HASH-MDF Whirlpool: $hash_mdf_whirlpool_results .<br><br>");
?>

<?php
/**
 * We just want to hash our password using the current DEFAULT algorithm.
 * This is presently BCRYPT, and will produce a 60 character result.
 * Beware that DEFAULT may change over time, so you would want to prepare
 * By allowing your storage to expand past 60 characters (255 would be good)
 */
echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT)."\n";
?>

<?php
// Encrypt with the MD4 hash
$MD4Hash=hash('md4',$Input);
?> 

<?php //HMAC FIle
/* Create a file to calculate hash of */
file_put_contents('example.txt', 'The quick brown fox jumped over the lazy dog.');

echo hash_hmac_file('md5', 'example.txt', 'secret');
//The above example will output:

//7eb2b5c37443418fc77c136dd20e859c
?>


/* Caution
The PBKDF2 method can be used for hashing passwords for storage. However, it should be noted that password_hash() or crypt() with 
CRYPT_BLOWFISH are better suited for password storage.  */
/* <?php
$password = "password";
$iterations = 1000;

// Generate a random IV using mcrypt_create_iv(),
// openssl_random_pseudo_bytes() or another suitable source of randomness
$salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);

$hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 20);
echo $hash;
?> */


<?php
/**
 * In this case, we want to increase the default cost for BCRYPT to 12.
 * Note that we also switched to BCRYPT, which will always be 60 characters.
 */
$options = [
    'cost' => 12,
];
echo password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $options)."\n";
?>


<?php
/**
 * Note that the salt here is randomly generated.
 * Never use a static salt or one that is not randomly generated.
 *
 * For the VAST majority of use-cases, let password_hash generate the salt randomly for you
 */
$options = [
    'cost' => 11,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
echo password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $options)."\n";
?>

<?php
$hashed_password = crypt('mypassword'); // let the salt be automatically generated

/* You should pass the entire results of crypt() as the salt for comparing a
   password, to avoid problems when different hashing algorithms are used. (As
   it says above, standard DES-based password hashing uses a 2-character salt,
   but MD5-based hashing uses 12.) */
if (crypt($user_input, $hashed_password) == $hashed_password) {
   echo "Password verified!";
}
?>
<?php
$hashed_password = crypt('mypassword'); // let the salt be automatically generated

/* You should pass the entire results of crypt() as the salt for comparing a
   password, to avoid problems when different hashing algorithms are used. (As
   it says above, standard DES-based password hashing uses a 2-character salt,
   but MD5-based hashing uses 12.) */
if (crypt($user_input, $hashed_password) == $hashed_password) {
   echo "Password verified!";
}
?>

<!-- Begin Other User's Code/Examples -->

 <?php
 // Random PW Gen
$uniq = uniqid();
$pass = substr(md5($uniq), 0, 10);

echo $pass;
?> 

<?php For bcrypt this will actually generate a 128 bit salt:
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.'); ?>

<?php
function CRYPThash($string, $salt = null) // if $salt not set, it's set to NULL
{
    if (!$salt)
        $salt = rand(10,99);
   
    return "{CRYPT}".crypt($string, $salt);
}
?>

<?php
$password = $_POST['password'];
 
function generate_salt() {
		$salt = uniqid(sha1("L0r3mIpsUmD0l0rS1tAm3tc0ns3CT3tur4d1p1sc1ng3lit".microtime()));
		$salt = substr(sha1($salt), 0, 22);
		return $salt;
}
$hashed_password = crypt($password, '$2a$12$' . generate_salt());
?>

<?php function createPassword($password){
    $rand  = md5(time() . uniqid() . rand(1, 1000));
    $crypt = crypt($password, $rand);
    return $crypt;
}

function verifyPassword($password, $salt){
    if(crypt($password, $salt) === $salt){
        return true;
    }
    return false;
}

$username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");

count_chars($string, 1);
?>




<!-- Beyond Me -->


To decrypt data coming from MySQL's AES_ENCRYPT function:

<?php

function mysql_aes_key($key)
{
    $new_key = str_repeat(chr(0), 16);
    for($i=0,$len=strlen($key);$i<$len;$i++)
    {
        $new_key[$i%16] = $new_key[$i%16] ^ $key[$i];
    }
    return $new_key;
}

function aes_decrypt($encrypted,$key)
{
    // if $encrypted is HEXed, then return it to binary
    $encrypted = pack('H*',$encrypted);

    $key = mysql_aes_key($key);
    return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128,$key,$encrypted,MCRYPT_MODE_ECB,''),"\x00..\x1F");
}

?>

<?php
function makePass($word=''){
  $dbSalt = '$2a$07$'.substr(hash('whirlpool',$word),0,22);
  //add openssl_random_pseudo_bytes
  $dbPass = crypt($word, $dbSalt);
 return substr($dbPass,12);
}
?>

<?php

$salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
$salt = base64_encode($salt);
$salt = str_replace('+', '.', $salt);
$hash = crypt('rasmuslerdorf', '$2y$10$'.$salt.'$');
echo $hash

?>

<?php

function createPassword($password){
    $rand  = md5(time() . uniqid() . rand(1, 1000));
    $crypt = crypt($password, $rand);
    return $crypt;
}

function verifyPassword($password, $salt){
    if(crypt($password, $salt) === $salt){
        return true;
    }
    return false;
} 

?>






