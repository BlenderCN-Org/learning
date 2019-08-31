<?PHP 
// PHP Error Logging & Debugging
// Document Compiled by Russell Rounds
// 8-31-2014
?>

<style>
#green
{
	color: green;
}
</style>


<h2 id="green">First Way:</h2>
<?php
$link = mysqli_connect("localhost", "root", "", "updayte");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* Table City already exists, so we should get an error */
if (!mysqli_query($link, "CREATE TABLE City (ID INT, Name VARCHAR(30))")) {
    printf("Error - SQLSTATE %s.\n", mysqli_sqlstate($link));
}

mysqli_close($link);
?>


<h2 id="green">Second Way</h2>
<?php
$link = mysqli_connect("localhost", "root", "", "updayte2"); // Because wrong database, should return 1st error below

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if (!mysqli_query($link, "SET a=1")) { // Since "SET a=1" is an invalid query, it will return the error number/list
    print_r(mysqli_error_list($link));
}

/* close connection */
mysqli_close($link);
?>



