<?PHP


	$TABLE = "Russ";
	$database = 'russ.db';
	$db = new PDO('sqlite:' . $database);
	$db->exec("CREATE TABLE Russ (Id INTEGER PRIMARY KEY, Breed TEXT, Name TEXT, Age INTEGER)"); 

	function list_columns($TABLE){
	global $db;
	$tablecols = array_reduce(
	$db->query("PRAGMA table_info(`$TABLE`)")->fetchAll(),
	function($rV,$cV) { $rV[]=$cV['name']; return $rV; },
	array()
	);
	return $tablecols;
}
$tablecols = list_columns($TABLE);
print_r($tablecols);
	
	function insert_into($field, $value, $TABLE, $database){
	$db = new PDO('sqlite:' . $database);
	$db->exec("INSERT INTO $TABLE ($field) VALUES ('$value');");
    $db = NULL;
	}
	insert_into("Name", "Alex", "Russ", 'russ.db');
	
	function read_table($TABLE, $database){
	$db = new PDO('sqlite:' . $database);
	$result = $db->query("SELECT * FROM $TABLE");
	return $result;
	$db = NULL;
	}
	
	function query_table($query, $TABLE, $database){
	$db = new PDO('sqlite:' . $database);
	$result = $db->query($query);
	return $result;
	$db = NULL;
	}
	
	function add_column($column, $type, $TABLE, $database){
	$db = new PDO('sqlite:' . $database);;
	$db->exec("ALTER TABLE $TABLE ADD COLUMN $column $type");
	$db = NULL;
	}
	add_column("SessionID", "VARCHAR","Russ", 'russ.db');
	
	function del_table($WHERE, $TABLE, $database){
	$db = new PDO('sqlite:' . $database);;
	$db->exec("DELETE FROM $TABLE WHERE $WHERE");
	$db = NULL;
	}	
	del_table("ID = 5", "Russ", "russ.db");
	
	function update_table($condition, $fieldvalue, $TABLE, $database){
	$db = new PDO('sqlite:' . $database);
	$db->exec("UPDATE $TABLE SET $fieldvalue WHERE $condition");
	$db = NULL;
	}
	$fieldvalue = 'Breed = "Russell"';
	$condition = "id = 4";
	update_table($condition, $fieldvalue, "Russ", "russ.db");
	
	//$results = read_table("Russ", 'russ.db');
	$results = query_table("SELECT * FROM $TABLE", "Russ", 'russ.db');
	   
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
	//print_r($results);
?>