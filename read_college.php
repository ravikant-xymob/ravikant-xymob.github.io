<?php
require("dbconnection.php");

$sql = "SELECT college FROM users;";
$result = mysql_query( $sql, $conn );
$response=array();

if(!$result){
	$row=array();
	$row['error']="NO_RESULT";
	$response[]=$row;
}else{
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
		$response[]=$row;
	
	}
}
echo json_encode($response);

?>
