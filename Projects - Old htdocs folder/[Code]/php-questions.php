 <?php
		echo '<h3><font color="blue">Multiple Return Function</font></h3>';
		function add_subt($val1, $val2) {
        $add = $val1 + $val2;
        $subt = $val1 - $val2;
        return array($add, $subt);
      }

      $result_array = add_subt(10,5);
      // echo "Add: " . $result_array[0] . "<br />";
      // echo "Subt: " . $result_array[1] . "<br />";

      list($add_result, $subt_result) = add_subt(20,7);
      echo "Add: " . $add_result . "<br />";
      echo "Subt: " . $subt_result . "<br />";
	echo '<br/>';
	echo '<br/>';
    ?>
	

	// Why do these output different things?	
	<?php 
// $WshShell = new COM("WScript.Shell"); 
// $oExec = $WshShell->Run("mspaint.exe", 3, true); 
?>

start a shell command invisible in the background: 
<?php 
$WshShell = new COM("WScript.Shell"); 
$oExec = $WshShell->Run("cmd /C dir /S %windir%", 0, false); 
?>