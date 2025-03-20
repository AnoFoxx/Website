<?php 
	include "scripts/php/error_handeler.php";

	function sanitize_post_data($data, $is_email=0) {
		$data = trim($data); // leadig/traling whitespace-ek
		$data = stripslashes($data);
		$data = htmlspecialchars($data); // XSS támadás kivédése

		// Ha email megengedjük az @-et
		if ($is_email)
			$data = preg_replace("/[^a-zA-Z0-9\s\.,!?\-@]/", "", $data);
		else
			$data = preg_replace("/[^a-zA-Z0-9\s\.,!?\-]/", "", $data);

		return $data;
	}

	try {
		$adatok = array();

		if (isset($_POST["vez-name"]))
			$adatok["vez-name"] = sanitize_post_data($_POST["vez-name"]);
		else throw new Exception("Vezetéknév nem lett megadva");

		if (isset($_POST["uto-name"]))
			$adatok["uto-name"] = sanitize_post_data($_POST["uto-name"]);
		else throw new Exception("Utónév nem lett megadva");

		if (isset($_POST["email"])) {
			$email = sanitize_post_data($_POST["email"], $is_email=1);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				throw new Exception("Érvénytelen email cím");
			}
			$adatok["email"] = $email;
		}
		else throw new Exception("Email cím nem lett megadva");

		if (isset($_POST["phone-number"])) {
			$phone_number = sanitize_post_data($_POST["phone-number"]);
			
			if (!preg_match("/^[+0-9\s\(\)-]*$/", $phone_number)) {
				throw new Exception("Érvénytelen telefonszám");
			}
			$adatok["phone-number"] = $phone_number;
		}
		else throw new Exception("Telefon szám nem lett megadva");

		if (isset($_POST["orszag"]))
			$adatok["orszag"] = sanitize_post_data($_POST["orszag"]);
		else throw new Exception("Ország nem lett megadva");

		if (isset($_POST["irsz"]))
			$adatok["irsz"] = sanitize_post_data($_POST["irsz"]);
		else throw new Exception("Irányítószám nem lett megadva");

		if (isset($_POST["telepules"]))
			$adatok["telepules"] = sanitize_post_data($_POST["telepules"]);
		else throw new Exception("Település nem lett megadva");

		if (isset($_POST["lakcim"]))
			$adatok["lakcim"] = sanitize_post_data($_POST["lakcim"]);
		else throw new Exception("Lakcím nem lett megadva");

		if (isset($_POST["felnott"]))
			$adatok["felnott"] = sanitize_post_data($_POST["felnott"]);
		else throw new Exception("Felnőttek száma nem lett megadva");

		if (isset($_POST["gyerek"]))
			$adatok["gyerek"] = sanitize_post_data($_POST["gyerek"]);
		else throw new Exception("Gyerekek száma nem lett megadva");

		if (isset($_POST["mettol"]))
			$adatok["mettol"] = sanitize_post_data($_POST["mettol"]);
		else throw new Exception("Mettől dátum nem lett megadva");

		if (isset($_POST["meddig"]))
			$adatok["meddig"] = sanitize_post_data($_POST["meddig"]);
		else throw new Exception("Meddig dátum nem lett megadva");

		echo var_dump($adatok);
		
	} catch (Exception $error) {
		log_error($error);
	}

 ?>