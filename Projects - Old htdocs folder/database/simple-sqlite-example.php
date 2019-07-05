<?PHP
 //open the database
    $db = new PDO('sqlite:russ.db');
	//insert some data...
    $db->exec("INSERT INTO Russ (Breed, Name, Age) VALUES ('Labrador', 'Tank', 2);".
               "INSERT INTO Dogs (Breed, Name, Age) VALUES ('Husky', 'Glacier', 7); " .
               "INSERT INTO Dogs (Breed, Name, Age) VALUES ('Golden-Doodle', 'Ellie', 4);");

	//create the database
    $db->exec("CREATE TABLE Russ (Id INTEGER PRIMARY KEY, Breed TEXT, Name TEXT, Age INTEGER)");    

	
    //output the data to a simple html table...
    print "<table border=1>";
    print "<tr><td>Id</td><td>Breed</td><td>Name</td><td>Age</td></tr>";
    $result = $db->query('SELECT * FROM Russ');
    foreach($result as $row)
    {
      print "<tr><td>".$row['Id']."</td>";
      print "<td>".$row['Breed']."</td>";
      print "<td>".$row['Name']."</td>";
      print "<td>".$row['Age']."</td></tr>";
    }
    print "</table>";

?>