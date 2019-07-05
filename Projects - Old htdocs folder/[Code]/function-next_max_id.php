<?php
					
					
					function maxid($table){
					$conn = mysqli_connect('127.0.0.1', 'root', '');
					$database = 'updayte';
					mysqli_select_db($conn, $database);
					$q = "select MAX(id) from $table";
					$result = mysqli_query($conn, $q);
					$data = mysqli_fetch_array($result);
					echo ($data[0] + 1);
					}
					maxid('books');
					
?>