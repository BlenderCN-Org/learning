<?php
include_once('simple_html_dom.php');
$target_url = "http://www.tokyobit.com";
$html = new simple_html_dom();
$html->load_file($target_url);
foreach($html->find(‘div[class=post]‘) as $post)
{
$post->find(‘div[class=buying]‘,0)->outertext = '';
$post->find(‘span[class=availOrange]‘,0)->outertext = '';
echo $post . "<br />";
}
?>