#!/usr/local/bin/php
<?php
/**** MySQL Stat Reporter ****/
/** DB stats for total records categorized and sorted by specific column **/
/**** Tyler Normile ****/ 

/* GLOBAL Params */
set_time_limit(0);
ini_set('memory_limit', '-1');
ini_set('display_errors',true);
date_default_timezone_set('America/New_York');
include '/var/www/path/to/file/conn.php';

$query = "SELECT * FROM `TABLE_NAME`";

// categorized by `source` column as axample
if ($result = mysqli_query($dblink, $query)) {
        while ($row = mysqli_fetch_assoc($result)) {
        $source = $row['Source'];
        $srcArray[] = $source;
        }
        $count = count($srcArray);
        echo date("m/d/Y h:i:s a", time()). "\n";
        echo 'Total Records: '. $count. "\n";
        asort($srcArray);
        print_r(array_count_values($srcArray));
}
mysqli_free_result($result);
mysqli_close($dblink);
?>

