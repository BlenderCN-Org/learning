 <?php
//puts the whole file in an array ($arr) line by line
$arr = file("data.txt");
print_r($arr);
echo '<br/>';
file_put_contents("data.txt","\nFirst", FILE_APPEND);
$f = fopen("data.txt","r") or die("Error !!!");
fputs($f,"\nSecond");
echo 'fread: ';
echo fread($f, filesize("data.txt"));
echo '<br/>';
//reads one line from the file in question
echo 'fgets(): ' . fgets($f);
echo '<br/>';
//reads  one line from the file in question but delets html tags (if you read from an html file)
echo 'fgetss(): ' . fgetss($f); 
// you can specify the lenth of the string to return, e.g. 255
echo '<br/>';
echo 'fgetss($f, 255): ' . fgetss($f, 255); 
// you can also specify which tags to ignore (not to delete)
echo '<br/>';
echo 'fgetss(): ' . fgetss($f, 255),"<br><a>"; 
echo 'fgetc(): ' . fgetc($f);
fclose($f);
?>
