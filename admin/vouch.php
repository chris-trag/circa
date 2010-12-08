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
    $description = mysql_real_escape_string($_POST["description"]);
    $hashtag = mysql_real_escape_string($_POST['hashtag']);
    $source_link = mysql_real_escape_string($_POST['source_link']);
    
 /*
   echo $hashtag;
    echo "<br>";
    echo $description;
    echo "<br>";
    echo $source_link;
    echo "<br>";
    while (list($key,$val) = @each ($user))
		echo "\"$val\","; 
*/
    redirect("/index.php");
    

/*
    // prepare SQL
    $sql = "SELECT uid FROM users WHERE username='$username' AND password='$password'";

    // execute query
    $result = mysql_query($sql);

    // if we found a row, remember user and redirect to portfolio
    if (mysql_num_rows($result) == 1)
    {
        // grab row
        $row = mysql_fetch_array($result);

        // cache uid in session
        $_SESSION["uid"] = $row["uid"];

        // redirect to portfolio
        redirect("index.php");
    }

    // else report error
    else
        apologize("Invalid username and/or password!");

*/
?>


