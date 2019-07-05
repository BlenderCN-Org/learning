<?php
	//set up users
	$from = "webforms@example.com";
	$to = "you@example.com";
	
	//cut the message down to size, remove HTML tags
	$messagebody = strip_tags(substr($_POST['msg'],0,5000));
	$message_body = escapeshellarg($messagebody);
	
	$gpg_path = '/usr/local/bin/gpg';
	$home_dir = '/htdocs/www';
	$user_env = 'web';

	$cmd = "echo $message_body | HOME=$home_dir USER=$user_env $gpg_path" .
		"--quiet --no-secmem-warning --encrypt --sign --armor " .
		"--recipient $to --local-user $from";
	
	$message_body = `$cmd`;
	
	mail($to,'Message from Web Form', $message_body,"From:$from\r\n");

?>