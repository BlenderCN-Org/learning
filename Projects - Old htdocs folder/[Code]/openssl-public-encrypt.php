<?php 
function EncryptData($source) 
{ 
  $fp=fopen("/etc/httpd/conf/ssl.crt/server.crt","r"); 
  $pub_key_string=fread($fp,8192); 
  fclose($fp); 
  openssl_get_publickey($pub_key); 

  openssl_public_encrypt($source,$crypttext,$pub_key_string); 
  /*this simply passes the string contents of pub_key_string back to be decoded*/ 
  return(base64_encode($crypttext)); 
} 
?> 



<?php 
//is more efficient: 
function EncryptData($source) 
{ 
  $fp=fopen("/etc/httpd/conf/ssl.crt/server.crt","r"); 
  $pub_key_string=fread($fp,8192); 
  fclose($fp); 
  $key_resource = openssl_get_publickey($pub_key); 

  openssl_public_encrypt($source,$crypttext, $key_resource ); 
  /*uses the already existing key resource*/ 
  return(base64_encode($crypttext)); 
} 
?> 



<?php 
//shorter: 
function EncryptData($source) 
{ 
  $fp=fopen("/etc/httpd/conf/ssl.crt/server.crt","r"); 
  $pub_key=fread($fp,8192); 
  fclose($fp); 

  openssl_public_encrypt($source,$crypttext, $pub_key ); 

  return(base64_encode($crypttext)); 
} 
?>