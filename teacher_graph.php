
<?php
require("dbconnection.php");

$tid=$_REQUEST['tid'];

$sql="select teachers.teacher_name as name,sum(feedback.audible) as audible,sum(feedback.teaching) as teaching,sum(feedback.punctual) as punctual,sum(feedback.helpful) as helpful
from feedback inner join teachers on feedback.teacher_id=teachers.teacher_id and feedback.teacher_id='$tid' group by feedback.teacher_id;";
$result = mysql_query( $sql, $conn );
$response=array();
$response[]=array('Skill','Marks');
$tname=null;
if(!$result){
	$row=array();
	$row['error']="NO_RESULT";
}else{
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	if(isset($row))
	{
		$tname=$row['name'];
		$response[]=array("audible",floatval($row['audible']));
		$response[]=array("teaching",floatval($row['teaching']));
		$response[]=array("punctual",floatval($row['punctual']));
		$response[]=array("helpful",floatval($row['helpful']));
	
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
          title: "<?php echo strtoupper($tname);?> Performance Graph",
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
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
