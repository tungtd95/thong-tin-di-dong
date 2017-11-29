<?php

	session_start();
	if (!isset($_SESSION["user"])) {
		header("Location: login.php");
		exit();
	}
	include "DBC.php";
	$user_email = $_SESSION["user"];
	$query_device = "SELECT * FROM `thong-tin-di-dong`.device where user_email = '$user_email';";
	$result_device = mysqli_query($conn, $query_device);
	$array_device_name = [];
	$array_device_imei = [];
	if (mysqli_num_rows($result_device) > 0) {
		while($row = mysqli_fetch_assoc($result_device)) {
			array_push($array_device_imei, $row["device_imei"]);
			array_push($array_device_name, $row["device_name"]);
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Trang chủ</title>
	<link rel="stylesheet" href="css/home.css">

	<script type="text/javascript" src="js/Chart.js"></script>
	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>

</head>
<body>
	<div class="khoito">
		<div class="tren">
			<div class="tren1">
				<a href="MAIN_PAGE.html">Trường Đại học Bách Khoa Hà Nội</a>
			</div>

			<div class="tren2">
				<img src="image/dtvt.png" alt="">
				<h1>Bài Tập lớn Thông tin di động</h1>
			</div>

			<div class="tren3">
				
			</div>
		</div>

		<div class="giua">
			<div class="trai">

				<label for="ngaymuonxem" class="cachdong chonthietbi">Ngày:</label>
				<input type="date" id="ngaymuonxem" >
				
				<br>

				<label for="thietbi" class="cachdong" >Thiết bị:</label>
				<select id="thietbi" name="thietbi">
					<?php
						for ($i = 0; $i < count($array_device_name); $i++) {
							$d = $array_device_name[$i];
							$d_imei = $array_device_imei[$i];
							echo ("<option value=\"$d_imei\">$d: $d_imei</option>");
						}
					?>	
				</select>
				<h2>Chọn chế độ xem:</h2>

				<br>

				<label for="ngay" class="radio">Ngày:</label> 			<input type="radio" id="ngay"  	name="loaidothi" value="ngay" checked="">	 <br>
				<label for="thang" class="radio">Tháng:</label> 		<input type="radio" id="thang"  name="loaidothi" value="thang" >			 <br>
				<label for="nam" class="radio">Năm:</label>				<input type="radio" id="nam"  	name="loaidothi" value="nam" >				 <br>

				<button class="button" id="nutbam">Vẽ đồ thị</button>

			</div>		<!-- end div trai -->

			<div class="phai chart-container" >

				<canvas id="myChart1" width="400" height="400"></canvas>

					<script>
							var myChart1;
							var ctx1 = document.getElementById("myChart1").getContext("2d");
							function drawData1(data, label, labels_axis) {
								myChart1 = new Chart(ctx1, {
								    type: 'line',
								    data: {
								        labels: labels_axis,
								        datasets: [{
								            label: label,
								            data: data,
								            backgroundColor: [
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)'
								            ],
								            borderColor: [
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)'
								            ],
								            borderWidth: 1
								        }]
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

							}

							function removeData(chart) {
							    var arr = chart.data.datasets[0].data;
							    var arr_label = chart.data.labels;
							    var l = arr.length;
								var l2 = arr_label.length;
							    for (var i = l-1; i >= 0; i--) {
							    	arr.pop();
							    }
								for (var i = l2 - 1; i >= 0; i--) {
									arr_label.pop();
								}
							    chart.update();
							}

							function addData(chart, data, labels) {
							    for (var i=0; i< data.length; i++) {
							    	chart.data.datasets[0].data.push(data[i]);
							    	chart.data.labels.push(labels[i]);
							    }
							    chart.update();
							}
												
					</script>
				

			</div>		<!-- end div phai -->

			<div class="phai chart-container" >

				<canvas id="myChart2" width="400" height="400"></canvas>

					<script>
							var myChart2;
							var ctx2 = document.getElementById("myChart2").getContext("2d");
							function drawData2(data, label, labels_axis) {
								myChart2 = new Chart(ctx2, {
								    type: 'bar',
								    data: {
								        labels: labels_axis,
								        datasets: [{
								            label: label,
								            data: data,
								            backgroundColor: [
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)'
								            ],
								            borderColor: [
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)'
								            ],
								            borderWidth: 1
								        }]
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

							}
												
					</script>
				

			</div>		<!-- end div phai -->

<div class="phai chart-container" >

				<canvas id="myChart3" width="400" height="400"></canvas>

					<script>
							var myChart3;
							var ctx3 = document.getElementById("myChart3").getContext("2d");
							function drawData3(data, label, labels_axis) {
								myChart3 = new Chart(ctx3, {
								    type: 'bar',
								    data: {
								        labels: labels_axis,
								        datasets: [{
								            label: label,
								            data: data,
								            backgroundColor: [
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)',
								                'rgba(255, 159, 64, 0.2)',
								                'rgba(255, 99, 132, 0.2)',
								                'rgba(54, 162, 235, 0.2)',
								                'rgba(255, 206, 86, 0.2)',
								                'rgba(75, 192, 192, 0.2)',
								                'rgba(153, 102, 255, 0.2)'
								            ],
								            borderColor: [
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(153, 102, 255, 1)',
								                'rgba(255, 159, 64, 1)',
								                'rgba(255,99,132,1)',
								                'rgba(54, 162, 235, 1)',
								                'rgba(255, 206, 86, 1)',
								                'rgba(75, 192, 192, 1)',
								                'rgba(153, 102, 255, 1)'
								            ],
								            borderWidth: 1
								        }]
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

							}
												
					</script>
				

			</div>		<!-- end div phai -->


		</div>				<!-- end div giua -->

		<div class="duoi">
			<a href=<?php echo "$serverhost/ttdd/logout.php"?> style="text-decoration: none;"><button class="thoat" id="logout">Log out</button></a>

		</div>
	</div>

	
	<script>

		document.getElementById("nutbam").addEventListener("click", myFunction);

		function myFunction(){
			var ngaymuonxem = document.getElementById("ngaymuonxem").value;
			var thietbi = document.getElementById("thietbi").value;
			var chedoxem = document.querySelector('input[name = "loaidothi"]:checked').value;

			var time = new Date(ngaymuonxem);
			var date = time.getDate();
            var month = time.getMonth() + 1;
            var year = time.getFullYear();

	        $.post("handle.php",
	        {
	          date: date,
	          month: month,
	          year: year,
	          thietbi: thietbi,
	          chedoxem: chedoxem
	        }, handleData);

	        function handleData(data, status) {
			// alert("Data: " + data + "\nStatus: " + status);
	            
	        	if (chedoxem == "ngay"){
		            var obj = JSON.parse("["+data+"]");
					var array_temp = [];
					var array_humid = [];
					var array_press = [];
					var labels = [];
					for (var i=0; i < obj.length; i++){		
						var counter = obj[i];
						array_temp.push(counter.temp);
						array_humid.push(counter.humid);
						array_press.push(counter.press);
						labels.push(counter.hour);
					}

					if (myChart1 == null) {
						drawData1(array_temp, "Nhiệt Độ", labels);
					} else {
						removeData(myChart1);
						addData(myChart1, array_temp, labels);
					}

					if (myChart2 == null) {
						drawData2(array_humid, "Độ ẩm", labels);
					} else {
						removeData(myChart2);
						addData(myChart2, array_humid, labels);
					}

					if (myChart3 == null) {
						drawData3(array_press, "Áp suất", labels);
					} else {
						removeData(myChart3);
						addData(myChart3, array_press, labels);
					}

	        	}

	        	if (chedoxem == "thang"){

		            var obj = JSON.parse("["+data+"]");
					var array_temp = [];
					var array_humid = [];
					var array_press = [];
					var labels = [];

					for (var i=0; i < obj.length; i++){		
						var counter = obj[i];
						array_temp.push(counter.temp);
						array_humid.push(counter.humid);
						array_press.push(counter.press);
						labels.push(counter.date);
					}
					if (myChart1 == null) {
						drawData(array_temp, "Nhiệt Độ", labels);
					} else {
						removeData(myChart1);
						addData(myChart1, array_temp, labels);
					}

					if (myChart2 == null) {
						drawData(array_humid, "Độ ẩm", labels);
					} else {
						removeData(myChart2);
						addData(myChart2, array_humid, labels);
					}

					if (myChart3 == null) {
						drawData(array_press, "Áp suất", labels);
					} else {
						removeData(myChart3);
						addData(myChart3, array_press, labels);
					}
	        	}

	        	if (chedoxem == "nam"){
		            var obj = JSON.parse("["+data+"]");
		            // alert(obj.length);
					var array1 = [];

					for (var i=0; i < obj.length; i++){		
						var counter = obj[i];
						array1.push(counter.temp);
					}
					if (myChart == null) {
						drawData(array1, "Nhiệt Độ");
					} else {
						removeData(myChart);
						addData(myChart, array1);	        		
		        	}
				}
	        }
		}
				

		
	</script>


</body>
</html>