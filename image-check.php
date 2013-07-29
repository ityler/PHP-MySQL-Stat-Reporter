#!/usr/local/bin/php
<?php 
/**** MySQL Stat Reporter ****/
/** Checks for empty rows in DB for specific column **/
/**** Tyler Normile ****/ 

/* File handlers */
fclose(STDIN);
fclose(STDOUT);
fclose(STDERR);
$STDIN = fopen('/dev/null', 'r');
$STDOUT = fopen('/var/www/path/to/file/imageCheck.log', 'wb');
$STDERR = fopen('/var/www/path/to/file/error.log', 'wb');

/* GLOBAL Params */
set_time_limit(0);
ini_set('memory_limit', '-1');
ini_set('display_errors',true);
date_default_timezone_set('America/New_York');
include '/var/www/path/to/file/conn.php';

// `Image` column used as an example
$query = "SELECT * FROM `TABLE_NAME` WHERE `Image` =''";

if ($result = mysqli_query($dblink, $query)) {
	while ($row = mysqli_fetch_assoc($result)) {
	$source = $row['Source'];
	$srcArray[] = $source;
	}	
	$count = count($srcArray);
	echo date("d")."\n";
	echo date("m/d/Y h:i:s a", time()). "\n";	
	echo 'Empty Images: '. $count. "\n";
	print_r(array_count_values($srcArray));
}
mysqli_free_result($result);
mysqli_close($dblink);
?>
