<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "chart";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// Close connection
$conn->close();
?>

<html>
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

var data = google.visualization.arrayToDataTable([
['Players Name', 'No.of.wickets'],
<?php
$sql = "SELECT * FROM contribution";
$fire = mysqli_query($con,$sql);

while ($result = mysqli_fetch_assoc($fire)) {
echo"['".$result['players']."',".$result['wickets']."],";
}

?>
]);

var options = {
title: 'PLAYERS CONTRIBUTION'
};

var chart = new
google.visualization.PieChart(document.getElementById('piechart'));

chart.draw(data, options);
}
</script>
</head>
<body>
<div id="piechart" style="width: 900px; height: 500px;"></div>
</body>
</html>


//Sample modification for new workflow test

