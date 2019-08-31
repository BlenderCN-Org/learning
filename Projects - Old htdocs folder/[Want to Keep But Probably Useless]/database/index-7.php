<?PHP
	function insert_into($field, $value, $TABLE, $database){
	$db = new PDO("sqlite:" . $database);
	$db->exec("INSERT INTO $TABLE ($field) VALUES ('$value');");
    $db = NULL;
	}
 	insert_into("Name", "Alex", "Russ", 'russ.db');
	
	function read_table($TABLE, $database){
	$db = new PDO('sqlite:' . $database);
	$result = $db->query("SELECT * FROM $TABLE");
	$db = NULL;
	return $result;
	}
	$results = read_table("Russ", 'russ.db');
	  
	   
	   $database = 'russ.db';
		$db = new PDO('sqlite:' . $database);
		$db->exec("CREATE TABLE Russ (Id INTEGER PRIMARY KEY, Breed TEXT, Name TEXT, Age INTEGER)");    

	
		//output the data to a simple html table...
		print "<table border=1>";
		print "<tr><td>Id</td><td>Breed</td><td>Name</td><td>Age</td></tr>";

    foreach($results as $row)
    {
      print "<tr><td>".$row['Id']."</td>";
      print "<td>".$row['Breed']."</td>";
      print "<td>".$row['Name']."</td>";
      print "<td>".$row['Age']."</td></tr>";
    }
    print "</table>";
	
	print_r($results);

?>