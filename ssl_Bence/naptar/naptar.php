<head>
	<style type="text/css">
		
		:root {
			--naptar-width: 100vw;
			--naptar-height: 100vh;
			--naptar-nap-size: calc(var(--naptar-height) / 9);
		}
		body {
			margin: 0;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.naptar-container {
			width: var(--naptar-width);
			height: var(--naptar-height);
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}
		.naptar-napok-container {
			width: calc(var(--naptar-width) - 13px);
			height: calc(var(--naptar-height) - var(--naptar-nap-size) - 15px);
		}
		.naptar-row {
			display: flex;
			flex-direction: row;
			width: calc(var(--naptar-width) - 11px);

		}
		.naptar-header {
			height: var(--naptar-nap-size);
			width: calc(var(--naptar-width) - 11px);;
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			align-items: center;
		}

		.naptar-nap {
			width: var(--naptar-nap-size);
			height: var(--naptar-nap-size);
			display: flex;
			align-items: center;
			justify-content: center;
			border: 1px solid black;
			margin: 1px;
		}

		button {
			height: 25px;
			width: 25px;
			margin: 0 5px;
		}
	</style>
</head>
<body>
	<div class="naptar-container">
		<?php 
			$honapok = array("zero", "Január", "Február", "Március", "Április", "Május", "Június", "Július", "Agusztus", "Szeptember", "Október", "November", "December");
			$elozo_honap_napok_kihagyas = array(6, 0, 1, 2, 3, 4, 5);
			
			$ev = (isset($_GET["ev"])) ? $_GET["ev"] : date("Y");
			$honap = (isset($_GET["ho"])) ? $_GET["ho"] : date("m");

			$honap_napok_szama = cal_days_in_month(CAL_GREGORIAN, $honap, $ev);
			$honap_elso_napja = date("w", strtotime("$ev-$honap-01"));
			
			$elozo_honap_nap_szam =  cal_days_in_month(CAL_GREGORIAN, date("m", strtotime("-1 month")), date("Y", strtotime("-1 month")));

			$napszam = 1 - $elozo_honap_napok_kihagyas[$honap_elso_napja];
		 ?>
		<div class="naptar-header">
			<button <?php echo "onclick=\"javascript:window.location.href('naptar.php?ev=&ho=')\"" ?>><</button>
			<h3>
				<?php 
					echo $ev." ".$honapok[intval($honap)];
				 ?>
			</h3>	
			<button>></button>
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
						if ($napszam > 0 && $napszam <= $honap_napok_szama) echo "<div class='naptar-nap'>$napszam</div>";
						else echo "<div class='naptar-nap'></div>";

						if ($napszam <= $honap_napok_szama) $napszam++;
					}
					echo "</div>";
				}
			 ?>
		</div>
	</div>
</body>