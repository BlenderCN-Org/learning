<div id="tab">Current Queue</div>
<div id="box">
<table width=100% class="tdata">
<tr class="ttop"><td class="namecell">Name</td><td class="acell">Author</td><td>Location</td><td class="test">Source</td></td><td>Category</td><td>Release Date</td></tr>
<tr><td colspan=6><hr/></tr>
<?php
	include 'conn.php';
	$data = mysql_query("SELECT * FROM queue ORDER BY date DESC");
	while($info = mysql_fetch_array( $data )) 
	{
		echo "<tr>";
		echo '<td class="ncell">' . $info["title"] . '</td>';
		echo '<td>' . $info["author"] . '</td>';
		echo '<td>' . $info["location"] . '</td>';
		echo '<td>' . $info["source"] . '</td>';
		echo '<td>' . $info["cat"] . '</td>';
		echo '<td>' . $info["date"] . '</td>';
		echo "</tr>";
	}
	mysql_close();
?>
</table>
</div>