<html>
<head>
<title>Untitled</title>
</head>
<form action="savecontents.php" method="post">
<textarea name="file_contents" style="width:700px;height:600px;">
<?php
$fileName = "data.txt";
$handle = fopen("data.txt", "r");
while (!feof($handle)){
    $fieldtext = fgets($handle);
    echo $fieldtext;
}
?>
</textarea>
<input type="submit" value="data.txt" name="filename" />
</form>
<body>
</body>
</html>