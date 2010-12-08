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

?>
