<?php
	date_default_timezone_set("America/New_york");
	ini_set('display_errors', 'On');
	$counter = 1;
	$nonval = 0;
	$nonrel = 0;
	$badlink = 0;
	$promolink = 0;
	$imglink = 0;
	$pricelink = 0;
	$time_start = microtime(true); 
	
	include_once('simple_html_dom.php');
	$target_url = "http://www.amazon.com/s/ref=sr_pg_2?rh=n%3A2625373011%2Cp_69%3A1y-700y&page=2&bbn=2625373011&ie=UTF8&qid=1403598261";
	$html = new simple_html_dom();
	$html->load_file($target_url);
	foreach($html->find('a') as $link)
	{
		if (strpos($link->href,'www.amazon.com') == false)
		{
			echo 'Non Amazon.com Link Skipped: ' . $link->href . '<br/>'; 
			$badlink++;
			continue;
		}
		if(strpos($link,'class="grey"') == true && strpos($link,'class="bld red fixed14"') == true)
		{
		echo 'Price Link Skipped: ' . $link->href . '<br/>'; 
			$pricelink++;
			continue;
		}
		if (strpos($link->href,'amazon.com:443') == true)
		{
			echo '443 Link Skipped: ' . $link->href . '<br/>'; 
			$badlink++;
			continue;
		}
		if(strpos($link,'img') == true){
			echo 'Image Link Skipped: ' . $link->href . '<br/>'; 
			$imglink++;
			continue;
		}
		if(strpos($link,'productPromo') == true){
			echo 'Promo Link Skipped: ' . $link->href . '<br/>'; 
			$promolink++;
			continue;
		}
	
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
				echo '<br/>';
				echo 'Removed Comma from Date: ' . $date3 = str_replace(",", "", $date2);
				echo '<br/>';
				echo 'Removed Period from Date: ' . $date4 = str_replace(".", "", $date3);
				echo '<br/>';
				$date5 = ltrim($date4,'<span class="availOrange">');
				$date6 = rtrim($date5,'</span>');
				$finaldate = date('Y/m/d', strtotime($date6));
				echo 'Clean/Parsed Date: ' . $date6 . '<br/>';
				echo 'Final Strtotime() Date: ' . $finaldate . '<br/>';
				echo 'Plain-text Title: ' . $ptitle[0]->plaintext . '<br/>';
				echo 'Link Plain-text: ' . $link->href . '<br/>';
				echo '$link Plaint-text: ' . $link->plaintext . '<br/>';
				
				echo '<br/>';
				foreach($auth as $author)
				{
					echo 'Author/Actor(s): ';
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
				$time_end = microtime(true);
				$execution_time = ($time_end - $time_start)/60;
				echo $execution_time . '<br/>';
				if($execution_time > .40)
				{
				echo 'Script Ended At Maximum Set Time' . '<br/>';
				break;
				}
			}
	}
	/* echo 'Non-Released Links Found: ' . $nonrel . '<br/>';
	echo 'Non-Valid Links Found: ' . $nonval . '<br/>'; */
	echo 'Bad Links Skipped: ' . $badlink . '<br/>';
	echo 'Promo Links Skipped: ' . $promolink . '<br/>';
	echo 'Price Links Skipped: ' . $pricelink . '<br/>';
	echo 'Img Links Skipped: ' . $imglink . '<br/>';
	/* $field ='<sasa>';
	if (preg_match('/["<>]/', $field)) {echo 'yes';} else echo 'no'; */
	include "debugger.php";
?>