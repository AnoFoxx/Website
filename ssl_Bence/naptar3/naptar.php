<?php 
	session_start();
	$foglalt_szin = "rgb(247 178 165)";
	$foglalo_szin = "rgb(186 244 255)";
 ?>

<div class="naptar-container">
	<?php 
		$honapok = array("zero", "Január", "Február", "Március", "Április", "Május", "Június", "Július", "Agusztus", "Szeptember", "Október", "November", "December");
		$elozo_honap_napok_kihagyas = array(6, 0, 1, 2, 3, 4, 5);
		
		if (!isset($_SESSION["ev"])) $ev = $_SESSION["ev"];
		else $ev = date("Y");
		$honap = date("m");

		$kov_honap = date("m", strtotime("01.".date("m").".".date("Y")." +1 month"));
		$kov_ev = date("Y", strtotime("01.".date("m").".".date("Y")." +1 month"));
		
		$elozo_honap = date("m", strtotime("01.".date("m").".".date("Y")." -1 month"));
		$elozo_ev = date("Y", strtotime("01.".date("m").".".date("Y")." -1 month"));

		$honap_napok_szama = cal_days_in_month(CAL_GREGORIAN, $honap, $ev);
		$honap_elso_napja = date("w", strtotime("$ev-$honap-01"));
		
		$elozo_honap_nap_szam =  cal_days_in_month(CAL_GREGORIAN, date("m", strtotime("-1 month")), date("Y", strtotime("-1 month")));
		$elozo_honap_megjelenitendo_napok = $elozo_honap_nap_szam - $elozo_honap_napok_kihagyas[$honap_elso_napja] + 1;

		$napszam = 1 - $elozo_honap_napok_kihagyas[$honap_elso_napja];
	 ?>
	<div class="naptar-header">
		<a href="<?php  ?>">
			<button><</button>
		</a>
		<h3>
			<?php 
				echo $ev." ".$honapok[intval($honap)];
			 ?>
		</h3>	
		<a href="<?php echo "naptar.php?ev=$kov_ev&ho=$kov_honap" ?>">
			<button>></button>
		</a>
	</div>
	<div class="naptar-napok-container">
		
		<div class="naptar-row">
			<?php 
				$napok = array("H", "K", "Sze", "Cs", "P", "Szo", "V");
				for ($i=0; $i < count($napok); $i++) { 
					echo "<div class='naptar-nap'><h4>$napok[$i]</h4></div>";
				}
			 ?>
		</div>
		<?php 

			$temp1 = 3;
			$temp2 = 3;

			for ($i=0; $i < 6; $i++) { 
				echo "<div class='naptar-row'>";
				for ($j=0; $j < 7; $j++) { 
					if ($napszam > 0 && $napszam <= $honap_napok_szama && $napszam <= $honap_napok_szama) {
						echo " 
							<div class=\"naptar-nap naptar-szamozott-nap\">
						";
								// <b style='z-index:0.9; color:".(($napszam < date("d")) ? "" : (($napszam == date("d")) ? "#00C510" : "black")).";'>
								// 	$napszam
								// </b>
							if ($napszam < date("d") && $honap <= date("m") && $ev == date("Y") || $honap < date("m")  || $ev < date("Y")) {
								echo "<span status=\"disabled\" style=\"color:var(--light-gray);\">$napszam</span>";
							} else if ($napszam == date("d") && $honap == date("m") && $ev == date("Y")) {
								echo "<span status=\"enabled\" data-year=\"$ev\" data-month=\"$honap\" data-day=\"$napszam\" style=\"color:var(--deep-blue);\">$napszam</span>";
							} else if ($honap >= date("m") || $ev >= date("Y")){
								echo "<span status=\"enabled\" data-year=\"$ev\" data-month=\"$honap\" data-day=\"$napszam\" style=\"color:var(--black);\">$napszam</span>";
							}
						echo "
							</div>
						";
					} else {
						echo "<div class=\"naptar-nap\" style=\"background-color:#fff;\"></div>";
					}
					
					if ($napszam <= $honap_napok_szama) $napszam++;
					
				}
				echo "</div>";
			}
		 ?>
	</div>
</div>
<script src="naptar.js"></script>
