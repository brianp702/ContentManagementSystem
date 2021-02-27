<?php
function db_connect()
{
$hostname='.db.6826316.hostedresource.com';
$username='';
$password='';
$dbname='';

$con = mysql_connect($hostname,$username, $password);
mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database.');
mysql_select_db($dbname);
}
?>