<?php

/**
 * @author kushbacon
 * @copyright 2011
 */
 
 /** error reporting */
error_reporting (E_ALL ^ E_NOTICE);

/** mysql shit */
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'xxxx';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die                      ('Error connecting to mysql');

$dbname = 'yourdbnamehere';
mysql_select_db($dbname);

/** functions */
function genRandomString() {
    $length = 10;
    $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";   
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;
}

?>