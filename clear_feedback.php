
<?php
session_start();
require("dbconnection.php");

$college=$_REQUEST['college'];

$response=array();
$row=array();

if(false)
{
	$row['error']="SESSION_EXPIRED";
}else{
	
		$sql = "DELETE feedback FROM feedback INNER JOIN teachers ON feedback.teacher_id = teachers.teacher_id and teachers.college='$college'";
		$retval = mysql_query( $sql, $conn );

		if($retval)
		{
			$row['result']="feedback for college ".$college." cleared";
		}

}
$response[]=$row;
echo json_encode($response);

mysql_close($conn);
?>
