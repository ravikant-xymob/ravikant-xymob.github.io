<?php
require("dbconnection.php");
$heading=$_REQUEST['head'];
$detail=$_REQUEST['detail'];
$base64Str=$_REQUEST['image64'];
$when=$_REQUEST['date'];

$response=array();

		//not duplicate insert fresh data
		$sql="insert into notice_board (head,detail,image64,date) values('$heading','$detail','$base64Str','$when')";
		$retval = mysql_query( $sql, $conn );

		if($retval)
		{
			$response['result']="success";
		}else{
			$response['result']="fail";
			}

echo json_encode($response);

mysql_close($conn);
?>
