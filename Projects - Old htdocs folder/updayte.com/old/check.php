<?php
		$_SESSION['identity'] = $openid->identity;
		if(isset($_SESSION['identity'])) 
		{
		$logged = "yes";
		echo $logged;
		} else 
		{
		$logged = "no";
		echo $logged;
		}
?>