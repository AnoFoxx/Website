<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ChillOut foglalás</title>
	<link rel="stylesheet" type="text/css" href="static/css/foglalas_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="scripts/js/foglalas.js"></script>
</head>
<body>
	<div id="menu_hatter" style="display:none; "></div>
	<div id="menu" style="display: none;">
		<div id="iksz"></div>
		<div style="margin-top:100px;width: 100%;height: calc(100% - 100px);justify-content: center;align-content: center; display: flex;">
			<div class="menu_pont_design"><input type="checkbox" name="dark_mode" id="dark_mode"><span>Sötét Mód</span></div>
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
	<style type="text/css">
		.option{
			padding
			flex-direction: row;
			display: flex;
			justify-content: space-between;
			align-items: center;
			height: 70px;
			width: 450px;
			margin-bottom: 10px;
		}
		.option input{
			padding-left: 10px;
			font-size: 20px;
			width: 300px;
			height: 50px;
			border-radius: 50px;
		}
	</style>
	<div id="full" style="overflow-x: scroll;">
		<div style="width:1050px; height: 1050px; background-color: rgba(0, 0, 0, 0.3); margin-top: 30px; display: flex;justify-content: flex-start; flex-direction: column; border-radius: 50px;">
			<div style="width:100%;height:70px;display:flex;justify-content: center;"><h1>Foglalás</h1></div>

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
					<div class="option">Vezetéknév:<input type="text" name="vez_name"></div>
					<div class="option">Utónév:<input type="text" name="uto_name"></div>
					<div class="option">Email:<input type="email" name="email" placeholder="youremail@gmail.com"></div>
					<div class="option">Telefonszám:<input type="tel" name="phone_number"></div>
					<div class="option">Ország:<input type="text" name="orszag"></div>
					<div>
						<div class="option">Ir.szám:<input type="text" name="irszam"></div>
						<div class="option">Település:<input type="text" name="telepules"></div>
					</div>
					<div class="option">Város:<input type="text" name="varos"></div>
					<div class="option">Utca, házszám:<input type="text" name="lakcim"></div>
					<div style="display:flex; justify-content: space-evenly;">
						<div class="age">Felnőtt:<input max="15" min="1" class="szemely" type="number" name="felnot"></div>
						<div class="age">Gyerek:<input max="15" class="szemely" type="number" name="gyerek"></div>
					</div>
					<div style="display:flex; justify-content:center;align-items: center;">
						Apartman:<select id="apartman_select">
							<option id="default_option">--Válasz apartmant--</option>
							<option id="apartman_1">Tinódi apartman</option>
							<option id="apartman_2">Chill apartman</option>
							<option id="apartman_3">Chill apartman + 1 szoba</option>
						</select>
					</div>
				</div>
			</div>
			<div id="leadas">
				<input type="submit" name="leadas" value="Leadás">
			</div>
		</div>
	</div>

</body>
</html>
