<?php
session_start();
require("dbconnection.php");

$college=$_REQUEST['college'];
$dept=$_REQUEST['dept'];
$sid=$_REQUEST['sid'];

$response=array();
$row=array();

if($sid!=session_id())
{
	$row['error']="SESSION_EXPIRED";
}else{
	//check for duplicacy
	$csql="select * from departments where department='$dept' and college='$college';";
	$cresult=mysql_query( $csql, $conn );
	$crow=mysql_fetch_array($cresult, MYSQL_ASSOC);
	if($crow!=null){
		$row['result']="ALREADY_EXISTS";
	}else {
		//not duplicate insert fresh data
		$sql="insert into departments (department,college) values('$dept','$college')";
		$retval = mysql_query( $sql, $conn );

		if($retval)
		{
			$row['result']="ADDED";
		}
	}

}
$response[]=$row;
echo json_encode($response);

mysql_close($conn);
?>