<?php

// $opts = array('http'=>array('method'=>"GET",'header'=>"Accept-language: en\r\n" . "Cookie: foo=bar\r\n"));

$opts = array('http' =>
  array(
    'method'  => 'POST',
    'header'  => "Content-Type: text/xml\r\n".
      "Authorization: Basic ".base64_encode("$https_user:$https_password")."\r\n",
    'content' => $body,
    'timeout' => 60
  )
);

$context = stream_context_create($opts);


$file = file_get_contents('http://www.amazon.com/', false, $context);
// var_dump($file);
echo $file;
?>