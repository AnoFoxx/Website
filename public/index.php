<!DOCTYPE html>
<html lang="hu">
<?php 
	include "scripts/php/error_handeler.php";
	define("SVG_ONLY", false);

	$apartman_1_image_dir_path = "static/images/apartman_1_kepek";
	$apartman_2_image_dir_path = "static/images/apartman_2_kepek";
	$apartman_3_image_dir_path = "static/images/apartman_3_kepek";
	$images_dir = "static/images";

	try {
 ?>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="ChillOut Apartman's official website">
	<meta name="keywords" content="chill, chillout, apartman, Hajdúszoboszló, ChillOut-Hajdúszoboszló, Tinódi, Tinódi utca">
	<meta name="author" content="Papp Bence Attila, Hőzső Attila Pál">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
	<link rel="stylesheet" type="text/css" href="static/css/style_mobile.css">
	<!-- Pre load images START -->
	<?php 
		function list_images($dir_path) {

			$images = [];
			$recursive_iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir_path));

			foreach ($recursive_iterator as $file) {
				if ($file->isFile()) {
					$file_path = $file->getPathname();
					if (SVG_ONLY) {
						if (strpos($file_path, ".svg")) $images[] = $file_path;
					} else {
						$images[] = $file_path;
					}
				}
			}

			return $images;
		}

		foreach (list_images($images_dir) as $image) {
			echo "<link rel='preload' as='image' href='$image'>";
		}
	
	
	 ?>
	<!-- Pre load images END -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="scripts/js/img_load.js"></script>
	<script src="scripts/js/main.js"></script>
	<script src="scripts/js/nyelv.js"></script>
	<title>ChillOut</title>
<script>

</script>
</head>
<body>
	<div class="galeria_background" style="display:none; z-index: 3;">
		<img src="" class="galeria_big_img" style="z-index:3;">
	</div>
	<div id="full" style="z-index: 1;" class="flex j-center a-i-center wid-vw hei-vh">
		<div id="oldalso">
			<div id="lenyulo" class="flex j-center a-i-center">
				<span id="ikon">&#9776;</span>
			</div>
			<div id="fo_menu" style="display:none;" class="absol">
				<div class="menu relat flex a-i-center wid" id="menu_fooldal" data-key="menu-fooldal">Főoldal</div>
				<div class="menu relat flex a-i-center wid" id="menu_apartmanok" data-key="menu-apartmanok">Apartmanok</div>
				<div class="menu relat flex a-i-center wid" id="menu_informacio" data-key="menu-informacio">Informáicók</div>
				<div class="menu relat flex a-i-center wid" id="menu_galeria" data-key="menu-galeria">Galéria</div>
				<div class="menu relat flex a-i-center wid" id="menu_ertekeles" data-key="menu-ertekeles">Értékelések</div>
			</div>
		</div>
			
		

		<div class="foscroll relat wid hei-vh">
			<div id="fooldal" class="scroll_pont flex j-center a-i-center relat wid hei-vh">
				<div style="display: flex;justify-content: center;align-items: center;z-index: 1;position: absolute;width: 50%;height: 20vh;background-color: rgba(255, 255, 255, 0.7);filter: blur(10px); border-radius:50px;"></div>
				<div id="udvozles_hatter">
					<p id="udvozles" class="flex j-center a-i-center absol" data-key="udvozles">Üvözlünk a ChillOut apartman weboldalán</p>
				</div>
				<img id="fo_kep" class="wid-vw hei-vh" draggable="false" src="static/images/chillout_tinodi_outside.jpg">
				<header id="menu_sor" class="flex a-i-center absol wid">
					<div id="bc" class="absol wid"></div>

					<div id="first_half" class="flex a-i-center">
						<div id="logo"></div>
						<div id="felirat" class="j-center a-i-center">ChillOut.hu</div>
					</div>

					<div id="second_half" class="flex a-i-center">

						<div>
							<div id="settings" style="display: none;">
								<span id="kerek">
									<img src="static/images/settings_gear.png">
								</span>
							</div>
							<div style="display: none;">
								
							</div>
						</div>
						<div id="lang-container" class="menu_pont_hatter hover_item flex j-center a-i-center"><div id="language" class="menu_pont flex j-center a-i-center"><img class="flag" src="static/images/Hungary.png"></div></div>

						<!--Elerhetőségek-->
						<div class="flex j-center">
							<div id="support_icon" class="menu_pont_hatter hover_item elerhet_vis flex j-center a-i-center"><div id="support" class="menu_pont elerhet_vis flex j-center a-i-center">?</div></div>

							<div id="elerheto" class="elerhet_vis flex j-center a-i-center absol" style="display:none;">
								<span class="elerhet_vis">suliproject@gmail.com</span>
								<span class="elerhet_vis">+36705384254</span>
								<a href="https://www.facebook.com/p/ChillOut-Apartman-100063457207712/" class="elerhet_vis"><img id="facebook" src="https://upload.wikimedia.org/wikipedia/en/thumb/0/04/Facebook_f_logo_%282021%29.svg/512px-Facebook_f_logo_%282021%29.svg.png?20210818083032">Facebook</a>
							</div>
						</div>
						<div class="j-center flex">
							<div id="foglal" class="hover_item menu_pont_hatter flex j-center a-i-center">
								<div class="menu_pont_foglalas flex j-center a-i-center">
									<span data-key="foglalas">Foglalás</span>
								</div>
							</div>
						</div>
						
						
					</div>
				</header>
			</div>

			<!-- Apartman -->
			<div id="apartmanok" class="scroll_pont flex relat wid hei-vh j-center a-i-center">
				<div class="accent-bg"></div>
				<div id="apartmanok-bg" class="wid-vw hei-vh"></div>
				<div id="apartman_tinodi" class="apartman flex j-center">
					<!--<div style="display: block;background-color: rgba(0,0,0,0.3);" class="apartman_bg wid hei absol" ></div>Hover megoldása-->
					<div class="felirat flex j-center a-i-center wid" style="z-index:2;"data-key="tinodi-felirat">Tinódi Apartman</div>
					
					<div style="background-image: url(static\\images\\apartman_1_kepek\\tinodi_0.svg);background-size: cover;background-repeat: no-repeat;background-position: center;display: flex;" class="apartman_div wid hei">

						<div id="tinodi_div" class="apartman_div_tav flex a-i-center wid hei">	
							<div class="wid flex" style="height:50%;">
								<div class="apartman_div_box flex relat hei a-i-center j-center accent_hide" style="display:none;">
									<button class="bal_nyil">&#10094;</button>
									<div id="tinodi_kep_show" class="mozgo_kep accent_hide point">
										<?php 
											foreach (list_images($apartman_1_image_dir_path) as $image) {
												echo "<img src='$image' class='tinodi_kep'>";
											}
										 ?>
									</div>
									<button class="jobb_nyil">&#10095;</button>
								</div>

								<div class="apartman_div_leir hei accent_hide">
									<div style="width:100%;height: 50%;">
										<span data-key="tinodi-leir">blu blu</span>
									</div>
								</div>
							</div>

							<div style="height: 50%;" class="wid flex relat accent_hide">
								<div class="apartman_div_box hei flex a-i-center j-center">
									<div id="tinodi_terkep" class="a-i-center j-center terkep flex relat accent_hide">
										<div style="width:100%;aspect-ratio:1/1;">
											<iframe loading="eager" src="http://maps.google.hu/maps?q=Magyarország, 4200 Hajdúszoboszló, Tinódi utca 7.&iwloc=A&output=embed"></iframe>
										</div>
									</div>
								</div>
								<div class="apartman_div_box hei">
									<div class="flex a-i-center j-center">
										<div class="naptar relat accent_hide">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="apartman_garazs" class="apartman flex j-center">
					<div class="felirat flex j-center a-i-center wid"data-key="chill-felirat">Chill Apartman</div>
					<div style="background-image: url(static\\images\\apartman_2_kepek\\chill_0.svg);background-size: cover;background-repeat: no-repeat;background-position: 10%; display: flex;" class="apartman_div wid hei">
						<div id="garazs_div" class="apartman_div_tav flex a-i-center wid hei">	
							<div class="wid flex" style="height:50%;">
								<div class="apartman_div_box flex relat hei a-i-center j-center accent_hide" style="display:none;">
									<button class="bal_nyil">&#10094;</button>
									<div id="garazs_kep" class="mozgo_kep accent_hide point">
										<?php 
										
											foreach (list_images($apartman_2_image_dir_path) as $image) {
												echo "<img src='$image' class='chill_kep'>";
											}
											
										 ?>
									</div>
									<button class="jobb_nyil">&#10095;</button>
								</div>

								<div class="apartman_div_leir hei accent_hide">
									<div style="width:100%;height: 50%;">
										<span data-key="chill-leir">blu blu</span>
									</div>
								</div>
							</div>

							<div style="height: 50%;" class="wid flex relat accent_hide">
								<div class="apartman_div_box hei flex a-i-center j-center">
									<div id="chill_terkep" class="a-i-center j-center terkep flex relat accent_hide">
										<div style="width:100%;aspect-ratio:1/1;">
											<iframe loading="eager" src="http://maps.google.hu/maps?q=Magyarország, 4200 Hajdúszoboszló, Bartók Béla utca 14.&iwloc=A&output=embed"></iframe>
										</div>
									</div>
								</div>
								<div class="apartman_div_box hei">
									<div class="flex a-i-center j-center">
										<div class="naptar relat accent_hide">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<!-- Elérhetőségek -->
			<div id="informacio" class="scroll_pont flex relat wid hei-vh">
				<img src="static/images/cool-background_2.png" class="wid hei absol" style="z-index:0;">
				<div id="belso_eler" style="z-index:1;" class="flex wid">
					<div id="info_felirat" class="flex j-center a-i-center wid">
						<h1 data-key="info-felirat">Az apartmanokról</h1>
					</div>
					<div id="informaciok" class="flex wid">
						<div id="teszt_1" class="flex j-center a-i-center hei">
							<div id="leiras" data-key="ossz_informacio">
								bla bla bla bla bla bla
							</div>
						</div>
						<div  id="teszt_2" class="flex j-center a-i-center hei">
							<div class="info_apart flex relat hei">
								<div class="info_hatter absol wid hei" style="background-color:rgba(232,89,217,1.0);	border-radius: 50px 0 0 50px;filter: drop-shadow(-2mm 1mm 4mm rgba(232,89,217,1.0))"></div>
								<div class="info_apart_felirat flex j-center a-i-center wid">
									<h4 data-key="tinodi-info-leir">Tinódi Apartman</h4>
								</div>
								<div class="info_apart_elerheto wid"></div>
							</div>
							<div class="info_apart flex relat hei">
								<div class="info_hatter absol wid hei" style="background-color: rgba(77,98,180,1.0);	border-radius: 0 50px 50px 0;filter: drop-shadow(2mm 1mm 4mm rgba(77,98,180,1.0))"></div>
								<div class="info_apart_felirat flex j-center a-i-center wid">
									<h4 data-key="chill-info-leir">Chill Apartman</h4>
								</div>
								<div class="info_apart_elerheto wid"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="galeria" class="scroll_pont flex relat wid hei-vh">

				<div style="width: 100%;height: 100%;display: flex;justify-content: center;">
					<img src="static/images/cool-background.png" class="wid hei absol" style="filter: blur(2px);">
					<div id="galeria_body" class="j-center a-i-center flex">
						<div id="galeria_felirat" class="j-center a-i-center flex wid">
							<h1 data-key="galeria">Galéria</h1>
						</div>
						<div id="galeria_scroll" class="flex" style="z-index:2;">
							<?php 
								$galeria_oszlop = array(
									0 => "<div class='galeria_container'>",
									1 => "<div class='galeria_container'>",
									2 => "<div class='galeria_container'>",
									3 => "<div class='galeria_container'>"
								);

								$i = 0;

								$apartman_dir_path_array = array($apartman_1_image_dir_path, $apartman_2_image_dir_path, $apartman_3_image_dir_path);
								foreach ($apartman_dir_path_array as $dir) {
									foreach (list_images($dir) as $image) {
										$i = $i % 4;
										$galeria_oszlop[$i] .= "<img  class='galeria_img lazy_toltes wid' src='$image'>";
										$i++;
									}
								}
								
								// div lezárás
								$galeria_oszlop[0] .= "</div>";
								$galeria_oszlop[1] .= "</div>";
								$galeria_oszlop[2] .= "</div>";
								$galeria_oszlop[3] .= "</div>";

								foreach ($galeria_oszlop as $oszlop) {
									echo $oszlop;
								}

							 ?>
						</div>
					</div>
				</div>
				
			</div>
			<div id="ertekeles" class="scroll_pont flex wid hei-vh">
			    <div class="flex j-center a-i-center" style="width: 100%; height: 100%; flex-wrap: wrap;">
			        <h1 data-key="ertekeles">Értékelések</h1>

			        <div id="ertekeles_body" class="flex a-c-center j-center wid">
			            <div id="ertekeles_sor" class="flex j-center a-i-center wid">
			            <!-- SABLON
			            	<div class="ertekeles_elem">
			            		<div class="ertekeles_fejlec flex wid">
			            			<span class="ertekeles_nev ertekeles_margin">Név</span>
			            			<span class="ertekeles_datedate ertekeles_margin">Dátum</span>
			            		</div>
			            		<div class="ertekeles_rate flex wid j-center a-i-center">
			            			Ide lesz behúzva a csillagok
			            		</div>
			            		<div class="ertekeles_szoveg flex wid j-center a-i-center">
			            			<span>Szöveg</span>
			            		</div>
			            	</div>
			            -->

			                <div class="ertekeles_elem">

			                    <div class="ertekeles_fejlec flex wid">
			                        <span class="ertekeles_nev ertekeles_margin">Név</span>
			                        <span class="ertekeles_date ertekeles_margin">Dátum</span>
			                    </div>

			                    <div class="ertekeles_rate flex wid j-center a-i-center">
			                        csillagok
			                    </div>

			                    <div class="ertekeles_szoveg flex wid j-center a-i-center">
			                        <span>szöveg</span>
			                    </div>

			                </div>




			                <div class="ertekeles_elem">
			                    <div class="ertekeles_fejlec flex wid">
			                        <span class="ertekeles_nev ertekeles_margin">Név</span>
			                        <span class="ertekeles_date ertekeles_margin">Dátum</span>
			                    </div>
			                    <div class="ertekeles_rate flex wid j-center a-i-center">
			                        csillagok
			                    </div>
			                    <div class="ertekeles_szoveg flex wid j-center a-i-center">
			                        <span>szöveg</span>
			                    </div>
			                </div>

			                <div class="ertekeles_elem">
			                    <div class="ertekeles_fejlec flex wid">
			                        <span class="ertekeles_nev ertekeles_margin">Név</span>
			                        <span class="ertekeles_date ertekeles_margin">Dátum</span>
			                    </div>
			                    <div class="ertekeles_rate flex wid j-center a-i-center">
			                        csillagok
			                    </div>
			                    <div class="ertekeles_szoveg flex wid j-center a-i-center">
			                        <span>szöveg</span>
			                    </div>
			                </div>
			                <div class="ertekeles_elem">
			                    <div class="ertekeles_fejlec flex wid">
			                        <span class="ertekeles_nev ertekeles_margin">Név</span>
			                        <span class="ertekeles_date ertekeles_margin">Dátum</span>
			                    </div>
			                    <div class="ertekeles_rate flex wid j-center a-i-center">
			                        csillagok
			                    </div>
			                    <div class="ertekeles_szoveg flex wid j-center a-i-center">
			                        <span>szöveg</span>
			                    </div>
			                </div>
			            </div>

			            <!-- Arrows for navigation -->
			            <div id="ertekeles_nyilak" class="arrows">
			                <span id="prev_review" class="nyil">←</span>
			                <span id="next_review" class="nyil">→</span>
			            </div>
			        </div>
			    </div>
			</div>


			<script src="scripts/js/carousel.js"></script>
			</div>
		</div>
<?php 
	} catch(Exeption $err) {
		log_error($err);
	}
 ?>
</body>
</html>
