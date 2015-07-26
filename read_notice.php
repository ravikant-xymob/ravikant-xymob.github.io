<?php
require("dbconnection.php");

$sql = "SELECT id,head,detail,date FROM notice_board;";
$result = mysql_query( $sql, $conn );
$response=array();
if(!$result){
	$response['result']="fail";
}else{
	$response['result']="success";
	$data=array();
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$data[]=$row;
	
	}
	$response['noticelist']=$data;
}
echo json_encode($response);

?>
