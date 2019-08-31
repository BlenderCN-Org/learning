<?php
			mysql_connect("mysql11.000webhost.com", "a9736173_updayte", "Kermit555");
			mysql_select_db("a9736173_updayte");
			$namequery1 = mysql_query("SHOW TABLES");
			echo '<br/>';
				while($table = mysql_fetch_array($namequery1)) 
				{
					if($table[0] != "queue")
					{
						$anchor = strtoupper($table[0]);
						echo '<a href="#' . $anchor . '">' . $table[0] . '</a><br/>';
					}
				}
				mysql_close();
	?>
<br>
<a href="submit.php">Submit a Date!</a>