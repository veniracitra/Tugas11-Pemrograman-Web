<?php
include('koneksi.php');
$sql = mysqli_query($koneksi,"SELECT * FROM tb_covid");
while($row = mysqli_fetch_array($sql)){
	$query = mysqli_query($koneksi,"SELECT * FROM tb_covid WHERE id_negara='".$row['id_negara']."'");
	$row = $query->fetch_array();
    $tsembuh[]  = $row["total_recovered"];
	$tkasus[]  = $row["total_cases"];
    $kbaru[]    = $row["new_cases"];
    $tmati[]    = $row["total_deaths"];
    $mbaru[]    = $row["new_deaths"];
    $sbaru[]    = $row["new_recovered"];

}

?>
<!doctype html>
<html>
 
<head>
	<title>Pie Chart</title>
	<h2> New Cases Covid-19</h2>
	<script type="text/javascript" src="Chart.js"></script>
</head>
 
<body>
	<div id="canvas-holder" style="width:50%">
		<canvas id="chart-area"></canvas>
	</div>
	<script>
		var config = {
			type: 'pie',
			data: {
				labels:[
                        "India",
                        "South Korea",
                        "Turkey",
                        "Vietnam",
                        "Japan",
                        "Iran",
                        "Indonesia",
                        "Malaysia",
                        "Thailand",
                        "Israel"
                    ],
				datasets: [{
					data:<?php echo json_encode($tkasus); ?>,
					label: "Total Recovered",
					backgroundColor: [
                    'rgba(10, 255, 132, 0.4)',
					'rgba(54, 162, 235, 0.4)',
					'rgba(255, 206, 86, 0.4)',
					'rgba(75, 192, 0, 0.4)',
                    'rgba(80, 200, 150, 0.4)',
                    'rgba(0, 99, 196, 0.4)',
                    'rgba(200, 162, 140, 0.4)',
                    'rgba(50, 0, 100, 0.4)',
                    'rgba(100, 206, 255, 0.4)',
                    'rgba(0, 132, 120, 0.4)',
					],
					borderColor: 'rgba(0,0,0,1)',}
			]},
			options: {
				responsive: true
			}
		};
 
		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};
 
		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});
 
			window.myPie.update();
		});
 
		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var newDataset = {
				backgroundColor: [],
				data: [],
				label: 'New dataset ' + config.data.datasets.length,
			};
 
			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());
 
				var colorName = colorNames[index % colorNames.length];
				var newColor = window.chartColors[colorName];
				newDataset.backgroundColor.push(newColor);
			}
 
			config.data.datasets.push(newDataset);
			window.myPie.update();
		});
 
		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myPie.update();
		});
	</script>
</body>
 
</html>
