<?php
$dbhost = 'localhost:3036';
$dbuser = 'root';
$dbpass = 'ravikant';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db('feedback_db');
?>