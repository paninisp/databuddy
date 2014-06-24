<?php
	$dbhost = 'engr-db.engr.oregonstate.edu:3307';
	$dbname = 'OSUDatabuddies';
	$dbuser = 'OSUDatabuddies';
	$dbpass = '';

	$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
    or die("Error connecting to database server");

	mysql_select_db($dbname, $mysql_handle)
    or die("Error selecting database: $dbname");
	
?>
