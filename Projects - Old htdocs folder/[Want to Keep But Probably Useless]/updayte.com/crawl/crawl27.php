<?php
	ini_set('display_errors', 'On');
	$counter = 1;
	$nonval = 0;
	$nonrel = 0;
	include_once('simple_html_dom.php');
	$target_url = "http://www.amazon.com/s/ref=sr_pg_2?rh=n%3A2625373011%2Cp_69%3A1y-700y&page=2&bbn=2625373011&ie=UTF8&qid=1403598261";
	$html = new simple_html_dom();
	$html->load_file($target_url);
	foreach($html->find('a') as $link)
	{
		if (strpos($link,'www.amazon.com') == true && strpos($link,'amazon.com:443') == false)
		{
		$newurl = $link->href;
		$newpage = file_get_html($newurl);
		$avail = $newpage->find('span[class=availOrange]');
			if (strpos(implode("-", $avail),'released') == true)
			{
				$ptitle = $newpage->find('span[id=btAsinTitle]');
				$auth = $newpage->find('div[class=subTitle ]');
				echo $counter . '. <a href="' . $link->href . '">' . $ptitle[0] . '</a><br/>';
				echo 'Extracted Date: ' . $avail[0] . "<br />";
				echo 'Removed Text From Date: '; 
				echo $date2 = str_replace("This title will be released on ", "", $avail[0]);
				echo 'Removed Comma from Date: ';
				echo $date3 = str_replace(",", "", $date2);
				echo '<br/>';
				echo 'Removed Period from Date: ';
				$date = str_replace(".", "", $date3);
				echo '<br/>';
				$reldate = date('d/m/Y', strtotime($date));
				echo 'Final Date: ' . $reldate;
				/* $date = 'July 25 2010';
				date('d/m/Y', strtotime($date)); */
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
								array_push($autharray, $authorname->plaintext);
							}
						}		
					}
					if(!empty($autharray))
					{
						$author_list = implode(", ", $autharray);
						echo $author_list;
					}
					echo '<br/>' . $newurl;
					echo '<br/>' . $link->plaintext;
					$counter++;
					echo '<br/><br/>';
				}
			}
			else
			{
				$nonrel++;
				/* echo $link->href . '<br/>'; */
			}
		}
		else
		{
			$nonval++;
			/* echo $link->href . '<br/>'; */
		}
	}
	echo 'Non-Released Links Found: ' . $nonrel . '<br/>';
	echo 'Non-Valid Links Found: ' . $nonval . '<br/>';
	/* $field ='<sasa>';
	if (preg_match('/["<>]/', $field)) {echo 'yes';} else echo 'no';
	include "debugger.php"; */
?>