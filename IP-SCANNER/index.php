<?php
	session_start();
	include_once('simple_html_dom.php');
    $db = new PDO("sqlite:crawl.db");
	
    $db->exec("CREATE TABLE Links (Id INTEGER PRIMARY KEY, url VARCHAR, original VARCHAR)");    
		
	function crawl($target_url){
		// if(strpos($target_url,'http://') === FALSE) { // Add URL prefix if not exist
				// $target_url = 'http://' . $target_url;
		// };
		
		$html = new simple_html_dom();
		$html->load_file($target_url);
		
		$index = 0;
		$array = array();
		foreach($html->find('a') as $link){
			if (empty($link->href) || empty($link)){
				continue;
			};
			// if (strpos($link->href,'www.amazon.com') == 0 AND strpos($link->href,'http://') == 0) { // Add Link Prefix if not exist
				// $url = $target_url . urldecode($link->href);
			// }else{
				// $url = $link->href;
			// };
			
			// $pattern2  = '/' . implode('|', array_map('preg_quote', $mhave)) . '/i';
			// if(preg_match($pattern2, $url) <> 1) {
				// continue; // Skip
			// }
			// $pattern  = '/' . implode('|', array_map('preg_quote', $mnot)) . '/i';
			// if(preg_match($pattern, $link) > 0) {
				// continue; // Skip
			// }
			
			$url = $link->href;
			$link_href = $link->href;
			$array[$index]['url'] = $url;
			$array[$index]['parent'] = $target_url;
			$array[$index]['original'] = $link_href;
			$index++;
		};
	return base64_encode(json_encode($array));
	};
	// Variables
	// $exclude = ['.mx', '.br', '.au', 'https', 'Media-Player', 'redirect', 'product-reviews', 'services.amazon', 'aws.amazon', '#', 'fresh.amazon', 'nav_a', 'onload=', 'void(0)', 'adobe.com', 'javascript', 'footer_logo', 'pd_pyml_rhf', 'gno_joinprmlogo', 'ref=gno_logo', 'Thread=', 'customer-media', 'ref=nav_logo', 'nav_joinprmlogo', 'access', 'ntpoffrw'];
	// $include = ['www.amazon.com'];
	// $root_url = 'http://www.amazon.com/';
	
	$count1 = 0;
	if(isset($_SESSION['data'])){
		$data = $_SESSION['data'];
	}
	if(isset($_POST['plus'])){
		next_index('links');
		header('Location: ' . $_SERVER['PHP_SELF']);
	}
	if(isset($_POST['minus'])){
		prev_index('links');
		header('Location: ' . $_SERVER['PHP_SELF']);
	}
	if(isset($_POST['clear'])){
		session_destroy();
		header('Location: ' . $_SERVER['PHP_SELF']);
	}
	if(isset($_SESSION['data'])){
		$index = count($_SESSION['data']);
	}
	if(!isset($_POST['url'])){
		$url = 'http://';
	};
	if(isset($_POST['url'])){
		$url = $_POST['url'];
	};
	
?>
	<html lang = "en">
	<head>
		<meta charset = "utf-8">
	</head>
	<body><center>
	<form method="post">
	<table border="1" width="50%" bordercolor="blue">
	<tr><td colspan=4>URL: <input type="text" size="75" name="url" value=
	<?PHP
	if(isset($url)){
		echo '"' . trim($url) . '"';
	};
	?>
	></tr></td>
	<tr>
	<td align=center><?PHP if (isset($index)){echo 'Links in Session: ' . $index; } ?><td colspan=1 align=center></td><td align=center>Database</td>
	</tr>
		<tr>
			<td align=center><input type="submit" name="run" value="Crawl URL" /><input type="submit" name="runrecursive" value="Crawl URLS in Array (Below)" /><input type="submit" name="clear" value="Clear Session" /><input type="submit" name="show" value="Show All in Session" /></td>
			<td><input type="submit" name="save" value="Save" /></td>
		</tr>
	</table>
	</form>
	<?php  
		if(isset($url)){
			echo 'URL Crawled: ' . $url;
		};
	?>
	</center>
<?PHP
		$skipped = 0;
		if (isset($_POST['save'])){
			$data = $_SESSION['data'];
			foreach($data as $d){
			// $url = $d['url'];
			$parent = $d['parent'];
			$original = $d['original'];
			$firstpart = substr($url,22, 1);
			ctype_upper($firstpart);
			if(ctype_upper($firstpart)){ // If the first letter is capitalized, it's mostly likely a product page.

				$db->exec("INSERT INTO Links (url, original) VALUES ('$url', '$original')");
				echo 'Row Inserted: '  . $original . '<br/>';
				$count1 = $count1 + 1;
		}else{
			$skipped = $skipped + 1;
		}		
		}
		echo '<font color="green"><b>Rows Inserted: ' . $count1 . '</b></font><br/>';
		echo '<font color="red"<<b>Skipped: ' . $skipped . '</b></font><br/>';
		}
if(isset($_POST['run'])){
		if(isset($_POST['url'])){
			$url = $_POST['url'];
		};
		if(!isset($_POST['url'])){
			// $url = '1.1.1.2';
			// $url = 'http://www.amazon.com/';
		};
		$array1 = crawl($url);
		echo '<pre>';
		$array1 = json_decode(base64_decode($array1));
		print_r($array1);
		echo '</pre>';
		if (isset($data)){
			$_SESSION['data'] = array_merge($data, $array1);
			$data = $_SESSION['data'];
		}else{
			$_SESSION['data'] = $array1;
			$data = $_SESSION['data'];
		};
};
	if (isset($_POST['runrecursive'])){
		$data = $_SESSION['data'];
		foreach($data as $d){ // Loop through each URL in browser session;
			$d = $d['original'];
			// $array1 = crawl($d, $include, $exclude, $root_url, $index); // Crawl URL using function crawl() above;
			echo '<pre>';
			print_r($array1);
			echo '</pre>';
			if (isset($data)){
				$_SESSION['data'] = array_merge($data, $array1);
				$data = $_SESSION['data'];
			}else{
				$_SESSION['data'] = $array1;
				$data = $_SESSION['data'];
			};
		};
	};
	echo '<br/>';
	if(isset($_POST['show'])){
		echo '<pre>';
		echo '$_SESSION[data]';
		$data = $_SESSION['data'];
		var_export($data);
		echo '</pre>';
	};
	echo "<br/>";
?>
</font>
	</body>
</html>