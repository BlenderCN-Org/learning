<?php	
		include 'conn.php';
		$aname = strtoupper($table[0]);
		$tname = ucfirst($table[0]);
		$data = mysql_query("SELECT * FROM $table[0] ORDER BY date DESC");
		if($table[0] != "queue" AND $table[0] != "users")
		{
		echo '<a name="' . $aname . '"></a>';
		echo '<div id="tab">' . $tname . ' <span class="add"><strong><a href="submit.php">+</a></strong></span></div><div id="box">';
		echo '<table width=100% class="tbl">';
		echo '<tr class="ttop"><td class="namecell">Name</td><td class="acell">Author</td><td>Location</td><td class="test">Estimated Release:</td></tr>';
		echo '<tr><td colspan=6><hr/></td></tr>';
		while($info = mysql_fetch_array( $data )) 
			{
			echo "<tr>";
			echo '<td class="ncell"><a href="' . $info["source"] . '">' . $info["title"] . '</a></td>';
			echo '<td>' . $info["author"] . '</td>';
			echo '<td>';
			if (isset($info["location"]))
			{
				echo $info["location"];
			}
			echo '</td>';
			echo '<td>' . $info["date"] . '</td>';
			echo "</tr>";
			}
		echo '</table></div>';
		mysql_close();
		}
?>