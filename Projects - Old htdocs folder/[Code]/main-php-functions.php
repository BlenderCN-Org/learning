<!-- http://stackoverflow.com/questions/2407284/how-to-get-multiple-selected-values-of-select-box-in-php - PHP Multiple Form/POST Values -->
<!-- http://stackoverflow.com/questions/2148114/why-use-output-buffering-in-php -->


 <?php
	error_reporting(E_ALL ^ E_NOTICE);
	// Sessions use cookies which use headers.
	// Must start before any HTML output 
	// unless output buffering is turned on.
	session_start();


echo '<h2><font color="red">Superglobals, Sessions, and Cookies</font></h2>';
echo '<h3><font color="blue">Sessions</h3></font>';
			$_SESSION["first_name"] = "Kevin";
			$name = $_SESSION["first_name"];
			echo $name;
?>

<br/>

<h3><font color="blue">Session Login Form and Check Function</font></h3>
 <?php
 
echo "Pageviews=";
$_SESSION['views']=1;
$_SESSION['username']=1;
$_SESSION['loggd']=true;
echo $_SESSION['views'];


function loggedIn(){
    //Session logged is set if the user is logged in
    //set it on 1 if the user has successfully logged in
    //if it wasn't set create a login form
    if(!$_SESSION['loggd']){
        echo'<form action="checkLogin.php" method="post">
        <p>
            Username:<br>
            <input type="text" name="username">
        </p>
        <p>
            Password:<br>
            <input type="password" name="username">
        </p>
        <p>
            <input type="submit" name="submit" value="Log In">
        </p>
        </form>';
        //if session is equal to 1, display 
        //Welcome, and whaterver their user name is
    }else{
        echo 'Welcome, '.$_SESSION['username'];
    }
}
loggedIn();
?> 


<?php
$filename = 'data.txt';
$dummy = 'dummy.txt';
echo '<h2><font color="red">File Operations</font></h2><h3><font color="blue">Basic</h3></font>';
echo 'Read 14 characters starting from the 21st character: <br/>';
$section = file_get_contents($filename, NULL, NULL, 20, 14);
var_dump($section);

echo '<br/>';
echo '<br/>';


echo '<font color="green">pathinfo():<br/>';
print_r(pathinfo("data.txt"));
echo '<br/>';
print_r(pathinfo("data.txt",PATHINFO_BASENAME));
echo '<br/><br/></font>';
$file = 'data.txt';
$info = pathinfo($file);
echo 'Extension: ' . $info['extension'] . '<br/>';
$arr = file('dummy.txt'); //puts the whole file in an array ($arr) line by line
echo 'print_r($arr): ';
print_r($arr);
echo '<br/><br/>';


// $f2 = fopen($filename, "w"); // Open File for Writing
$f = fopen("dummy.txt","r") or die("Error !!!"); // Open File for Reading
echo 'While Loop feof(): ';
while (!feof($f)){
    echo $text = fgets($f);
}



/// File GET Contents
echo '<h3><font color="blue">File Get Contents</font></h3>';
$homepage = file_get_contents('http://www.example.com/');
echo $homepage;
echo '<br/>';


//File Put Contents
echo '<h3><font color="blue">File Put Contents</font></h3>';
file_put_contents("fileputcontents.txt","\nFirst", FILE_APPEND);
$fileput = file('fileputcontents.txt');
echo 'file_put_contents("fileputcontents.txt","\nFirst", FILE_APPEND);<br/><br/>';
print_r($fileput);
echo '<br/>';
echo '<br/>';


//Searching Within the includepath
echo '<h4><font color="blue">Searching Within the includepath</font></h4>';
// <= PHP 5
echo $file = file_get_contents('dummy.txt', true);
echo '<br/>';
// > PHP 5
echo $file = file_get_contents('dummy.txt', FILE_USE_INCLUDE_PATH);

echo '<br/>';
echo '<br/>';

echo '<h4><font color="blue">Using Stream Contexts</font></h4>';
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);
$context = stream_context_create($opts);
// Open the file using the HTTP headers set above
$file = file_get_contents('http://www.example.com/', false, $context);
print_r($file);

/* 
echo '<br/>';
echo '<br/>';
fputs($f,"\nSecond");
echo 'fread: ' . fread($filename, filesize("data.txt"));
echo '<br/>';
//reads one line from the file in question
echo 'fgets(): ' . fgets($f);
echo '<br/>';
//reads  one line from the file in question but delets html tags (if you read from an html file)
echo 'fgetss(): ' . fgetss($f); 
// you can specify the lenth of the string to return, e.g. 255
echo '<br/>';
echo 'fgetss($f, 255): ' . fgetss($f, 255); 
// you can also specify which tags to ignore (not to delete)
echo '<br/>';
echo 'fgetss(): ' . fgetss($f, 255),"<br><a>"; 
echo 'fgetc(): ' . fgetc($f);
fclose($f); */
?>

 
 
 <h3><font color="blue">File Download</h3></font> // Uncomment Code Below (Working)
 <?php
/* set_time_limit(10);
$url = 'http://pushbandroxx.com/video.mp4';
$pi = pathinfo($url);
$ext = $pi['extension'];
$name = $pi['filename'];


// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// grab URL and pass it to the browser
$opt = curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);

$saveFile = $name.'.'.$ext;
if(preg_match("/[^0-9a-z\.\_\-]/i", $saveFile))
    $saveFile = md5(microtime(true)).'.'.$ext;

$handle = fopen($saveFile, 'wb');
if(empty($saveFile))
{
fwrite($handle, $opt);
}
fclose($handle); */
?> 

<?php		
echo '<h2><font color="red">MySQL/Database Functions</font></h2>';
echo '<h3><font color="blue">Mysqli_Connect</h3></font>';

?>

<?php
echo '<h2><font color="red">Date & Time</font></h2>';
echo(strtotime("now") . "<br>");
echo(strtotime("3 October 2005") . "<br>");
echo(strtotime("+5 hours") . "<br>");
echo(strtotime("+1 week") . "<br>");
echo(strtotime("+1 week 3 days 7 hours 5 seconds") . "<br>");
echo(strtotime("next Monday") . "<br>");
echo(strtotime("last Sunday"));

echo '<br/>';
echo '<br/>';


echo '<h2><font color="red">Variables and Output</font></h2>';
$a = array(1, 2, array("a", "b", "c"));
var_dump($a);
print_r($a);
echo '<br/><br/>';
echo 'strip_tags Example:<br/>';
echo $Text2 = '<a href="http://www.example.com">Link Title</a>' . '<br/>';
echo strip_tags($Text2);
echo '<br/>';
echo '<br/>';
print_r(headers_list()); // Wont work unless output buffering is turned on.
?>
	


 <br />
	
<?php
echo '<br/><h2><font color="red">String Functions</font></h2>';
$test_string = "This is a basic test string to test words.";
/* echo get_words($test_string, 5); // prints: This is a basic test ...
echo '<br/>';
echo get_words($test_string, 5, 0, false); // prints: This is a basic t */


// in the below example 'd' and 's' specify the TYPE of the variable.
echo 'count_chars();';
echo '<br/>';
print_r(count_chars($test_string, 1));
echo '<br/>';
echo 'count_chars(): <br/>';
$data = "Two Ts and one F.";
foreach (count_chars($data, 1) as $i => $val) {
   echo "There were $val instance(s) of \"" , chr($i) , "\" in the string.\n";
} 
echo '<br/>';
echo 'sprintf(): ';
$num = 5;
$location = 'tree';
$format = 'There are %d monkeys in the %s';
echo sprintf($format, $num, $location);
echo '<br/>';
$format = 'The %2$s contains %1$d monkeys';
echo '2nd sprintf(): ' . sprintf($format, $num, $location);


echo '<br/>';
echo 'ltrim():';
$str = "Hello World!";
echo ltrim($str,"Hello");

echo '<br/>';
	
$Text = "/foo<b>bar";
$URL = '/foo<b>bar.html';
echo 'HTMLSpecialChars: ' . HTMLSpecialChars($Text), "<BR>";     
echo 'rawlurlencode: ' . rawurlencode($URL) . '<br/>';
echo 'strip_tags: ' . strip_tags($Text, "<b>");
echo '<br/>';
echo 'stripslahses: ' . stripslashes($Text);
echo '<br/>';
echo '<br/>';
echo '<font color="blue">preg_replace:<br/>';
$posted = 'Posted On April 6th By Some Dude';
echo $posted . '<br/>';
echo $posted = preg_replace('/ By.*/', '', $posted);
echo '</font><br/>';
echo '<br/>';
	
	
  $first = "The quick brown fox";
  $second = " jumped over the lazy dog.";
  
  $third = $first;
  $third .= $second;
  echo $third;

  ?>
  <br />
  Lowercase: <?php echo strtolower($third); ?><br />
  Uppercase: <?php echo strtoupper($third); ?><br />
  Uppercase first: <?php echo ucfirst($third); ?><br />
  Uppercase words: <?php echo ucwords($third); ?><br />
  <br />
  Length: <?php echo strlen($third); ?><br />
  Trim: <?php echo "A" . trim(" B C D ") . "E"; ?><br />
  Find: <?php echo strstr($third, "brown"); ?><br />
  Replace by string: <?php echo str_replace("quick", "super-fast", $third); ?><br />
  <br />
  Repeat: <?php echo str_repeat($third, 2); ?><br />
  Make substring: <?php echo substr($third, 5, 10); ?><br />
  Find position: <?php echo strpos($third, "brown"); ?><br />
  Find character: <?php echo strchr($third, "z"); ?><br />
	
	
	
	
    <?php 
	echo '<h2><font color="red">Arrays</font></h2>';
	/* $myArray1 = array('Cat','Mat','Fat','Hat');
	$myArray2 = array('c'=>'Cat','m'=>'Mat','f'=>'Fat','h'=>'Hat'); */
	
	$mixed = array(6, "fox", "dog", array("x", "y", "z")); 
	
	echo '<font color="blue">Array: </font>';
	print_r($mixed);
	echo '<br/>';
	?>
    <?php echo '$mixed[2]: ' . $mixed[2]; ?><br />
    <?php //echo $mixed[3]; ?><br />
    <?php //echo $mixed ?><br />
    
    <?php echo $mixed[3][1]; ?><br />
    
    <?php $mixed[2] = "cat"; ?>
    <?php $mixed[4] = "mouse"; ?>
    <?php $mixed[] = "horse"; ?>
    
    <pre>
    <?php echo print_r($mixed); ?>
    </pre>
    
    <?php 
      echo 'Short array syntax:<br/> ';
	  echo '$array = [1,2,3]<br/>';
      $array = [1,2,3];
    ?>
	
		<?php echo '<h2><font color="red">Associative Arrays</font></h2>'; 
	$assoc = array("first_name" => "Kevin", "last_name" => "Skoglund"); ?>
    <?php echo $assoc["first_name"]; ?><br />
    <?php echo $assoc["first_name"] . " " . $assoc["last_name"]; ?><br />

    <?php $assoc["first_name"] = "Larry"; ?>
    <?php echo $assoc["first_name"] . " " . $assoc["last_name"]; ?><br />

    <?php // echo $assoc[0]; ?><br />

    <?php $numbers = array(4,8,15,16,23,42); ?>
    <?php $numbers = array(0 => 4, 1 => 8, 2 => 15, 3 => 16, 4 => 23, 5 => 42); ?>
    <?php echo $numbers[0]; 
	echo '<br/>';
	echo '<br/>';
    
    $numbers = array(4,8,15,16,23,42);
    echo $numbers[0];
	// End Associative Arrays
	?>
	
	
	
	<?php 
	echo '<h2><font color="red">Array Functions</font></h2>';
	
	$numbers = array(8,23,15,42,16,4); ?>
    
    Count:         <?php echo count($numbers); ?><br />
    Max value:     <?php echo max($numbers);   ?><br />
    Min value:     <?php echo min($numbers);   ?><br />
    <br />
    <pre>
    Sort:          <?php sort($numbers);  print_r($numbers); ?><br />
    Reverse sort: <?php rsort($numbers); print_r($numbers); ?><br />
    </pre>
    <br />
    Implode:       <?php echo $num_string = implode(" * ", $numbers); ?><br />
    Explode:       <?php print_r(explode(" * ", $num_string)); ?><br />
    <br />
    
    15 in array?: <?php echo in_array(15, $numbers); // returns T/F ?><br />
    19 in array?: <?php echo in_array(19, $numbers); // returns T/F ?><br />
<h3><font color="blue">Function Arguments</font><h3>
     <?php

      function say_hello_to($word) {
        echo "Hello {$word}!<br />";
      }

      $name = "John Doe";
      say_hello_to($name);

    ?>
    
    <?php
    
      function better_hello($greeting, $target, $punct) {
        echo $greeting . " " . $target . $punct . "<br />";
      }
    
      better_hello("Hello", $name, "!");
      better_hello("Greetings", $name, "!!!");

      better_hello("Greetings", $name, null);
    
    ?>
	<br/><br/>
	
	
	
	 <?php
		echo '<h3><font color="blue">Multiple Return Function</font></h3>';
		function add_subt($val1, $val2) {
        $add = $val1 + $val2;
        $subt = $val1 - $val2;
        return array($add, $subt);
      }

      $result_array = add_subt(10,5);
      echo "Add: " . $result_array[0] . "<br />";
      echo "Subt: " . $result_array[1] . "<br />";

      list($add_result, $subt_result) = add_subt(20,7);
      echo "Add: " . $add_result . "<br />";
      echo "Subt: " . $subt_result . "<br />";
	echo '<br/>';
	echo '<br/>';
    ?>
	
	
	<?php
$original = 'color_Calla_Lilies';
?>
	<h2><font color="red">Finding and Extracting a Substring</font></h2>
<p>The position of "color" is <?php echo strpos($original, 'color_'); ?>.</p>
<p>The position of "Calla" is <?php echo strpos($original, 'Calla'); ?>.</p>
<?php if (strpos($original, 'color_') === 0) { ?>
<p>The original string begins with "color_".</p>
<?php } else { ?>
<p>The original string does not begin with "color_".</p>
<?php } 
echo substr($original, 6);
echo '<br/>';
echo '<br/>';
?>





<?php
$day = date('l');
$time = date('H:i');
$hour = date('H');
?>
<h2><font color="red">Using Date Parts to Control Output</font></h2>
<p>Today is <?php echo $day; ?>. The time is now <?php echo $time; ?>.</p>
<?php if ($hour > 5 && $hour <12) { ?>
<p>Good morning.</p>
<?php } elseif ($hour >= 12 && $hour < 18) { ?>
<p>Good afternoon.</p>
<?php } elseif ($hour >=18 && $hour < 23) { ?>
<p>Good evening.</p>
<?php } else { ?>
<p>It's late at night.</p>
<?php } ?>
	
	
	
<?php
$features = array(
    'winter' => 'Beautiful arrangements for any occasion.',
    'spring' => 'It must be spring! Delicate daffodils have arrived.',
    'summer' => "It's summer, and we're in the pink!",
    'autumn' => "Summer's over, but our flowers are still a riot of colors."
    );
?>

<h2><font color="red">Using Array Elements in Double Quotes</font></h2>
<p><?php echo 'The slogan for spring is: ' . $features['spring']; ?></p>


<h2><font color="red">Miscellanous</font></h2>

$time_start = microtime(true); 

$time_end = microtime(true);

$execution_time = ($time_end - $time_start)/60;

echo '<b>Total Execution Time:</b> '.$execution_time;

<h2><font color="red">Pre-written Functions:</font></h2>


<h3><font color="blue">Get Filesize</font></h3>
 <?php
function file_size($url){
    $size = filesize($url);
    if($size >= 1073741824){
        $fileSize = round($size/1024/1024/1024,1) . 'GB';
    }elseif($size >= 1048576){
        $fileSize = round($size/1024/1024,1) . 'MB';
    }elseif($size >= 1024){
        $fileSize = round($size/1024,1) . 'KB';
    }else{
        $fileSize = $size . ' bytes';
    }
    return $fileSize;
}
echo file_size('/myfile/image.jpg');
?> 
<br/><br/>



<h3><font color="blue">Validate Email Address</font></h3>
 <?php

$regex = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i";

// usage

if(!preg_match($regex, $email)) {
    echo "Invalid email address";
}
else {
    echo "email is valid";
}
/* [url=http://www.denbag.us/2013/09/perfect-php-email-regex.html]Example usage[/url] */
?>


<br/><br/>
 
 
 <h3><font color="blue">Date-Overlap Checker</font></h3>
 <?php
// Function to test for time overlap
// $start_time    A start date YYYY-MM-DD HH:MM:SS
// $end_time      An end date YYYY-MM-DD HH:MM:SS
// $times         An array of times to match against
// Returns true if there is an overlap false if no overlap is found
function time_overlap($start_time, $end_time, $times){
    $ustart = strtotime($start_time);
    $uend   = strtotime($end_time);
    foreach($times as $time){
        $start = strtotime($time["start"]);
        $end   = strtotime($time["end"]);
        if($ustart <= $end && $uend >= $start){
            return true;
        }
    }
    return false;
}

// A test list of times
$list_of_times = array(
    array(
        "start" => "2012-01-01 00:00:00",
        "end" => "2012-01-30 00:00:00"
    ),
    array(
        "start" => "2012-02-01 00:00:00",
        "end" => "2012-02-30 00:00:00"
    ),
    array(
        "start" => "2012-03-01 00:00:00",
        "end" => "2012-03-30 00:00:00"
    )
);

// Test some times
if(!time_overlap("2012-03-15 00:00:00", "2012-04-01 00:00:00", $list_of_times)){
    echo "No overlap found adding to array!<br />";
    $list_of_times[]["start"] = "2012-03-15 00:00:00";
    $list_of_times[]["end"] = "2012-04-01 00:00:00";
}else{
    echo "Overlap found time not added to array!<br />";
}

if(!time_overlap("2012-04-15 00:00:00", "2012-05-01 00:00:00", $list_of_times)){
    echo "No overlap found adding to array!<br />";
    $list_of_times[]["start"] = "2012-03-15 00:00:00";
    $list_of_times[]["end"] = "2012-04-01 00:00:00";
}else{
    echo "Overlap found time not added to array!<br />";
} 
?>

<br/><br/>
<h3><font color="blue">Find string in string</font></h3>
 <?php
function strinstr($find, $str){
    $find = preg_quote($find);
    if(preg_match('~'.$find.'~',$str)){
        return TRUE;
    }
    return FALSE;
}

$sStr = 'hello my name is billy bob joe.';

if(strinstr('ralph', $sStr))
    echo 'found';
else
    echo 'not found';
?> 


<h3><font color="blue">PHP Find Proxy Behind IP</font></h3>
 <?php
if (!empty($_SERVER["HTTP_CLIENT_IP"]))
{
 //check for ip from share internet
 $ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
 // Check for the Proxy User
 $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else
{
 $ip = $_SERVER["REMOTE_ADDR"];
}

// This will print user's real IP Address
// does't matter if user using proxy or not.
echo $ip;

?> 


<h3><font color="blue">PHP Unzip File</font></h3>
 <?php
    function unzip($location,$newLocation){
        if(exec("unzip $location",$arr)){
            mkdir($newLocation);
            for($i = 1;$i< count($arr);$i++){
                $file = trim(preg_replace("~inflating: ~","",$arr[$i]));
                copy($location.'/'.$file,$newLocation.'/'.$file);
                unlink($location.'/'.$file);
            }
            return TRUE;
        }else{
            return FALSE;
        }
    }

if(unzip('zipedfiles/test.zip','unziped/myNewZip'))
    echo 'Success!';
else
    echo 'Error: File Probably Does not Exist';
?> 



<br/><br/>



<h3><font color="blue">IP Blacklist Checker</font></h3>
 <?php
 
function blacklist($ip){
    $listed = true;
    $dnsbl_lookup = array(
        "dnsbl-1.uceprotect.net",
        "dnsbl-2.uceprotect.net",
        "dnsbl-3.uceprotect.net",
        "dnsbl.dronebl.org",
        "dnsbl.sorbs.net",
        "zen.spamhaus.org"
    ); // Add your preferred list of DNSBL's
    $lookups = count($dnsbl_lookup);
    $total = 0;
    if($ip){
        $reverse_ip = implode(".", array_reverse(explode(".", $ip)));
        foreach($dnsbl_lookup as $host){
            if(checkdnsrr($reverse_ip.".".$host.".", "A")){
                $total++;
            }
        }
    }
    $percent = ($total / $lookups) * 100;
    if($percent >= 50){
        return true;
    }else{
        return false;
    }
}

if(blacklist($_SERVER["REMOTE_ADDR"])){
    die("Your on the blacklist!");
}
else
{
	echo 'You are not on any blacklist';
}
?>

 <?php
	echo '<h3><font color="blue">Tag Builder</font></h3>';
 function buildTag($tag, $att = array(), $selfColse = FALSE, $inner = ''){
    $t = '<'.$tag.' ';
    foreach($att as $k => $v){
        $t .= $k.'="'.$v.'"';
    }
    if(!$selfColse)
        $t .= '>';
    else
        $t .= ' />';
    if(!$selfColse)
        $t .= $inner.'</'.$tag.'>';
    return $t;
}
// Example 1:
echo 'Example 1:';
echo buildTag('input', array('type'=>'button', 'value'=>'WOOT!'), TRUE);
echo '<br/>';
// Example 2:
echo 'Example 2:';
echo buildTag('div', array('style'=>'border:solid 1px #000'), FALSE, buildTag('a', array('href'=>'http://google.com'), FALSE, 'Google'));
echo '<br/>';
?> 

 <?php
echo '<h3><font color="blue">Integer to Currency</font></h3>';
 function toCurrency($var){
    return "$".number_format($var,2);
} 
echo toCurrency(5);
echo '<br/>';
?>



 <?php
 // Database Search
/* 	if(!isset($_GET['page']) || !ctype_digit($_GET['page']))
        $page = 1;
    else
        $page = $_GET['page'];
    // Set the maximum number of results
    $max = 10;
    // Set the start location (when viewing the next page)
    $limit = ($page * $max) - $max;
    
    $q = trim(mysql_real_escape_string($_GET['q'])); // Make a safe string
    
    // Make a query, (change "code" and "name" to your column names)
    $query = "SELECT SQL_CALC_FOUND_ROWS *,
            MATCH(code) AGAINST ('$q' IN BOOLEAN mode) AS score1,
            MATCH(name) AGAINST ('$q' IN BOOLEAN mode) AS score2
            FROM snippets 
            WHERE  
            MATCH(code,name) AGAINST ('$q' IN BOOLEAN mode) 
            ORDER BY score1 DESC, score2 DESC LIMIT $limit, $max";
    // Perform the query
    $sql = mysql_query($query);
    // Find how many results would have been returned if there wasn't a limit
    $result_count = mysql_query("SELECT FOUND_ROWS()")or die(mysql_error());
    // Get the number
    $total = mysql_fetch_array($result_count);
    // Search the array for the total
    $totalrows = $total[0];
    // Calculate the number of pages, if it is a decimal, then there are
    // more reusults, but that number is less than our $max (total number of results 
    // to display on the page)
    $pages = ceil($totalrows / $max);
    // Display the results...
    if(mysql_num_rows($sql) > 0){
        echo '<p>Found <b>'.$totalrows.'</b> results for <b>"'.htmlentities($_GET['q']).'"</b></p>';
        $i = $limit + 1;
        while($row = mysql_fetch_array($sql)){
            echo '<p>'.$i.'. <a href="view.php?id='.$row['id'].'">'.$row['name'].'</a></p>';
            $i++;
        }
    }else{
        // No results were found
        echo '<h2>No Results Found!</h2>';
    }
    // Display the page numbers (if there is more than one page)
    if($pages > 1){
        echo '<div style="padding:10px;">';
            for($i = 1;$i<$pages+1;$i++){
                if($i == $page)
                    echo '<span class="page" style="padding:10px;">'.$i.'</span>';
                else
                    echo '<a style="padding:10px;" href="'.$_SERVER['PHP_SELF'].'?q='.$_GET['q'].'&amp;page='.$i.'">'.$i.'</a>';
            }
            echo '<span style="clear:both;display:block;font-size:1px;">&nbsp;</span>';
        echo '</div>';
    } */
	?> 
<br/>
<br/>

Javascript Back Button:<br/>
<a href="javascript:history.back()">javascript:history.back()</a>