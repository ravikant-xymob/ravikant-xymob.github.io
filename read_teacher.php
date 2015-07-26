<?php
require("dbconnection.php");

$college=$_REQUEST['college'];
$dept=$_REQUEST['dept'];
$sem=$_REQUEST['sem'];
$sid=$_REQUEST['sid'];

$sql = "SELECT * FROM teachers where college='$college' and department='$dept' and sem=$sem;";
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
