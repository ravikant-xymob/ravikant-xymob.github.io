<?php
session_start();
require("dbconnection.php");

$t_id=$_REQUEST['tid'];
$aud=$_REQUEST['audible'];
$teach=$_REQUEST['teaching'];
$punc=$_REQUEST['punctual'];
$help=$_REQUEST['helpful'];
$comm=$_REQUEST['comment'];
$sid=$_REQUEST['sid'];
//compute total obtained marks
$obtained=$aud+$teach+$punc+$help;
$response=array();
$row=array();

if($sid!=session_id())
{
	$row['error']="SESSION_EXPIRED";
}else{
	
		$sql="insert into feedback (teacher_id,audible,teaching,punctual,helpful,comment,obtained_marks) values('$t_id','$aud','$teach','$punc','$help','$comm','$obtained')";
		$retval = mysql_query( $sql, $conn );

		if($retval)
		{
			$row['result']="ADDED";
		}
	

}
$response[]=$row;
echo json_encode($response);

mysql_close($conn);
?>
