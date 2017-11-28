<?php
	
	include_once "DBC.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$date = $_POST["date"];
		$month = $_POST["month"];
		$year = $_POST["year"];
		$thietbi = $_POST["thietbi"];
		$chedoxem = $_POST["chedoxem"];
	}
	class Data{};

	if ($chedoxem == "ngay"){

		$array = [];

		for ($i=0; $i < 23; $i++) { 
			$sql = "SELECT AVG(data_humid) AS data_humid_avr, AVG(data_temp) AS data_temp_avr, AVG(data_pin) AS data_pin_avr, AVG(data_pressure) AS data_pressure_avr FROM `thong-tin-di-dong`.`data` WHERE `device_imei` = '$thietbi' AND `hour` = '$i' AND `data_date` = '$date' AND `data_month` = '$month' AND `data_year` = '$year';";	

			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
			    while($row = mysqli_fetch_assoc($result)) {
					$data = new Data();
					$data->hour = $i;
					$data->temp = $row["data_temp_avr"];
					$data->press = $row["data_pressure_avr"];
					$data->humid = $row["data_humid_avr"];
					array_push($array, json_encode($data));
			    }
			}
		}

		header("Content-type:application/json"); 
		echo json_encode($array);
	}

	if ($chedoxem == "thang"){
		$sql = "SELECT * FROM `thong-tin-di-dong`.`data_month` WHERE `device_imei` = '$thietbi' AND `data_month` = '$month' AND `data_year` = '$year';";

		$result = mysqli_query($conn, $sql);
		$array = [];

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result)) {
		        $data = new Data();
		        $data->date = $row["data_date"];
		        $data->temp = $row["data_temp"];
		        $data->press = $row["data_pressure"];
		        $data->humid = $row["data_humid"];
		        array_push($array, json_encode($data));
		    }
		}
		 
		header("Content-type:application/json"); 
		echo json_encode($array);
	}		

	if ($chedoxem == "nam"){
		$sql = "SELECT * FROM `thong-tin-di-dong`.`data_year` WHERE `device_imei` = '$thietbi' AND `data_year` = '$year';";

		$result = mysqli_query($conn, $sql);
		$array = [];

		if (mysqli_num_rows($result) > 0) {
		    while($row = mysqli_fetch_assoc($result) > 0) {
		        $data = new Data();
		        $date->month = $row ["data_month"];
		        $data->temp = $row["data_temp"];
		        $data->press = $row["data_pressure"];
		        $data->humid = $row["data_humid"];
		        array_push($array, json_encode($data));		        
		    }
		}
		 
		header("Content-type:application/json"); 
		echo json_encode($array);
	}

	mysqli_close($conn);
?>