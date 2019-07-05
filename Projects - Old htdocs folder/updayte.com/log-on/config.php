<?PHP

$config =array(
		"base_url" => "http://updayte.com/log-on/hybridauth/index.php",
		"providers" => array ( 

			"Google" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "570249173888-d1ooioqvtn2aavcv6du69irlqmgu9sja.apps.googleusercontent.com", "secret" => "FL-Qr3ZrvIezEqvAENXN3xfw" ), 
			),

			"Facebook" => array ( 
				"enabled" => true,
				"keys"    => array ( "id" => "1422907944648225", "secret" => "ba161929d3eef672cf7d6bd9dd753b61" ), 
			),

			"Twitter" => array ( 
				"enabled" => true,
				"keys"    => array ( "key" => "XXXXXXXX", "secret" => "XXXXXXX" ) 
			),
		),
		"debug_mode" => true,
		"debug_file" => "log.txt",
	);
?>