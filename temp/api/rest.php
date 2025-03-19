<?php
	try {
		header("Access-Control-Allow-Origin: http://localhost/");  // Allow all domains to access
		// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  // Allowed HTTP methods
		header("Access-Control-Allow-Headers: Content-Type, Authorization");  // Allowed headers
		
		$connection = mysqli_connect("localhost", "root", "", "chillout_apartman");

		if (mysqli_connect_errno())
			throw new Exception("Unable to connect to db");

		if (isset($_GET["year"]))
			$year = $_GET["year"];
		else
			throw new Exception("No year was given");

		if (isset($_GET["month"]))
			$month = $_GET["month"];
		else
			throw new Exception("No month was given");

		if (isset($_GET["apartman"]))
			$apartman = $_GET["apartman"];
		else
			throw new Exception("No apartman was given");

		$sql = "
			SELECT 
				CASE 
					WHEN YEAR(foglalas.mettol) = $year AND MONTH(foglalas.mettol) = $month
					THEN foglalas.mettol
					ELSE NULL
				END AS mettol,
				CASE 
					WHEN YEAR(foglalas.meddig) = $year AND MONTH(foglalas.meddig) = $month
					THEN foglalas.meddig
					ELSE NULL
				END AS meddig
			FROM foglalas
			WHERE 
				foglalas.idApartman = $apartman
				AND YEAR(foglalas.mettol) = $year
				AND MONTH(foglalas.mettol) = $month;
		";


		$query = mysqli_query($connection, $sql);
		$data = array("success" => true);
		$d = array();

		while ($sor = mysqli_fetch_array($query)) {
			$d["mettol"] = $sor["mettol"];
			$d["meddig"] = $sor["meddig"];
			array_push($data, $d);
		}

		echo json_encode($data);

	} catch (Exception $err) {
		echo json_encode(array("success" => false, "message" => $err->getMessage()));
	}	
 ?>
