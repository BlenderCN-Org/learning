<html lang="en">
<head>
	<meta charset=utf-8" />
	<title>Form Feedback</title>
<style type="text/css" title="text/css" media="all">
.error {
	font-weight: bold;
	color: #C00;
}
</style>
</head>
<body>

<?php
// $name = $_REQUEST['name'];
// $email = $_REQUEST['email'];
// $comments = $_REQUEST['comments'];

// Check if empty
if (!empty($_REQUEST['name'])) {
	$name = $_REQUEST['name'];
} else {
	$name = NULL;
	echo '<p class="error">You forgot to enter your name!</p>';
}

if (!empty($_REQUEST['email'])) {
	$email = $_REQUEST['email'];
} else {
	$email = NULL;
	echo '<p class="error">You forgot to enter your email address!</p>';
}

if (!empty($_REQUEST['comments'])) {
	$comments = $_REQUEST['comments'];
} else {
	$comments = NULL;
echo '<p class="error">You forgot to enter your comments!</p>';
}

// Create the $gender variable
if (isset($_REQUEST['gender'])) {
	$gender = $_REQUEST['gender'];
} else {
	$gender = NULL;
}

echo "<p>Thank you, <b>$name</b>, for the following comments:<br /> <tt>$comments</tt></p><p>We will reply to you at <i>$email</i>.</p>\n";

// Print message based upon gender value
if ($gender == 'M') {
	echo '<p><b>Good day, Sir!</b></p>';
} elseif ($gender == 'F') {
	echo '<p><b>Good day, Madam!</b></p>';
} else { // None selected.
	echo '<p><b>You forgot to enter your gender!</b></p>';
}
?>