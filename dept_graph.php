
<?php
require("dbconnection.php");

$college=$_REQUEST['college'];
$dept=$_REQUEST['dept'];
$sem=$_REQUEST['sem'];
//result variables
$totalMarksInSingleField=20;
$totalmarks=$totalMarksInSingleField*4;

$sql="select teachers.teacher_name,((avg(feedback.obtained_marks)/'$totalmarks')*100)as percent
from feedback inner join teachers on feedback.teacher_id=teachers.teacher_id and teachers.college='$college' and teachers.department='$dept' and teachers.sem='$sem' group by feedback.teacher_id;";
$result = mysql_query( $sql, $conn );
$response=array();
$response[]=array('Teacher','Percent');
if(!$result){
	$row=array();
	$row['error']="NO_RESULT";
}else{
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$response[]=array("{$row['teacher_name']}",floatval($row['percent']));
	
	}
}
//echo json_encode($response);

?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
		  var js_array=<?php echo json_encode($response);?>;
		 
				alert(js_array);
        var data = google.visualization.arrayToDataTable(js_array);

        var options = {
          title: 'Department Performance Graph',
          is3D: true,
        };

        var chart = new google.visualization.BarChart(document.getElementById('piechart_3d'));
        // Wait for the chart to finish drawing before calling the getImageURI() method.
      google.visualization.events.addListener(chart, 'ready', function () {
        
        console.log(chart.getImageURI()+"");
      });
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </body>
</html>
