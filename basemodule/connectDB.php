<?php
	$dbhost = 'mysql.cs.orst';
	$dbname = 'OSU_Databuddies';
	$dbuser = 'OSU_Databuddies';
	$dbpass = 'e3dh7TpPvujsAxCn';

	$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
    or die("Error connecting to database server");

	mysql_select_db($dbname, $mysql_handle)
    or die("Error selecting database: $dbname");
	
?>
