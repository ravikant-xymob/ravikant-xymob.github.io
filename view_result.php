<?php
require("dbconnection.php");

$college=$_REQUEST['college'];
$dept=$_REQUEST['dept'];
$sem=$_REQUEST['sem'];

$sql="select feedback.teacher_id,teachers.teacher_name,feedback.comment,((avg(feedback.obtained_marks)/20)*100)as percent
from feedback inner join teachers on feedback.teacher_id=teachers.teacher_id and teachers.college='$college' and teachers.department='$dept' and teachers.sem='$sem' group by feedback.teacher_id;";
$result = mysql_query( $sql, $conn );
$response=array();
if(!$result){
	$row=array();
	$row['error']="NO_RESULT";
}else{
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$response[]=$row;
	
	}
}
echo json_encode($response);

?>
