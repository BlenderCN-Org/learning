<?php
$dir = '/';
system('dir ');
?>

<?php
echo '<pre>';

// Outputs all the result of shellcommand "ls", and returns
// the last output line into $last_line. Stores the return value
// of the shell command in $retval.
$last_line = system('dir', $retval);

// Printing additional info
echo $last_line . '<br/>';
echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;
?>

<?php
echo '<br/>';
// outputs the username that owns the running php/httpd process
// (on a system with the "whoami" executable in the path)
// you need to use an output buffer if you don't want the data displayed.
echo 'exec(): ' . exec('dir');
echo '<br/>';
echo 'passthru(): <br/>';
passthru("ver",$err);

$computername = "Treehouse";
    $ip = gethostbyname($computername);
    exec("ping ".$ip." -n 1 -w 90 && exit", $output);
    print_r($output);


// exec ( "powershell.exe someScript.ps1" ); // hangs 

exec ( "echo . | powershell.exe someScript.ps1 " ); // works
echo '<br/>';
system('dir '.escapeshellarg($dir));
	
?>

start MSPaint maximized and wait for you to close it before continuing the script: 
<?php 
// $WshShell = new COM("WScript.Shell"); 
// $oExec = $WshShell->Run("mspaint.exe", 3, true); 
?>

start a shell command invisible in the background: 
<?php 
$WshShell = new COM("WScript.Shell"); 
$oExec = $WshShell->Run("cmd /C dir /S %windir%", 0, false); 
?>

<?php 
$WshShell = new COM("WScript.Shell"); 
$oExec = $WshShell->Run("notepad.exe", 7, false); 
?>

