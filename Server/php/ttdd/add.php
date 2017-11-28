
<?php 

	include_once "DBC.php";
	set_time_limit (1000000);

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	  $userEmail = test_input($_POST["userEmail"]);
	  $userPassword = test_input($_POST["userPassword"]);

	  $deviceIMEI = test_input($_POST["deviceIMEI"]);
	  $deviceName = test_input($_POST["deviceName"]);
	  $humid = test_input($_POST["humid"]);
	  $temp = test_input($_POST["temp"]);
	  // $time = test_input($_GET["time"]);
	  $second = test_input($_POST["second"]);
	  $minute = test_input($_POST["minute"]);
	  $hour = test_input($_POST["hour"]);
	  $date = test_input($_POST["date"]);
	  $month = test_input($_POST["month"]);
	  $year = test_input($_POST["year"]);
	  $coord = test_input($_POST["coord"]);
	  $pin = test_input($_POST["pin"]);
	  $pressure = test_input($_POST["pressure"]);
	  $milliseconds_current = test_input($_POST["milliseconds_current"]);
	}
	
	$truyvan = "SELECT * FROM `thong-tin-di-dong`.`user` WHERE `user_email` = '$userEmail';";
	$ketqua = mysqli_query($conn, $truyvan);
	if (mysqli_num_rows($ketqua) > 0){
		while($row = mysqli_fetch_assoc($ketqua)) {
			$passwd = $row["user_password"];
			if ($userPassword != $passwd) {
				exit();
			}
		}
	}

	// check device
	$check_device = "SELECT * FROM `thong-tin-di-dong`.device where device_imei = '$deviceIMEI' and user_email = '$userEmail';";
	$result_check_device = mysqli_query($conn, $check_device);
	if (mysqli_num_rows($result_check_device) == 0) {
	$add_device = "INSERT INTO `thong-tin-di-dong`.`device` (`device_imei`, `device_name`, `user_email`) VALUES ('$deviceIMEI', '$deviceName', '$userEmail');";
	mysqli_query($conn, $add_device);
	}

	$query = "INSERT INTO `thong-tin-di-dong`.`data` (`device_imei`, `data_humid`, `data_temp`, `hour`, `minute`, `second`, `data_date`, `data_month`, `data_year`, `data_coordi`, `data_pin`, `data_pressure`) VALUES ('$deviceIMEI', '$humid', '$temp', '$hour', '$minute', '$second', '$date', '$month', '$year', '$coord', '$pin', '$pressure');";
	mysqli_query($conn, $query);

	if ($hour == 23){
		//check if db has already updated
		$query_check = "SELECT * FROM `thong-tin-di-dong`.data_month where data_date = '$date' and data_month = '$month' and data_year = '$year' and device_imei = '$deviceIMEI';";
		$result_query_check = mysqli_query($conn,$query_check);
		if (mysqli_num_rows($result_query_check) > 0) {
			exit();
		}
		$query_1 = "SELECT AVG(data_humid) AS data_humid_avr, AVG(data_temp) AS data_temp_avr, AVG(data_pin) AS data_pin_avr, AVG(data_pressure) AS data_pressure_avr FROM `thong-tin-di-dong`.`data` WHERE `data_date` = '$date' AND `data_month` = '$month' AND `data_year` = '$year' AND `device_imei`='$deviceIMEI'";

		$result_2month = mysqli_query($conn, $query_1);

		$query_2 = "";

		if (mysqli_num_rows($result_2month) > 0) {
			while($row = mysqli_fetch_assoc($result_2month)) {
				$data_humid_avr = $row["data_humid_avr"];
				$data_temp_avr = $row["data_temp_avr"];
				$data_pin_avr = $row["data_pin_avr"];
				$data_pressure_avr = $row["data_pressure_avr"];
				$query_2 = "INSERT INTO `thong-tin-di-dong`.`data_month` (`device_imei`, `data_humid`, `data_temp`, `data_date`, `data_month`, `data_year`, `data_coordi`, `data_pressure` , `data_pin`) VALUES ('$deviceIMEI', '$data_humid_avr', '$data_temp_avr', '$date', '$month', '$year', '$coord', '$data_pressure_avr' , '$data_pin_avr');";
			
			}
			mysqli_query($conn, $query_2);
		}

	}

	if ($hour == 0){
		$milliseconds_current = $milliseconds_current - 4000000;
		$seconds = $milliseconds_current / 1000;

		$month_last = date("m", $seconds);
		$year_last = date("Y", $seconds);	

		if ($month != $month_last){		

			// check xem đã update chưa

			$query_check = "SELECT * FROM `thong-tin-di-dong`.data_year where data_month = '$month' and data_year = '$year' and device_imei = '$deviceIMEI';";
			$result_query_check = mysqli_query($conn, $query_check);

			if (mysqli_num_rows($result_query_check) < 1){
				$query_3 = "SELECT AVG(data_humid) AS data_humid_avr, AVG(data_temp) AS data_temp_avr, AVG(data_pin) AS data_pin_avr, AVG(data_pressure) AS data_pressure_avr FROM `thong-tin-di-dong`.`data_month` WHERE `data_month` = $month_last AND `data_year` = $year_last";
			
				$result_2year = mysqli_query($conn, $query_3);
				$query_4 = "";

				if (mysqli_num_rows($result_2year) > 0) {
					while($row = mysqli_fetch_assoc($result_2year)) {

					$data_humid_avr = $row["data_humid_avr"];
					$data_temp_avr = $row["data_temp_avr"];
					$data_pin_avr = $row["data_pin_avr"];
					$data_pressure_avr = $row["data_pressure_avr"];

					$query_4 = "INSERT INTO `thong-tin-di-dong`.`data_year` (`device_imei`, `data_humid`, `data_temp`, `data_month`, `data_year`, `data_coordi`, `data_pressure`, `data_pin`) VALUES ('$deviceIMEI', '$data_humid_avr', '$data_temp_avr', '$month_last', '$year_last', '$coord', '$data_pressure_avr', '$data_pin_avr');";
					}
				}
				mysqli_query($conn, $query_4);
			}
		}		
	}

	function test_input($data) {
	  $data = trim($data); 
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	mysqli_close($conn);

 ?>
