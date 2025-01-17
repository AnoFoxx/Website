<?php 
	$foglalt_szin = "rgb(247 178 165)";
	$foglalo_szin = "rgb(186 244 255)";
 ?>

<head>
	<link rel="stylesheet" href="naptar.css">
</head>
<body>
	<div class="naptar-container">
		<?php 
			$honapok = array("zero", "Január", "Február", "Március", "Április", "Május", "Június", "Július", "Agusztus", "Szeptember", "Október", "November", "December");
			$elozo_honap_napok_kihagyas = array(6, 0, 1, 2, 3, 4, 5);
			
			if (isset($_GET["ev"]) && isset($_GET["ho"])) {
				$honap = date("m", strtotime("01.".$_GET["ho"].".".$_GET["ev"]));
				$ev = date("Y", strtotime("01.".$_GET["ho"].".".$_GET["ev"]));
				
				$kov_honap = date("m", strtotime("01.".$_GET["ho"].".".$_GET["ev"]." +1 month"));
				$kov_ev = date("Y", strtotime("01.".$_GET["ho"].".".$_GET["ev"]." +1 month"));

				$elozo_honap = date("m", strtotime("01.".$_GET["ho"].".".$_GET["ev"]." -1 month"));
				$elozo_ev = date("Y", strtotime("01.".$_GET["ho"].".".$_GET["ev"]." -1 month"));
			} else {
				$ev = date("Y");
				$honap = date("m");

				$kov_honap = date("m", strtotime("01.".date("m").".".date("Y")." +1 month"));
				$kov_ev = date("Y", strtotime("01.".date("m").".".date("Y")." +1 month"));
				
				$elozo_honap = date("m", strtotime("01.".date("m").".".date("Y")." -1 month"));
				$elozo_ev = date("Y", strtotime("01.".date("m").".".date("Y")." -1 month"));
			}

			$honap_napok_szama = cal_days_in_month(CAL_GREGORIAN, $honap, $ev);
			$honap_elso_napja = date("w", strtotime("$ev-$honap-01"));
			
			$elozo_honap_nap_szam =  cal_days_in_month(CAL_GREGORIAN, date("m", strtotime("-1 month")), date("Y", strtotime("-1 month")));
			$elozo_honap_megjelenitendo_napok = $elozo_honap_nap_szam - $elozo_honap_napok_kihagyas[$honap_elso_napja] + 1;

			$napszam = 1 - $elozo_honap_napok_kihagyas[$honap_elso_napja];
		 ?>
		<div class="naptar-header">
			<a href="<?php echo "naptar.php?ev=$elozo_ev&ho=$elozo_honap" ?>">
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
								<div data-year='$ev' data-month='$honap' data-day='$napszam' class='naptar-nap naptar-szamozott-nap'>
									<b style='z-index:0.9; color:".(($napszam < date("d")) ? "#777" : (($napszam == date("d")) ? "#00C510" : "black")).";'>
										$napszam
									</b>
									<div style='position: absolute; width: 100%; height: 100%;'>
										<svg style='width: 100%; height: 100%; ' viewBox='0 0 100 100'>
							";
								// Logged in user által foglalt első nap
								if ($temp1 == 0) 
									echo "<polygon points='10,0 100,0 100,100 10,100 40,50' style='fill: $foglalo_szin;'/>";

								// Logged in user által foglalt teljes nap
								else if ($temp1 == 1) 
									echo "<polygon points='0,0 100,0 100,100 0,100' style='fill: $foglalo_szin;'/>";

								// Logged in user által foglalt utolsó nap
								else if ($temp1 == 2) 
									echo "<polygon points='0,0 10,0 41,50 10,100 0,100' style='fill: $foglalo_szin;'/>";

								// Más user által foglalt első nap
								if ($temp2 == 0) 
									echo "<polygon points='10,0 100,0 100,100 10,100 40,50' style='fill: $foglalt_szin;'/>";

								// Más user által foglalt teljes nap
								else if ($temp2 == 1) 
									echo "<polygon points='0,0 100,0 100,100 0,100' style='fill: $foglalt_szin;'/>";

								// Más user által foglalt utolsó nap
								else if ($temp2 == 2) 
									echo "<polygon points='0,0 10,0 41,50 10,100 0,100' style='fill: $foglalt_szin;'/>";

								// // Mai nap jelzése
								// if (mktime(0, 0, 0, $honap, $napszam, $ev) == mktime(0, 0, 0, date("m"), date("d"), date("Y")))
								// 	echo "<circle cx='51' cy='49' r='30' fill='#00C510'/>";	
							echo "
										</svg>
									</div>
								</div>
							";
						} else {
							echo "<div class='naptar-nap' style='background-color:#fff;'></div>";
						}
						
						if ($napszam <= $honap_napok_szama) $napszam++;
						
					}
					echo "</div>";
				}
			 ?>
		</div>
	</div>
	<script src="naptar.js"></script>
</body>
