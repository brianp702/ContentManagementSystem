<?php
function db_connect()
{
$hostname='localhost';
$username='bpayne';
$password='Obsolet3';
$dbname='test';

$con = mysql_connect($hostname,$username, $password);
mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database.');
mysql_select_db($dbname);
}
?>