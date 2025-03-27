<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ChillOut foglalás</title>
	<link rel="stylesheet" type="text/css" href="static/css/foglalas_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="scripts/js/foglalas.js"></script>
	<script src="scripts/js/nyelv.js"></script>
</head>
<body>
	<div id="menu_hatter" style="display:none; "></div>
	<div id="menu" style="display: none;">
		<div id="iksz"></div>
		<div style="margin-top:100px;width: 100%;height: calc(100% - 100px);display: flex;flex-direction: column;">
			<div class="menu_pont_design"><input type="checkbox" name="dark_mode" id="dark_mode"><label for="dark_mode">Sötét Mód / Dark Mode</label></div>
			<div class="lang-container menu_pont_design">
				<div style="display:flex;align-items: center;">
					<div style="width: 40px;height: 40px;display: flex;justify-content: center;align-items: center;"><img src="static/images/Hungary.png" class="flag"></div>
					<span style="color:white;">Nyelv változtatása / Change language</span>
				</div>
			</div>
		</div>
	</div>
	<header>
		<div id="felirat_hatter"></div>
		<div id="head_left">
			<div id="felirat">ChillOut.hu</div>
		</div>
		<div id="head_right">
			<div id="settings">
				<span id="kerek">
					<img id="kerek_img" src="static/images/settings_gear.png">
				</span>
			</div>
		</div>
	</header>
	
	<div id="full" style="overflow-x: scroll;">
		<form action="save.php" method="post" enctype="multipart/form-data">
			<div style="width:100%;height:70px;display:flex;justify-content: center;">
				<h1 data-key="foglalas">Foglalás</h1>
			</div>

			<div id="info_div">
				<div id="apartman_info">
					<div id="apartman_kep_div">
						<div id="apartman_kep"></div>
					</div>
					<div id="apartman_naptar_div">
						<div id="apartman_naptar">
							<iframe id="naptar" src=""></iframe>
						</div>
					</div>
				</div>
				
				<div id="option_div">
					<input type="date" name="mettol" id="mettol" style="display:none;" required>
					<input type="date" name="meddig" id="meddig" style="display:none;" required>

					<script type="text/javascript">
						sessionStorage.setItem("starterDate", null);
						sessionStorage.setItem("endingDate", null);
						document.getElementById("mettol").value = sessionStorage.getItem("starterDate");
						document.getElementById("meddig").value = sessionStorage.getItem("endingDate");

						const loadDate = () => {
							if (sessionStorage.getItem("starterDate") != "null" && sessionStorage.getItem("endingDate") != "null") {
								document.getElementById("mettol").value = sessionStorage.getItem("starterDate");
								document.getElementById("meddig").value = sessionStorage.getItem("endingDate");
							} else {
								alert("no date *magemind face*")
							}
						}
					</script>

					<div class="option" >
						<span data-key="vezeteknev">Vezetéknév:</span>
						<input type="text" name="vez-name" required>
					</div>
					<div class="option" >
						<span data-key="utonev">Utónév:</span>
						<input type="text" name="uto-name" required>
					</div>
					<div class="option">
						Email:
						<input type="email" name="email" placeholder="youremail@gmail.com" required></div>
					<div class="option">
						<span data-key="telefonszam">Telefonszám:</span>
						<input type="tel" name="phone-number" required></div>
					<div class="option" >
						<span data-key="orszag">Ország:</span>
						<input type="text" name="orszag" required></div>
					<div class="option">
						<span data-key="iranyitoszam">Irányítószám:</span>
						<input type="text" name="irsz" required></div>
					<div class="option">
						<span data-key="telepules">Település:</span>
						<input type="text" name="telepules" required></div>
					<div class="option">
						<span data-key="utca-hazszam">Utca, házszám:</span>
						<input type="text" name="lakcim" required>
					</div>
					<div style="display:flex; justify-content: space-evenly;">
						<div class="age">
							<span data-key="felnott">Felnőtt:</span>
							<input max="15" min="1" class="szemely" type="number" name="felnott" required>
						</div>
						<div class="age">
							<span data-key="gyerek">Gyerek:</span>
							<input max="15" class="szemely" type="number" name="gyerek" required>
						</div>
					</div>
					<div style="display:flex; justify-content:center;align-items: center;">
						<span data-key="apartman">Apartman:</span>
						<select id="apartman_select">
							<option id="default_option" value="0" data-key="def-apartman-option">--Válasz apartmant--</option>
							<option id="apartman_1" value="1" data-key="apartman-1">Tinódi apartman</option>
							<option id="apartman_2" value="2" data-key="apartman-2">Chill apartman</option>
						</select>
						<input type="hidden" name="apartman" id="apartman">
					</div>
					<div class="option-plus">
						<span data-key="uzenet">Üzenet:</span><br>
						<textarea class="uzenet"></textarea>
					</div>
				</div>
			</div>
			<div id="leadas">
				<input type="submit" value="Leadás" onclick="loadDate()">
			</div>
		</form>
	</div>

</body>
</html>
