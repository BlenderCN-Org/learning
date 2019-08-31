// "cleaning the URL",Totally and in a nut shell:
// 1.You must use rawurlencode() for parts that come before "?"
// 2.Use urlencode for all GET parameters (values that come after each "=")(POST parameters are automatically encoded).
// 3.Use htmlspecialchars for HTML tag parameters and HTML text content

<?php
$url_page = 'example/page/url.php';
//page the link will request
$text = 'this is a simple string';   
$id = '4334%3434';       
$linktext = "<Clickit> & you will see it";
//text of the link, with HTML unfriendly characters
?>
<?php
// this gives you a clean link to use
$url = "http://localhost/";
$url .= rawurlencode($url_page);
$url .= "?text=" . urlencode($text);
$url .= "&id=" . urlencode($id);

// htmlspecialchars escapes any html that
// might do bad things to your html page
?>
<a href="<?php echo htmlspecialchars($url); ?>">
<?php echo htmlspecialchars($linktext); ?>
</a>