<?php
    $dbhost = "localhost"; //will need up update this with server name
    $dbuser = "root"; //will update this to pull username
    $dbpass = "#go4JAYz"; //will update this to pull password
    $dbname = "login"; //this is the name of the database we're accessing

    if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
        die("failed to connect");
    }
?>