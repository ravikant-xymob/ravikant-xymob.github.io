<?php
require("dbconnection.php");

$user=$_REQUEST['user'];
$pwd=$_REQUEST['pwd'];
$sql = "SELECT * FROM users where college='$user' and pwd='$pwd' limit 1;";
//echo $sql;
$retval = mysql_query( $sql, $conn );
if(!$retval )
{
  die('Could not get data: ' . mysql_error());
}
session_start();
$response=array();
$row = mysql_fetch_array($retval, MYSQL_ASSOC);
if($row!=null){
$row['session_id']=session_id();
$response[]=$row;

}else {
	$row=array();
	$row['error']="LOGIN_FAILED";
	$response[]=$row;
}
echo json_encode($response);
mysql_close($conn);
?>