<?php
$root = $_SERVER['DOCUMENT_ROOT'];

$file = str_replace('\\', '/', $_GET['file']);
$file = str_replace($root, '', $file);
$header = 'http://localhost/' . $file;
header("Location: $header");

?>