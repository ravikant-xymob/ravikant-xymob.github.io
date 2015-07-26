<?php
session_start();
require("dbconnection.php");
$teacher_name=$_REQUEST['tname'];
$college=$_REQUEST['college'];
$dept=$_REQUEST['dept'];
$sem=$_REQUEST['sem'];
$sid=$_REQUEST['sid'];

$response=array();
$row=array();

if($sid!=session_id())
{
	$row['error']="SESSION_EXPIRED";
}else{
	//check for duplicacy
	$csql="select * from teachers where teacher_name='$teacher_name' and college='$college' and department='$dept' and sem='$sem';";
	$cresult=mysql_query( $csql, $conn );
	$crow=mysql_fetch_array($cresult, MYSQL_ASSOC);
	if($crow!=null){
		$row['result']="ALREADY_EXISTS";
	}else {
		//not duplicate insert fresh data
		$sql="insert into teachers (teacher_name,college,department,sem) values('$teacher_name','$college','$dept','$sem')";
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