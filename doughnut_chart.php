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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doughnut Chart</title>
    <script type="text/javascript" src="chart.js"></script>
</head>
<body>
    <div class="container mt-4">
        <nav class="navbar navbar-light bg-light mb-4">
            <span class="navbar-brand mb-0 h1 mt-4"> New Cases Covid 19</span>
        </nav>
      
            <!-- diagram garis akan kita tampilkan disini -->
        <canvas id="myChart"></canvas>
    </div>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(
            ctx,{
                type:'doughnut',
                data:{
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
					labels: 'New Cases',
					data: <?php echo json_encode($kbaru); ?>,
                    backgroundColor:[
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
					borderColor: 'rgba(0,0,2,1)',
					borderWidth: 1
				}
               
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Doughnut Chart'
                        }
                    }
                }
            }
        );
    </script>
</body>
</html>
