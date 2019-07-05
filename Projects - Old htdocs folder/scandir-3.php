<?php
$cwd = getcwd();
$dir  = $cwd;
$files1 = scandir($dir);
$files2 = scandir($dir, 1);
//chdir('');
//echo $cwd;
echo $dir;
echo '<pre>';
//print_r($files1);
//print_r($files2);
echo '</pre>';


// $dir = "/tmp";
// $dh  = opendir($dir);
// while (false !== ($filename = readdir($dh))) {
    // $files[] = $filename;
// }

// sort($files);
// echo '<pre>';
// print_r($files);
// echo '</pre>';
foreach ($files1 as $file){
if (substr($file, -4) == ".jpg" || substr($file, -4) == ".png"){
//echo '<a href="' . $file . '">' . $file . '</a><br/>';
echo '<img src="' . $file . '" width="10%" height="15%"/>';


//echo $file;
}

//if (substr($file, -4) == ".png"){
//echo '<br/>';
//echo $file;
//}


}


?>