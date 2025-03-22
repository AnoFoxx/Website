$(document).ready(function() {
	window.addEventListener('load',function(){
	if(window.innerWidth<=600){
		$(".accent-bg").css("z-index","1000000000000");
		$(".accent-bg-show").css("z-index","1000000000000");
	}
	else{
		$(".accent-bg").css("z-index","3");
		$(".accent-bg-show").css("z-index","3");
	}
	})
	window.addEventListener('resize',function(){
	if(window.innerWidth<=600){
		$(".accent-bg").css("z-index","1000000000000");
		$(".accent-bg-show").css("z-index","1000000000000");
	}
	else{
		$(".accent-bg").css("z-index","3");
		$(".accent-bg-show").css("z-index","3");
	}
	})

	loadUnifiedCarousel();

	// No more dynamic loading/unloading scripts
	function loadUnifiedCarousel() {
		if (!document.querySelector('script[src="scripts/js/carousel_ertekeles_combined.js"]')) {
			var script = document.createElement('script');
			script.src = 'scripts/js/carousel_ertekeles_combined.js';
			document.body.appendChild(script);
		}
	}
	$("#settings").click(function(){
		$("#settings").css("display","none");
		$("#settings_full").show(500);

	})
	
	//side-bar lenyitás és becsukás
	$("#lenyulo").click(function(){
	if($("#fo_menu").is(":hidden")){
		$("#lenyulo").show(500);
		$("#fo_menu").show(500);
		$("#ikon").css("transform","rotate(90deg)");
	}
	else{
		$("#fo_menu").hide(500);
		$("#ikon").css("transform","rotate(0deg)");
	}
	})

	//menu tájékozódás
	$(".menu").click(function() {
		var targetId = $(this).attr("id").replace("menu_", "");

		var targetElement = $("#" + targetId)[0];
			
		targetElement.scrollIntoView({
			behavior: "smooth",
			block: "start"
		});
	});

	$("#foglal").click(function(){
		window.location.href="foglalas.php";
	})

	$(".galeria_img").click(function () {
		let imgsrc = $(this).attr("src");
		$(".galeria_big_img").attr("src", imgsrc);
		$(".galeria_background").fadeIn();
	});

	$(".tinodi_kep, .chill_kep").click(function () {
		let imgsrc = $(this).attr("src");
		$(".galeria_big_img").attr("src", imgsrc);
		$(".galeria_background").fadeIn();
	});

	$(".galeria_background").click(function (a) {
		if (!$(a.target).is(".galeria_big_img")) {
			$(".galeria_background").fadeOut();
		}
	});

	$("#galeria_nyil").click(function(){
		$("#galeria_scroll").toggleClass("nyomott");
		$("#galeria_nyil").toggleClass("nyomott");
	
	})
	document.addEventListener("click", e =>{

	if(!(e.target.classList.contains("elerhet_vis"))){
		$("#elerheto").hide(500);
	}
	})

	$("#support_icon").click(function(){
	if($("#elerheto").is(":visible")){
		$("#elerheto").hide(500);
	}
	else{
		$("#elerheto").show(500);
	}
	
	})

	
});
