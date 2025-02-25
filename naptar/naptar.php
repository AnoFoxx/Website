<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="naptar.css">
	<script src="naptar.js"></script>
</head>

<body>		
	<?php 
		$foglalt_szin = "rgb(247 178 165)";
		$foglalo_szin = "rgb(186 244 255)";
	?>
	<div class="naptar-container">
		<?php 
			$honapok = array("", "Január", "Február", "Március", "Április", "Május", "Június", "Július", "Agusztus", "Szeptember", "Október", "November", "December");
			$elozo_honap_napok_kihagyas = array(6, 0, 1, 2, 3, 4, 5);
			
			$ev = isset($_GET["ev"])
				? $_GET["ev"]
				: date("Y");
			$honap = isset($_GET["honap"])
				? $_GET["honap"]
				: date("m");
			$apartman = isset($_GET["apartman"])
				? $_GET["apartman"]
				: die("Error: No apartman was given");

			$kov_honap = date("m", strtotime("01.$honap.$ev +1 month"));
			$kov_ev = date("Y", strtotime("01.$honap.$ev +1 month"));
			
			$elozo_honap = date("m", strtotime("01.$honap.$ev -1 month"));
			$elozo_ev = date("Y", strtotime("01.$honap.$ev -1 month"));

			$honap_napok_szama = cal_days_in_month(CAL_GREGORIAN, $honap, $ev);
			$honap_elso_napja = date("w", strtotime("$ev-$honap-01"));
			
			$elozo_honap_nap_szam =  cal_days_in_month(CAL_GREGORIAN, date("m", strtotime("-1 month")), date("Y", strtotime("-1 month")));
			$elozo_honap_megjelenitendo_napok = $elozo_honap_nap_szam - $elozo_honap_napok_kihagyas[$honap_elso_napja] + 1;

			$napszam = 1 - $elozo_honap_napok_kihagyas[$honap_elso_napja];

		?>
		<div class="naptar-header">
			<!--  -->
			<button id="elozo_honap"><</button>
			<h3>
				<?php 
					echo $ev." ".$honapok[intval($honap)];
				 ?>
			</h3>
			<!--  -->
			<button id="kov_honap">></button>

			<script type="text/javascript">
				document.getElementById("elozo_honap").addEventListener("click", e => {
					log("<?php echo "".$_SERVER["PHP_SELF"]."?ev=$elozo_ev&honap=$elozo_honap" ?>");
					window.location.href = "<?php echo "".$_SERVER["PHP_SELF"]."?ev=$elozo_ev&honap=$elozo_honap&apartman=$apartman" ?>";

				});
				document.getElementById("kov_honap").addEventListener("click", e => {
					log("<?php echo "".$_SERVER["PHP_SELF"]."?ev=$kov_ev&honap=$kov_honap" ?>");
					window.location.href = "<?php echo "".$_SERVER["PHP_SELF"]."?ev=$kov_ev&honap=$kov_honap&apartman=$apartman" ?>";
				});
			</script>
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

				for ($i=0; $i < 6; $i++) { 
					echo "<div class='naptar-row'>";
					for ($j=0; $j < 7; $j++) { 
						if ($napszam > 0 && $napszam <= $honap_napok_szama && $napszam <= $honap_napok_szama) {
							echo " 
								<div class='naptar-nap naptar-szamozott-nap'>
							";
								if ($napszam < date("d") && $honap <= date("m") && $ev == date("Y") || $ev < date("Y") || $ev == date("Y") && $honap < date("m")) {
									echo "<span status='disabled' style='color:var(--light-gray);'>$napszam</span>";
								} else if ($napszam == date("d") && $honap == date("m") && $ev == date("Y")) {
									echo "<span status='enabled' data-year='$ev' data-month='$honap' data-day='$napszam' style='color:var(--deep-blue);'>
											$napszam
									     </span>";
								} else if ($honap >= date("m") || $ev >= date("Y")){
									echo "<span status='enabled' data-year='$ev' data-month='$honap' data-day='$napszam' style='color:var(--black);'>
											$napszam
										 </span>";
								}
							echo "
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
	<script type="text/javascript">
		// Rest api call
		const szamozottNaptarNapok = document.getElementsByClassName("naptar-szamozott-nap");
		fetch (<?php echo "'http://localhost/Website/api/rest.php?year=$ev&month=$honap&apartman=$apartman&token=3e0c89ad3cb8077143ee8eeeb1359587e1cc2aa2'"; ?>)
			.then(res => {
				if (!res.ok) throw new Error(res.message);
				return res.json();
			})
			.then(d => {
				if (!d.success) throw new Error(d.message);

				for (let i = 0; i < szamozottNaptarNap.length; i++) { 
					if (szamozottNaptarNap[i].firstElementChild.getAttribute("status") == "enabled") {
						// This is where the magic happens
					}
				}
			})
			.catch(err => console.error(`There was a problem with the fetch operation: ${err.message}`))

		

	</script>
</body>
