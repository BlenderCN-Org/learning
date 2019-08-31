<?php
		include 'conn.php';
		$Q = mysql_query("SHOW TABLES");
		while($table = mysql_fetch_array($Q)) 
			{
				if($table[0] != "queue" AND $table[0] != "users")
				{
					$act = '';
					$A = strtoupper($table[0]);
					$TBL = ucfirst($table[0]);
					echo '<li class="' . $_SERVER['PHP_SELF'] . '"><a href="' . $A . '.php">' . $TBL . '</a></li>';
				}
			}
		mysql_close();
	?>