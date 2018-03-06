<?php
//connect.php
$server = 'localhost';
$username   = 'u125348db1';
$password   = '4g4MEMn0n';
$database   = 'u125348db1';
 
if(!mysql_connect($server, $username,  $password))
{
    exit('Error: could not establish database connection');
}
if(!mysql_select_db($database))
{
    exit('Error: could not select the database');
}
?>