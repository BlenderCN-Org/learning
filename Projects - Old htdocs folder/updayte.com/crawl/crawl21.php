<?php
	ini_set('display_errors', 'On');
	$counter = 1;
	$nonval = 0;
	$nonrel = 0;
	include_once('simple_html_dom.php');
	$target_url = "http://www.amazon.com/b/ref=MoviesHP_H1_Preorders?ie=UTF8&node=7353051011&pf_rd_m=ATVPDKIKX0DER&pf_rd_s=merchandised-search-1&pf_rd_r=0V740W5F4HXYF8B5P3R0&pf_rd_t=101&pf_rd_p=1713805182&pf_rd_i=2625373011";
	$html = new simple_html_dom();
	$html->load_file($target_url);
	foreach($html->find('a') as $link)
	{
	if (strpos($link,'www.amazon.com') == true && strpos($link,'amazon.com:443') == false)
	{
	if (strpos($link->href,'amazon.com:443') == false)
	{
	$newurl = $link->href;
	$newpage = file_get_html($newurl);
 	$avail = $newpage->find('span[class=availOrange]');
		if (strpos(implode("-", $avail),'released') == true)
		{
			$ptitle = $newpage->find('span[id=btAsinTitle]');
			$auth = $newpage->find('div[class=subTitle ]');
			echo $counter . '. <a href="' . $link->href . '">';
			echo $ptitle[0];
			echo '</a><br/>';
			echo 'Release Date: ' . $avail[0] . "<br />";
			foreach($auth as $author)
			{
			echo 'Author: ';
			$autharray = array();
			for($i=0;$i <= 3;$i++)
			{
				$authorname = $author->find('a[href]', $i);
				if(!empty($authorname))
				{
					if(in_array($authorname, $autharray) == false)
					{
					/* echo $authorname->plaintext . ' '; */
					array_push($autharray, $authorname->plaintext);
					}
				}
			}
			if(!empty($autharray))
			{
			$author_list = implode(", ", $autharray);
			echo $author_list;
			}
			$counter++;
			echo '<br/><br/>';
			}
		}
			else
			{
				$nonrel++;
			}
	}
	}
	else
	{
		$nonval++;
	}
	}
	echo 'Non-Released Links Found: ' . $nonrel . '<br/>';
	echo 'Non-Valid Links Found: ' . $nonval . '<br/>';
	/* $field ='<sasa>';
	if (preg_match('/["<>]/', $field)) {echo 'yes';} else echo 'no';
	include "debugger.php"; */
?>