<div id="tab">Links</div>
<div id="box">
<table width=100% class="tdata">
<tr class="ttop"><td class="namecell">ID</td><td class="acell">Name</td><td>URL</td></tr>
<tr><td colspan=6><hr/></tr>
<?php
	include 'conn.php';
	$data = mysql_query("SELECT * FROM links ORDER BY id ASC");
	while($info = mysql_fetch_array( $data )) 
	{
		echo "<tr>";
		echo '<td class="ncell">' . $info["id"] . '</td>';
		echo '<td>' . $info["url"] . '</td>';
		echo '<td>' . $info["name"] . '</td>';
		echo "</tr>";
	}
	mysql_close();
?>
</table>
</div>