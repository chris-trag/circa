<?php
/*
-=-=-=-=-=-=-=-=-=-
VOUCH.PHP
This page processes the form and vetted users
then writes the infomation to the dB
=-=-=-=-=-=-=-=-=-=
*/
    // require common code
    require_once("../includes/common.php"); 

    // escape username and password for safety
    $user = $_POST["user"];
    $hashtag = mysql_real_escape_string($_POST['hashtag']);
    $description = mysql_real_escape_string($_POST["description"]);
    $source_link = mysql_real_escape_string($_POST['source_link']);
    
    
	$users = mysql_real_escape_string(implode(", ", $user));
	//$test = explode(",", $users);
	    
/*
	echo $hashtag;
	echo "<br>";
	echo $description;
	echo "<br>";
	echo $source_link;
	echo "<br>";

    print_r($test);
*/
    

    // prepare SQL
    $sql = sprintf("INSERT INTO streams (hashtag, description, source_link, users) VALUES('{$hashtag}','{$description}','{$source_link}','{$users}')");

    // execute query
    $result = mysql_query($sql);

    // if we found a row, remember user and redirect to portfolio
	if(!$result)
	{
		echo "No luck adding users";
	}else{header("Location: ../index.php");}

?>


