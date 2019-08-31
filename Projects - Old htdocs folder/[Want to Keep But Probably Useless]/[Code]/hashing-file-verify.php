<html>
<head>
    <title>Hash (Check) Files</title>
    <style type='text/css'>
        #ok{color:green;}
        #nono{color:red;}
    </style>
</head>
<body>
     <?php
        if(!empty($_FILES)){
            if ($_FILES["file"]["error"] > 0){
              switch($_FILES["file"]["error"]){
                  case 1:
                      echo "<b id='nono'>Error: The uploaded file exceeds the upload_max_filesize directive in php.ini</b><br>";
                      break;
                  case 2:
                      echo "<b id='nono'>Error: The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.</b><br>";
                      break;
                  case 3:
                      echo "<b id='nono'>Error: The uploaded file was only partially uploaded.</b><br>";
                      break;
                  case 4:
                      echo "<b id='nono'>Error: No file was uploaded.</b><br>";
                      break;
                  case 6:
                      echo "<b id='nono'>Error: Missing a temporary folder.</b><br>";
                      break;
                  case 7:
                      echo "<b id='nono'>Error: Failed to write file to disk.</b><br>";
                      break;
                  case 8:
                      echo "<b id='nono'>Error: A PHP extension stopped the file upload.</b><br>";
                      break;
                  default:
                      echo "<b id='nono'>Unknown error occured.</b><br>";
              }
            } else {
                echo 'Upload: ' . $_FILES['file']['name'] . '<br>';
                echo 'Type: ' . $_FILES['file']['type'] . '<br>';
                echo 'Size: ' . (round($_FILES['file']['size'] / 1024, 2)) . ' Kb<br><br>';
                if(array_search($_POST['algo'], hash_algos())===false){
                    echo 'Unknown hashing algorithm requested.<br>';
                } else {
                    echo 'Hashing Algorithm: '. $_POST['algo'] . '<br>';
                    $hash = ccc($_POST['algo'], $_FILES['file']['tmp_name']);
                    echo 'Calculated hash: ' . $hash . '<br>';
                    if($_POST['exphash']!=='none' && !empty($_POST['exphash'])){
                        echo 'Expected hash: &nbsp;&nbsp;' . $_POST['exphash'] . '<br><br>';
                        echo ($hash==$_POST['exphash'])? '<b id="ok">Hash matched expected value.</b>' : '<b id="nono">Hash did not match expected value.</b>';
                        echo '<br>';
                    }
                }
            }
            ?>
            <br>
            <button onClick="document.location.reload(true)">Again</button>
             <?php
        } else {
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="exphash" value="none">
        <label for="file">Filename:</label>
        <input type="file" name="file" id="file">
        <input type="submit" name="submit" value="Submit" /><br>
        <label>Expected hash(optional): <input type="text" name="exphash" size="100"></label>
        <br><br>Choose an algorithm (This is the list of all the available algorithms in your php installation)<br>
         <?php
            foreach(hash_algos() as $algo){
                if($algo=='md5'){
                    echo "<label><input type='radio' name='algo' value='$algo' checked='checked'>$algo</label><br>";
                } else {
                    echo "<label><input type='radio' name='algo' value='$algo'>$algo</label><br>";
                }
            }
        ?>
    </form>
     <?php
        }
    ?>
</body>
</html>