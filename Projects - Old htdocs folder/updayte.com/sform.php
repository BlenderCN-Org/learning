<div id="tab">Submit Date</div>
<div id="box">
<center>
<form method="post" action="<?php $_PHP_SELF ?>">
<table cellspacing="1" cellpadding="2" border="1">
<tr>
<td>Database:</td>
<td class="center"><select name="whichDB123">
<option value=""></option>
<option value="Books">Books</option>
<option value="Games">Games</option>
<option value="Mobile">Mobile</option>
<option value="Movies">Movies</option>
<option value="Music">Music</option>
<option value="Technology">Technology</option>
</select></td></tr>
<tr>
<td width="100">Name/Title</td>
<td><input name="name" type="text" id="name"></td></tr>
<tr><td>Author/Organization</td><td><input name="author" type="text" id="author"></td></tr>
<tr><td width="100">Release Date</td><td><input name="date" type="text" id="date"></td></tr>
<tr><td>Location</td><td><input name="location" type="text" id="location"></td></tr>
<tr><td>Source</td><td><input name="source" type="text" id="source"></td></tr>
<tr><td></td><td class="center"><input name="add" type="submit" id="add" value="Submit Update!"></td></tr>
</table>
</form>
</center>
</div>