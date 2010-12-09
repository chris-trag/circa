<?php 
	/*
	-=-=-=-=-=-=-=-=-=-
	common.php
	Pull in the necessary code for #CIRCA
	=-=-=-=-=-=-=-=-=-=
	*/
	
	// display errors and warnings but not notices
	ini_set("display_errors", TRUE);
	error_reporting(E_ALL ^ E_NOTICE);
	
	// required files
	require_once("functions.php");
	require_once("constants.php");
	
	
	function get_sidebar(){
		include("sidebar.php");
	}
	
	function get_footer(){
		include("footer.php");
	}
	
	function get_header(){
		include("header.php");
	}

    // ensure database's name, username, and password are defined
    if (DB_NAME == "") apologize("You left DB_NAME blank.");
    if (DB_USER == "") apologize("You left DB_USER blank.");
    if (DB_PASS == "") apologize("You left DB_PASS blank.");

    // connect to database server
    if (($connection = @mysql_connect(DB_SERVER, DB_USER, DB_PASS)) === FALSE)
        apologize("Could not connect to database server. " .
         "<br>Check DB_NAME, DB_PASS, and DB_USER in constants.php.");

    // select database
    if (@mysql_select_db(DB_NAME, $connection) === FALSE)
        apologize("Could not select database (" . DB_NAME . ").");


?>
