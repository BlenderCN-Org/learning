<?php
	$counter = 1;
	include_once('simple_html_dom.php');
	$target_url = "http://www.amazon.com/b/ref=MoviesHP_H1_Preorders?ie=UTF8&node=7353051011&pf_rd_m=ATVPDKIKX0DER&pf_rd_s=merchandised-search-1&pf_rd_r=0V740W5F4HXYF8B5P3R0&pf_rd_t=101&pf_rd_p=1713805182&pf_rd_i=2625373011";
	$html = new simple_html_dom();
	$html->load_file($target_url);
	foreach($html->find('a') as $link)
	{
	if (strpos($link,'www.amazon.com') !== false) {
	$newurl = $link->href;
	$newpage = file_get_html($newurl);
 	$avail = $newpage->find('span[class=availOrange]');
	$ptitle = $newpage->find('span[id=btAsinTitle]');
		if (strpos($avail[0],'released') !== false) 
		{
			$author = $newpage->find('div[class=subTitle ]');
			echo 'Author1:' . $author[0]->children(1) . "<br/>";
			echo 'Author2:' . $author[0]->children(0) . "<br/>";
			echo $counter . '. <a href="' . $link->href . '">';
			echo $ptitle[0];
			echo '</a><br/>';
			echo 'Release Date: ' . $avail[0] . "<br />";
			$counter++;
		}
	}
	}
	include "debugger.php";
?>