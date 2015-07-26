<?php
require("dbconnection.php");
$post_id=$_REQUEST['id'];
$sql = "SELECT * FROM notice_board where id='$post_id' limit 1;";
$result = mysql_query( $sql, $conn );
$response=array();
if(!$result){
	$response['result']="fail";
}else{
	$response['result']="success";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$response['post']=$row;
	
	}
}
echo json_encode($response);

?>

