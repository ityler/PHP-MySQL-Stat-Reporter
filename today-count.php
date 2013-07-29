#!/usr/local/bin/php
<?php
/**** MySQL Stat Reporter ****/
/** Checks todays DB stats for reporting **/
/**** Tyler Normile ****/ 

/* File handlers */
fclose(STDIN);
fclose(STDOUT);
fclose(STDERR);
$STDIN = fopen('/dev/null', 'r');
$STDOUT = fopen('/var/www/path/to/file/dailyTotal.log', 'wb');
$STDERR = fopen('/var/www/path/to/file/error.log', 'wb');

/* GLOBAL Params */
set_time_limit(0);
ini_set('memory_limit', '-1');
ini_set('display_errors',true);
date_default_timezone_set('America/New_York');
include '/var/www/path/to/file/conn.php';

// using `CreateDate` column as a point of reference example
$query = "SELECT * FROM `TABLE_NAME` WHERE `CreateDate` >= now() - INTERVAL 1 DAY;";

// using `Source` column as an example to sort data
if ($result = mysqli_query($dblink, $query)) {
        while ($row = mysqli_fetch_assoc($result)) {
        $source = $row['Source'];
        $srcArray[] = $source;
        }
        $count = count($srcArray);
        echo date("m/d/Y h:i:s a", time()). "\n";
        echo 'Today\'s Records: '. $count. "\n";
	asort($srcArray);
	print_r(array_count_values($srcArray));
}
mysqli_free_result($result);
mysqli_close($dblink);
?>

