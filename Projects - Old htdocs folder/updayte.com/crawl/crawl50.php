<?php
	function array_push_assoc($array, $key, $value){
		$array[$key] = $value;
		return $array;
	}
	function write($fn, $link){
		$file = fopen($fn, 'a');
		fwrite($file, $link . "\r\n");
	}
	function valid_date($input){
		$date_format = 'Y/m/d';
		$input = trim($input);
		$time = strtotime($input);
		$is_valid = date($date_format, $time) === $input;
	return ($is_valid ? 'yes' : 'no');
	}
	function maxid($table){
		$conn = mysqli_connect('127.0.0.1', 'root', '');
		$database = 'updayte';
		mysqli_select_db($conn, $database);
		$q = "select MAX(id) from $table";
		$result = mysqli_query($conn, $q);
		$data = mysqli_fetch_array($result);
		echo ($data[0] + 1);
	}
	function title_clean($badtitle){
		$newtitle = str_replace("DVD", "", $badtitle);
		$newtitle = str_replace("UltraViolet", "", $newtitle);
		$newtitle = str_replace("+", "", $newtitle);
		$newtitle = str_replace("Blu-ray", '', $newtitle);
		$newtitle = str_replace("[", '', $newtitle);
		$newtitle = str_replace("]", '', $newtitle);
		$newtitle = str_replace("/", '', $newtitle);
		$newtitle = str_replace("Combo Pack", '', $newtitle);
		$newtitle = str_replace("-", '', $newtitle);
		$newtitle = str_replace("(2014)", '', $newtitle);
		$newtitle = str_replace("(2013)", '', $newtitle);
		$newtitle = str_replace("3D", '', $newtitle);
		$newtitle = str_replace("BluRay", '', $newtitle);
		$newtitle = str_replace(")", '', $newtitle);
		$newtitle = str_replace("(", '', $newtitle);
		$newtitle = str_replace("DIGITAL HD with", '', $newtitle);
		return $newtitle;
	}
	function platform_clean($array){
		if($val1 = array_search('&nbsp;', $array)){
			unset($array[$val1]);
		}
		if(in_array('Multi-Format', $array)){
			$val2 = array_search('Multi-Format', $array);
			unset($array[$val2]);
		}
		$array = array_values($array);
		return $array;
	}
	function clean_date($input_date){
		$date2 = str_replace("This title will be released on ", "", $input_date);
		$date3 = str_replace(",", "", $date2);
		$date4 = str_replace(".", "", $date3);
		$date5 = ltrim($date4,'<span class="availOrange">');
		$date6 = rtrim($date5,'</span>');
		$date7 = trim($date6);
		$db_date = date('Y/m/d', strtotime($date7));
		return $db_date;
	}
	date_default_timezone_set("America/New_york");
	ini_set('display_errors', 'On');
	ini_set('max_execution_time', 60);
	$counter = 1;
	$nonval = 1;
	$nonrel = 1;
	$badlink = 1;
	$promolink = 1;
	$imglink = 1;
	$pricelink = 1;
?>
<html><head></head><body>
<center><b><font color="green">Amazon Web Scraping Utility: By Russell Rounds</b></font><br/><br/>
<form method="post">
<table border="1" width="25%" bordercolor="green">
	<tr>
		<td>URL:</td>
		<td align=center><input type="text" name="url" size="50"/></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align=center><input type="submit" name="submit" value="Scrape URL" /></td>
	</tr>
</table>
</form>
</center>

<?php
	if (isset($_POST['submit']))
	{	
		$target_url = htmlspecialchars($_POST['url']);
		include_once('simple_html_dom.php');
		$html = new simple_html_dom();
		$html->load_file($target_url);
		echo '<font color="blue">' . 'Crawling URL for Links: ' . $target_url . '<br/><br/></font>';
		foreach($html->find('a') as $link)
		{
				$newurl = $link->href;
				if (strpos($link->href,'www.amazon.com') == false){
				continue;
				} 
				if (strpos($link->href,'amazon.com:443') == true){
				continue;
				}
				if(strpos($link,'class="grey"') == true && strpos($link,'class="bld red fixed14"') == true){
				continue;
				}
				if(strpos($link,'img') == true){
				continue;
				}
				if(strpos($link,'productPromo') == true){
				continue;
				}
				$newpage = file_get_html($newurl);
				$ptitle = $newpage->find('span[id=btAsinTitle]');
				$auth = $newpage->find('div[class=subTitle ]');
				$avail = $newpage->find('span[class=availOrange]');
				$platform = $newpage->find('div[class=binding-platform]');
				$platform2 = $newpage->find('td[class=tmm_videoMetaBinding]');
				if (strpos(implode("-", $avail),'released') == true AND !strpos(implode("-", $avail),'been'))
				{
					echo '<hr/>';
					echo $counter . '. <a href="' . $link->href . '">' . $ptitle[0] . '</a><br/>';
					
					// DATE
					echo 'Extracted Date: ' . $avail[0] . "<br />";
					echo 'Cleaned Date: ';
					echo '<b>' . $db_date = clean_date($avail[0]);
					echo '</b>';
					if(valid_date($db_date) == 'yes'){
						echo '  <font color=green><b>[Database-ready]</b></font>';
						write('good.txt', $newurl);
						}else{
						echo '  <font color=red><b>[Date NOT Valid for DB!]</b></font>';
					}
			
					// PLATFORM		
					$platform_array = array();
					for ($x=0; $x<=3; $x++) {
					if (!empty($platform2[$x]->plaintext)){
					array_push($platform_array, trim($platform2[$x]->plaintext));
					}}
					$platform = platform_clean($platform_array);
					echo '<br/>Platforms(s) <font color=green><b>[Database-ready]</b></font>:<br/> ';
					echo '<pre>';
					print_r($platform);
					echo '</pre>';
					
					// AUTHORS
					$auth_db_array = array();
					foreach($auth as $author)
					{
						for($i=0;$i <= 4;$i++)
						{
							$authorname = $author->find('a[href]', $i);
							if(!empty($authorname))
							{
								if(in_array($authorname, $auth_db_array) == false)
								{
									$key_name = 'author' . (1 + $i);
									$auth_db_array = array_push_assoc($auth_db_array, $key_name, $authorname->plaintext);
								}
							}		
						}
					}
						echo '<br/>Author(s)/Actor(s) <font color=green><b>[Database-ready]</b></font>:<br/> ';
						echo '<pre>';
						print_r($auth_db_array);
						echo '</pre>';
						
					// FINAL VARIABLES TO GO INTO DATABASE
					$db_platform_1 = $platform_array[0];
					$db_platform_2 = $platform_array[1];
					$uncleantitle = $ptitle[0]->plaintext;
					$db_title = title_clean($uncleantitle); 
					$db_source = $link->href;
						
					echo '<br/>Final Title:<b> ' . $db_title . '</b>  <font color=green><b>[Database-ready]</b></font><br/>';
					$counter++;
					echo '<br/>';
				}
						// $current_table = 'queue';
						// echo 'Inserting into DB:<br/>';
						// maxid('movies');
						// $database = 'updayte';
						// $con = mysqli_connect('127.0.0.1', 'root', '');
						// mysqli_select_db($con, $database);
						// mysqli_query($con, "INSERT INTO `$current_table`(title,platform,date,source) VALUES ('$db_title','$db_platform_1','$db_date','$db_source')");
		}
	}
?>
</body>	
</html>