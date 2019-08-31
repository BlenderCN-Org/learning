<?php	
		include 'conn.php';
		$A = strtoupper($table[0]);
		$TBL = ucfirst($table[0]);
		$clrs = array(1 => "green", 2 => "yellow", 3 => "blue", 4 => "red", 5 => "orange");
		$clr = $clrs[rand(1,3)];
		$data = mysql_query("SELECT * FROM $table[0] ORDER BY date DESC");
		if($table[0] != "queue" AND $table[0] != "users")
		{
		echo '<a name="' . $A . '"></a><div id="tab">' . $TBL . ' <span class="add"><strong><a href="submit.php">+</a></strong></span></div>';
		echo '<div id="box"><table width=100% class="tbl">';
		if (empty($c1))
		{
			$c1 = "Name";
			$c2 = "Author(s)";
			$c3 = "Location";
			$c4 = "Date";
		}
		echo '<tr><th class="ncell">' . $c1 . '</th><th class="acell">' . $c2 . '</th><th class="pcell">' . $c3 . '</th><th class="test"><div class="center">' . $c4 . '</div></th></tr>';
		echo '<tr><td colspan=6><hr color="' . $clr . '"></td></tr>';
		while($info = mysql_fetch_array( $data )){
			echo '<tr><td><a href="' . $info["source"] . '">' . $info["title"] . '</a></td>';
			echo '<td>';
			if (!empty($info["author"])){
				echo $info["author"];
				if (!empty($info["author2"])){	
						echo ', ' . $info["author2"];
						if (!empty($info["author3"])){
								echo ', ' . $info["author3"];
							}
					}
			}
			echo '</td><td class="center">';
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
				echo '<div class="red">Unavailable</div>';
			}
			echo "</td></tr>";
			if ($num >= 200){
				echo '<tr><td colspan=6><hr color="' . $clr . '"></td></tr>';
				echo '<tr class="ttop"><td class="ncell">' . $c1 . '</td><td class="acell">' . $c2 . '</td><td class="pcell">' . $c3 . '</td><td class="test"><div class="center">' . $c4 . '</div></td></tr>';
				echo '<tr><td colspan=6><hr color="' . $clr . '"></td></tr>';
				$num = 0;
			}
			$num++;
			}
		echo '</table></div>';
		mysql_close();
		}
?>