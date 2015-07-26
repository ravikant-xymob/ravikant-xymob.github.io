<html>
<?php
require("dbconnection.php");

$college=$_REQUEST['college'];
echo "<title>$college Feedback Datasheet</title>";

$sql="select teachers.teacher_name as name,teachers.department as dept,feedback.audible as aud,feedback.teaching as teach,feedback.punctual as punc,feedback.helpful as help,feedback.obtained_marks as obtained,feedback.comment as comment
from feedback inner join teachers on feedback.teacher_id=teachers.teacher_id and teachers.college='$college';";
$result = mysql_query( $sql, $conn );
?>

<head>
<!-- Javascript goes in the document HEAD -->
<script type="text/javascript">
function altRows(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "evenrowcolor";
			}else{
				rows[i].className = "oddrowcolor";
			}      
		}
	}
}
window.onload=function(){
	altRows('alternatecolor');
}
</script>
</head>
<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
table.altrowstable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #a9c6c9;
	border-collapse: collapse;
}
table.altrowstable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.altrowstable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
.oddrowcolor{
	background-color:#d4e3e5;
}
.evenrowcolor{
	background-color:#c3dde0;
}
</style>


<?php
if(!$result){
	die("Could not generate datasheet<br>".mysql_error());
}else{
	echo "<body>";
	echo "<table class='altrowstable' id='alternatecolor'>";
	echo "<tr><th>Teacher Name</th><th>Department</th><th>Audible</th><th>Teaching</th><th>Punctual</th><th>Helpful</th><th>Obtained Marks</th><th>Comments</th></tr>";
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		echo "<tr><td>{$row['name']}</td>";
		echo "<td>{$row['dept']}</td>";
		echo "<td>{$row['aud']}</td>";
		echo "<td>{$row['teach']}</td>";
		echo "<td>{$row['punc']}</td>";
		echo "<td>{$row['help']}</td>";
		echo "<td>{$row['obtained']}</td>";
		echo "<td>{$row['comment']}</td></tr>";
	
	}
	echo "</table></body>";
}
?>


</html>
