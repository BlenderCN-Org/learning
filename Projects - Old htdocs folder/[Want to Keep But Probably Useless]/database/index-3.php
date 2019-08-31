<?PHP

    $db = new PDO('sqlite:russ.db');
	function insert_into($field, $value, $TABLE, $database){
	$db = new PDO($database);
	$db->exec("INSERT INTO $TABLE ($field) VALUES ('$value');");
    $db = NULL;
	}
	insert_into("Name", "Alex", "Russ", 'sqlite:russ.db');
	
	function read_table($TABLE){
	global $db;
	$result = $db->query("SELECT * FROM $TABLE");
	return $result;
	}

	//create the database
    $db->exec("CREATE TABLE Russ (Id INTEGER PRIMARY KEY, Breed TEXT, Name TEXT, Age INTEGER)");    

	
    //output the data to a simple html table...
    print "<table border=1>";
    print "<tr><td>Id</td><td>Breed</td><td>Name</td><td>Age</td></tr>";
   $results = read_table("Russ");
    foreach($results as $row)
    {
      print "<tr><td>".$row['Id']."</td>";
      print "<td>".$row['Breed']."</td>";
      print "<td>".$row['Name']."</td>";
      print "<td>".$row['Age']."</td></tr>";
    }
    print "</table>";

?>