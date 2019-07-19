<!DOCTYPE html>
<html lang="en">
<head>
	<title>Russell's ELO Experiment</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- link rel="stylesheet" type="text/css" href="styles.css" -->
</head>
<body>
<br/><h2>ELO Matching Example/Experiment</h2><br/>

<?php
require_once(functions.php);

$DIR = 'SampleData';
$NUM_Files_in_DIR = count_files_in_DIR($DIR);

$Player1 = '1';
$Player1_filename = '/' . $DIR '/' . $Player1 . '.txt';
echo $Player1_filename;

//$Player1_currentScore = read($one);

//Other Functions
function ELO($A, $B){
		return (1/(1+pow(10,(($B-$A)/400))));
};
?>
<br/>
</body></html>