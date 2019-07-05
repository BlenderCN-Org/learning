<?php 
// A hitcounter with images: [IMG]http://ionut.net63.net/IMG/0.bmp[/IMG] [IMG]http://ionut.net63.net/IMG/1.bmp[/IMG] [IMG]http://ionut.net63.net/IMG/2.bmp[/IMG] [IMG]http://ionut.net63.net/IMG/3.bmp[/IMG] [IMG]http://ionut.net63.net/IMG/4.bmp[/IMG] [IMG]http://ionut.net63.net/IMG/5.bmp[/IMG] [IMG]http://ionut.net63.net/IMG/6.bmp[/IMG] [IMG]http://ionut.net63.net/IMG/7.bmp[/IMG] [IMG]http://ionut.net63.net/IMG/8.bmp[/IMG] [IMG]http://ionut.net63.net/IMG/9.bmp[/IMG] Copy all in a folder called IMG and put the folder in the same directory as the script you also need to create a file called "counter.txt" and put it into the same directori with the script (NOT in IMG)
$iPad = 7; 
$txt = file_get_contents("/home/a2595319/public_html/counter.txt"); 

if (!isset($_COOKIE['countplus']) || $_COOKIE['countplus'] != 1)   
{ 
    ++$txt; 
    file_put_contents("/home/a2595319/public_html/counter.txt", $txt);   
    setcookie('countplus', 1, time()+86400); 
} 

$sTxt = str_pad($txt, $iPad, '0', STR_PAD_LEFT); 
$iTxtLength = strlen($sTxt); 
for ($i = 0; $i < $iTxtLength; ++$i) 
{ 
print '<img src="../IMG/' . $sTxt[$i] . '.bmp" />'; 
} 
?> 