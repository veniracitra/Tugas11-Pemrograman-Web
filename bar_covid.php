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
<!DOCTYPE html>
<html>
<head>
	<title>BAR CHART COVID</title>
	<script type="text/javascript" src="Chart.js"></script>
    <h1> Bar Covid-19</h1>
</head>
<body>
	<div style="width: 1200px;height: 1200px">
		<canvas id="myChart"></canvas>
	</div>
 
 
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
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
					label: 'Total Recovered',
					data: <?php echo json_encode($tsembuh); ?>,
                    backgroundColor: 'rgba(115, 255, 65, 0.2)',
					borderColor: 'rgba(127,146,99,1)',
					borderWidth: 1
				}, 
                {
                    label: 'Total Cases',
					data: <?php echo json_encode($tkasus); ?>,
					backgroundColor: 'rgba(300, 45, 255, 0.2)',
					borderColor: 'rgba(125,60,100,1)',
					borderWidth: 1   
                },
                {
                    label: 'New Cases',
					data: <?php echo json_encode($kbaru); ?>,
					backgroundColor: 'rgba(255, 20, 90, 0.2)',
					borderColor: 'rgba(150,88,110,1)',
					borderWidth: 1
                },
                 {
                    label: 'Total Deaths',
					data: <?php echo json_encode($tmati); ?>,
					backgroundColor: 'rgba(255, 0, 0, 0.2)',
					borderColor: 'rgba(255,21,22,1)',
					borderWidth: 1
                },
                { 
                    label: 'New Deaths',
					data: <?php echo json_encode($mbaru); ?>,
					backgroundColor: 'rgba(255, 182, 0, 0.2)',
					borderColor: 'rgba(190,100,65,1)',
					borderWidth: 1

                },
                 {
                    label: 'New Recovered',
					data: <?php echo json_encode($sbaru); ?>,
					backgroundColor: 'rgba(93, 40, 255, 0.2)',
					borderColor: 'rgba(93,132,158,1)',
					borderWidth: 1
                }
               

            ]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body> 
</html>
