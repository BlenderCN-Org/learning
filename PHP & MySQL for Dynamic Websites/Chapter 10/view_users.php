<?php 
	$page_title = 'View the Current Users';
	include ('includes/header.html');
	echo '<h1>Registered Users</h1>';
	
	require_once ('mysqli_connect.php');

	// Number of records to show per page:
	$display = 10;
	
	// Determine number of pages
	if (isset($_GET['p']) && is_numeric ($_GET['p'])) { // See if # of pages in GET/URL
		$pages = $_GET['p'];
	} else { // If # pages not in GET/URL
		$q = "SELECT COUNT(user_id) FROM users"; // Construct query to count the number of records:
		$r = @mysqli_query ($dbc, $q); // Execute query
		$row = @mysqli_fetch_array ($r, MYSQLI_NUM); // Fetch results into array
		$records = $row[0]; // Get first element of array ($ of pages)
		
		
		if ($records > $display) { // If more records than will fit in specified page length
			$pages = ceil ($records/$display); // Calculate number of pages
		} else {
			$pages = 1;
		}
	}
	
	 // Determine where in DB to start returning results...
	if (isset($_GET['s']) && is_numeric($_GET['s'])) {
		$start = $_GET['s'];
	} else {
		$start = 0;
	}
	
	$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';
	// Determine the sorting order:
	switch ($sort) {
		case 'ln':
			$order_by = 'last_name ASC';
			break;
		case 'fn':
			$order_by = 'first_name ASC';
			break;
		case 'rd':
			$order_by = 'registration_date ASC';
			break;
		default:
			$order_by = 'registration_date ASC';
			$sort = 'rd';
			break;
	}

	 // Define the query
	$q = "SELECT last_name, first_name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr, user_id FROM users ORDER BY $order_by LIMIT $start, $display";
	//$q = "SELECT last_name, first_name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr, user_id FROM users ORDER BY registration_date ASC LIMIT $start, $display";
	$r = @mysqli_query ($dbc, $q);
	
	 // Table header
	//echo '<table align="center" cellspacing="0" cellpadding="5" width="75%"><tr><td align="left"><b>Edit</b></td><td align="left"><b>Delete</b></td><td align="left"><b>Last Name</b></td><td align="left"><b>First Name</b></td><td align="left"><b>Date Registered</b></td></tr>';
	echo '<table align="center" cellspacing="0" cellpadding="5" width="75%"><tr><td align="left"><b>Edit</b></td><td align="left"><b>Delete</b></td><td align="left"><b><a href="view_users.php?sort=ln">Last Name</a></b></td><td align="left"><b><a href="view_users.php?sort=fn">First Name</a></b></td><td align="left"><b><a href="view_users.php?sort=rd">Date Registered</a></b></td></tr>';
	 
	$bg = '#eeeeee'; // Set the initial background color.
	
	while ($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) { // Fetch and print records....
		$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee'); // Switch the  background color.
		echo '<tr bgcolor="' . $bg . '"><td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td><td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td><td align="left">' . $row['last_name'] . '</td><td align="left">' . $row['first_name'] . '</td><td align="left">' . $row['dr'] .'</td></tr>';			
	}
	echo '</table>';
	mysqli_free_result ($r);
	mysqli_close($dbc);
	
	if ($pages > 1) { // If more than one page
		echo '<br /><p>';	
		$current_page = ($start/$display) + 1; // Determine what page script's on
		 
		// If it's not the first page, make previous link
		if ($current_page != 1) { 
			//echo '<a href="view_users.php?s=' . ($start - $display) . '&p=' . $pages . '">Previous</a> ';
			echo '<a href="view_users.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
		}

		// Make numbered pages
		for ($i = 1; $i <= $pages; $i++) {
			if ($i != $current_page) {
				//echo '<a href="view_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '">' . $i . '</a> ';
				echo '<a href="view_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
			} else {
				echo $i . ' ';
			}
		}
			
		// If it's not last page, make next button
		if ($current_page != $pages) {
			//echo '<a href="view_users.php?s=' . ($start + $display) . '&p=' . $pages . '">Next</a>';
			echo '<a href="view_users.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
		}
			echo '</p>';	
	}	 	
	include ('includes/footer.html');
?>