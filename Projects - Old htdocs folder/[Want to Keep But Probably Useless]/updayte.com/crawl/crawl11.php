<?php
ini_set('display_errors', 'On');
	$counter = 1;
	include_once('simple_html_dom.php');
	$target_url = "http://www.amazon.com/b/ref=MoviesHP_H1_Preorders?ie=UTF8&node=7353051011&pf_rd_m=ATVPDKIKX0DER&pf_rd_s=merchandised-search-1&pf_rd_r=0V740W5F4HXYF8B5P3R0&pf_rd_t=101&pf_rd_p=1713805182&pf_rd_i=2625373011";
	$html = new simple_html_dom();
	$html->load_file($target_url);
	foreach($html->find('a') as $link)
	{
	if (strpos($link,'www.amazon.com') !== false && strpos($link,'amazon.com:443') !== true) {
	$newurl = $link->href;
	$newpage = file_get_html($newurl); 
 	$avail = $newpage->find('span[class=availOrange]');

		if (strpos(implode("-", $avail),'released') !== false)
		{
			$ptitle = $newpage->find('span[id=btAsinTitle]');  
			$auth = $newpage->find('div[class=subTitle ]');
			echo $counter . '. <a href="' . $link->href . '">';
			echo $ptitle[0];
			echo '</a><br/>';
			foreach($auth as $author){
			/* echo 'Author:' . $author->find('a[href]', $counter)->plaintext . '<br/>'; */
			echo 'Author: ' . $author->find('a[href]')->plaintext . ' ';
			}
			echo '<br/>';
			echo 'Release Date: ';
			if(isset($avail[0]))
			{
			echo $avail[0];
			}
			echo '<br />';
			$counter++;
		}
	}
	}
	
$field ='<sasa>';
if (preg_match('/["<>]/', $field)) {echo 'yes';} else echo 'no';
	include "debugger.php";
?>