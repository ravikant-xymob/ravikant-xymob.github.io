<?php
require("dbconnection.php");

$tid=$_REQUEST['tid'];
$sql = "delete FROM teachers where teacher_id='$tid';";
$result = mysql_query( $sql, $conn );
$response=array();
$row=array();
if(!$result){
	
	$row['error']="TEACHER_NOT_REMOVED";
}else{
	$row['result']="Teacher removed successfully";
}
$response[]=$row;
echo json_encode($response);

?>
