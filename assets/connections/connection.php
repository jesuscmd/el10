<?php

/*
 * DATABASE CONNECTION
 */

// DATABASE: Connection variables
$db_host		= "localhost";
$db_name		= "appel10_el10";
$db_username	= "appel10_el10";
$db_password	= "eldiez";

// DATABASE: Try to connect
if (!$db_connect = mysql_connect($db_host, $db_username, $db_password))
	die('Unable to connect to MySQL.');
if (!$db_select = mysql_select_db($db_name, $db_connect))
	die('Unable to select database');
mysql_set_charset('utf8',$db_connect);
//mysql_query ("SET NAMES 'utf8'");

$result = mysql_query("SELECT * FROM menu order by precio ASC");?>