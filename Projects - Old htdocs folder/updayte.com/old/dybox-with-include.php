<?php	
		include 'conn.php';
		// $table[0] - table name
		$A = strtoupper($table[0]);
		$TBL = ucfirst($table[0]);
		$data = mysql_query("SELECT * FROM $table[0] ORDER BY date DESC");
		if($table[0] != "queue" AND $table[0] != "users")
		{
		echo '<a name="' . $A . '"></a><div id="tab">' . $TBL . ' <span class="add"><strong><a href="submit.php">+</a></strong></span></div>';
		echo '<div id="box"><table width=100% class="tbl">';
		if (file_exists($table[0] . 'v.php'.$filename)) // Checks for separate included page, and includes code contained within.  **May work for multiple tables/page**
		{
			include $table[0] . 'v.php';
		}
		else if (!file_exists($table[0] . '.php'.$filename)) // Checks to see if parent-page *doesn't* exist, and sets variables.
		{
			$c1 = "Name";
			$c2 = "Author(s)";
			$c3 = "Location";
			$c4 = "Date";
		}
		echo '<tr class="ttop"><td class="ncell">' . $c1 . '</td><td class="acell">' . $c2 . '</td><td>' . $c3 . '</td><td class="test"><div class="center">' . $c4 . '</div></td></tr>';
		echo '<tr><td colspan=6><hr color="blue"></td></tr>';
		while($info = mysql_fetch_array( $data )) 
			{
			echo '<tr><td class="namecell"><a href="' . $info["source"] . '">' . $info["title"] . '</a></td>';
			echo '<td>';
			if (!empty($info["author"]))
			{
				echo $info["author"];
				if (!empty($info["author2"]))
					{	
						echo ', ' . $info["author2"];
						if (!empty($info["author3"]))
							{
								echo ', ' . $info["author3"];
							}
					}
			}
			echo '</td><td>';
			if (isset($info["platform"]))
			{
				echo $info["platform"];
			}
			echo '</td><td class="center">';
			if ($info["date"] != '1111-11-11')
			{
				echo $info["date"];
			}
			else
			{
				echo '<div class="red">TBA</div>';
			}
			echo "</td></tr>";
			}
		echo '</table></div>';
		mysql_close();
		}
?>