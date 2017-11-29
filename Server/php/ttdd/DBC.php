
<?php

	$servername = "localhost";
	$username = "root";
	$password = "Javafirst";
	$port = 3307;
	$dbname	= "thong-tin-di-dong";
	$serverhost = "http://localhost";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
	mysqli_set_charset($conn, "utf-8");
?>