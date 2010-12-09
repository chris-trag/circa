<?php

	/*
	-=-=-=-=-=-=-=-=-=-=-=-=-=
	C O N S T A N T S
	=-=-=-=-=-=-=-=-=-=-=-=-=-
	*/
	
	/* Switch of the dB connection depending on if the page
	is a local version or production on the server
	*/
	
	if($_SERVER['SERVER_NAME'] == "localhost"){
		// Define the dB name
		define("DB_NAME","cs50_circa");
		
		// Define the dB user
		define("DB_USER", "root");
		
		// Define the dB pass
		define("DB_PASS", "root");
		
		// Define the dB server
		define("DB_SERVER", "localhost");
	} else {
		define(DB_NAME,"cs50_circa");
		
		// Define the dB user
		define(DB_USER, "circa_admin");
		
		// Define the dB pass
		define(DB_PASS, "0gg1mAy0R");
		
		// Define the dB server
		define(DB_SERVER, "mysql.circa.ctraganos.com");
	}

  

?>
