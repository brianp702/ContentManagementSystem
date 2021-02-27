<?php
function db_connect()
{
$hostname='jiggapayne.db.6826316.hostedresource.com';
$username='jiggapayne';
$password='Obsolet3';
$dbname='jiggapayne';

$con = mysql_connect($hostname,$username, $password);
mysql_connect($hostname,$username, $password) OR DIE ('Unable to connect to database.');
mysql_select_db($dbname);
}
?>