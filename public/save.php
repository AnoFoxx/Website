<?php 
	include "scripts/php/error_handeler.php";
	include "scripts/php/sql.php";

	function sanitize_post_data($data, $is_email=0) {
		$data = trim($data); // leading/trailing whitespace
		$data = stripslashes($data);
		$data = htmlspecialchars($data); // XSS támadás kivédése

		// Ha email, megengedjük @ szimbólumt
		if ($is_email)
			$data = preg_replace("/[^a-zA-Z0-9\s\.,!?\-@öüóőúéáűíÖÜÓŐÚÁÉŰÍ]/", "", $data);
		else
			$data = preg_replace("/[^a-zA-Z0-9\s\.,!?\-öüóőúéáűíÖÜÓŐÚÉÁŰÍ]]/", "", $data);

		return $data;
	}

	try {
		$adatok = array();
		
		// POST adatok megtisztítása
		if (isset($_POST["orszag"]))
			$adatok["orszag"] = sanitize_post_data($_POST["orszag"]);
		else throw new Exception("Ország nem lett megadva");

		if (isset($_POST["telepules"]))
			$adatok["telepules"] = sanitize_post_data($_POST["telepules"]);
		else throw new Exception("Település nem lett megadva");
		
		if (isset($_POST["irsz"]))
			$adatok["irsz"] = sanitize_post_data($_POST["irsz"]);
		else throw new Exception("Irányítószám nem lett megadva");

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

		if (isset($_POST["lakcim"]))
			$adatok["lakcim"] = sanitize_post_data($_POST["lakcim"]);
		else throw new Exception("Lakcím nem lett megadva");

		if (isset($_POST["mettol"]))
			$adatok["mettol"] = sanitize_post_data($_POST["mettol"]);
		else throw new Exception("Mettől dátum nem lett megadva");

		if (isset($_POST["meddig"]))
			$adatok["meddig"] = sanitize_post_data($_POST["meddig"]);
		else throw new Exception("Meddig dátum nem lett megadva");

		if (isset($_POST["uzenet"]))
			$adatok["uzenet"] = sanitize_post_data($_POST["uzenet"]);
		else $adatok["uzenet"] = "";

		if (isset($_POST["gyerek"]))
			$adatok["gyerek"] = sanitize_post_data($_POST["gyerek"]);
		else throw new Exception("Gyerekek száma nem lett megadva");

		if (isset($_POST["felnott"]))
			$adatok["felnott"] = sanitize_post_data($_POST["felnott"]);
		else throw new Exception("Felnőttek száma nem lett megadva");

		if (isset($_POST["apartman"]))
			$adatok["apartman"] = sanitize_post_data($_POST["apartman"]);
		else throw new Exception("Az apartman nem lett megadva");

		$sql_query = new SQL_Query();
		
		$sql_query->begin_transaction();

		// Insert ország
		$sql = "INSERT INTO orszag (orszagNev) VALUES (?) ON DUPLICATE KEY UPDATE orszagNev = orszagNev;";
		$params = [ $adatok["orszag"] ];
		$last_id_orszag = $sql_query->query($sql, $params);

		/**
		 * Ha már létezik a táblában az érték azaz DUPLICATE KEY
		 * akkor az update nem rak be új A_I id-t ezért
		 * a LAST_INSERT_ID() nem helyes id-t ad vissza
		 * és csak így tudom megoldani az id-k megszerését
		*/

		if ($last_id_orszag == 0) { // Ha létezik utolsó insert id 0 lesz
			$check_query = "SELECT id FROM orszag WHERE orszagNev = ?";
			$check_params = [ $adatok["orszag"] ];
			$existing_row = $sql_query->query($check_query, $check_params);
			
			if ($existing_row) {
				$last_id_orszag = $existing_row[0]["id"];
			}
		}

		// Insert város
		$sql = "INSERT INTO varos (varosNev) VALUES (?) ON DUPLICATE KEY UPDATE varosNev = varosNev;";
		$params = [ $adatok["telepules"] ];
		$last_varos_id = $sql_query->query($sql, $params);

		if ($last_varos_id == 0) { // Ha létezik utolsó insert id 0 lesz
			$check_query = "SELECT id FROM varos WHERE varosNev = ?";
			$check_params = [ $adatok["telepules"] ];
			$existing_row = $sql_query->query($check_query, $check_params);
			
			if ($existing_row) {
				$last_varos_id = $existing_row[0]["id"];
			}
		}

		// Insert irányítószám
		$sql = "INSERT INTO irsz (irszam) VALUES (?) ON DUPLICATE KEY UPDATE irszam = irszam;";
		$params = [ $adatok["irsz"] ];
		$last_irsz_id = $sql_query->query($sql, $params);

		if ($last_irsz_id == 0) { // Ha létezik utolsó insert id 0 lesz
			$check_query = "SELECT id FROM irsz WHERE irszam = ?";
			$check_params = [ $adatok["irsz"] ];
			$existing_row = $sql_query->query($check_query, $check_params);
			
			if ($existing_row) {
				$last_irsz_id = $existing_row[0]["id"];
			}
		}

		// Insert varos_irsz kapcsoló tábla
		$sql = "INSERT INTO varos_irsz (idIrsz, idVaros) VALUES (?, ?);"; // Két városnak lehet uaz az irányítószáma
		$sql_query->query($sql, [ $last_irsz_id, $last_varos_id ]);

		// Insert foglalo adatok
		$sql = "INSERT INTO foglalo (vezetekNev, utoNev, email, telefonSzam, utca_hazSzam, idOrszag, idVaros) 
				VALUES (?, ?, ?, ?, ?, ?, ?);";
		$params = [ 
					$adatok["vez-name"],     $adatok["uto-name"], $adatok["email"],
					$adatok["phone-number"], $adatok["lakcim"],   $last_id_orszag,
				    $last_varos_id
		];
		
		$sql_query->query($sql, $params);

		// Insert foglalas adatok
		$sql = "INSERT INTO foglalas (mettol, meddig, uzenet, verified, gyerekSzam, felnottSzam, idApartman, idFoglalo) 
				VALUES (?, ?, ?, 0, ?, ?, ?, LAST_INSERT_ID());";
		$params = [
			$adatok["mettol"], $adatok["meddig"],  $adatok["uzenet"], 
			$adatok["gyerek"], $adatok["felnott"], $adatok["apartman"]
		];
		$sql_query->query($sql, $params);
		
		$sql_query->commit(); // Ha nincs hiba az INSERT-ben commit
		header("Location: index.php");

	} catch (Exception $error) {

		$sql_query->rollback(); // Ha hiba az INSERT-ben rollback
		log_error($error);
	}
?>
