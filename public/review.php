 <!DOCTYPE html>
 <html>
 <head>
 	<title>Confirm</title>
 	<link rel="stylesheet" type="text/css" href="static/css/review_style.css">
 </head>
 <body>
 	<header>
 		<div style="background-color: rgba(0,0,0,0.5);width: 100%;height: 100%;position: absolute;"></div>
 		<div style="width:100%;height: 100%;z-index: 2;display: flex;align-items: center;justify-content: center;">
 			<div id="logo" style="background-color: transparent;">
			<div style="background-image: url(static\\images\\madar_logo.svg);background-color: none;background-repeat: no-repeat;background-position: center;background-size: cover;width: 100%;height: 100%;transform: rotate(20deg) scaleX(-1);"></div>
			</div>
			<div id="felirat" class="j-center a-i-center">ChillOut.hu</div>
 		</div>
 	</header>
 	<div style="width:100%;height: calc(100% - 100px);position: fixed;margin-top: 100px;display: flex;justify-content: center;align-items: center;">
 		<div style="width:70%;height: 90%;border-radius: 50px; border: 2px solid grey;background-color: rgba(0,0,0,0.3);display: flex;align-items: center;flex-direction: column;">
 			<div style="width: 70%;height: 25%;">
 				<span class="szoveg">Köszönjük, hogy a ChillOut-ot választotta!<br>Reméljük, hogy élvezte az élményt.<br>Kérjük, ossza meg velünk véleményét, hogy még jobbá tegyük szolgáltatásainkat!</span><br>
 				<span class="szoveg">Thank you for choosing ChillOut!<br>We hope you enjoyed your experience.<br>Please share your feedback with us so we can make our services even better!</span>
 			</div>
 			<div style="width:70%;height: 50%;">
 				<form style="width:100%;height: 100%;">
 					<div class="elem" style="width:100%;">Név/Name	<input id="name" type="text" name="name"></div>
 					<div id="rating">
 						<div class="review_box">
 							<input type="radio" id="star_1"	value="1" name="star_review">
							<label for="star_1"	class="star-label"></label>

							<input type="radio" id="star_2"	value="2" name="star_review">
							<label for="star_2" class="star-label"></label>

							<input type="radio" id="star_3"	value="3" name="star_review">
							<label for="star_3" class="star-label"></label>

							<input type="radio" id="star_4"	value="4" name="star_review">
							<label for="star_4" class="star-label"></label>

							<input type="radio" id="star_5"	value="5" name="star_review">
							<label for="star_5" class="star-label"></label>
 						</div>
 					</div>
 					<div class="elem_megjegyzes">
 						<span>Szívesen meghallgatnánk a véleményét!</span>
 						<span>/ We would love to hear your thoughts!</span><br>
 						<textarea id="comment"></textarea>
 					</div>
 				</form>
 			</div>

 		</div>
 	</div>
 </body>
 </html>
