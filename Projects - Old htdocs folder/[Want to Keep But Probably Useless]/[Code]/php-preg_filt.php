<?php
	$tb = 'aoiiag+rt';

	function preg_filt($userin){
	if (preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $userin)) 
	{
	return false;
	} else {
    return true;
	}
	}
	var_dump(preg_filt($tb));
?>