<?php 
	header("Access-Control-Allow-Origin: *");  // Allow all domains to access
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  // Allowed HTTP methods
	header("Access-Control-Allow-Headers: Content-Type, Authorization");  // Allowed headers
	$connection = mysqli_connect("localhost", "root", "", "chillout_apartman") or die("Unable to connect to db");
	
	(isset($_GET["year"]))
		? $year = $_GET["year"]
		: die("No year was given");

	(isset($_GET["month"]))
		? $month = $_GET["month"]
		: die("No month was given");

	(isset($_GET["apartman"]))
		? $apartman = $_GET["apartman"]
		: die("No apartman was given");

	$sql = "
		SELECT 
		    CASE 
		        WHEN YEAR(foglalas.mettol) = $year AND MONTH(foglalas.mettol) = $month
		        THEN CONCAT(foglalas.mettol)
		        ELSE NULL 
		    END AS mettol,
		    CASE 
		        WHEN YEAR(foglalas.meddig) = $year AND MONTH(foglalas.meddig) = $month 
		        THEN CONCAT(foglalas.meddig)
		        ELSE NULL 
		    END AS meddig
		FROM foglalas
		WHERE foglalas.idApartman = $apartman;
	";


	$query = mysqli_query($connection, $sql);
	$data = array();
	$d = array();

	while ($sor = mysqli_fetch_array($query)) {
		$d["mettol"] = $sor["mettol"];
		$d["meddig"] = $sor["meddig"];
		array_push($data, $d);
	}
	echo json_encode($data);

 ?>