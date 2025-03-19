$(document).ready(function() {
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

	let parent_divId = null;
	let image = null;
	let indices = {
	    'apartman_tinodi': 0,
	    'apartman_garazs': 0/*,
	    'apartman_garazs_szoba': 0*/
	};

	$(".apartman").click(function() {
	    var id = this.id;
	    $(".apartman").css("height", "100%");
	    $(".apartman").addClass("background");
	    $("#apartmanok").css("z-index", "2");
	    $(".felirat").hide();
	    $(".accent-bg").addClass("accent-bg-show");
	    $(this).removeClass("background");
	    $(this).addClass("foreground");

	    if (indices[id] === undefined) {
	        indices[id] = 0;
	    }

	    if (id === 'apartman_tinodi' && indices[id] === 0) {
	        indices[id] = 0;
	        $("#apartman_tinodi").css("cursor", "default");
	        $("#apartman_tinodi .accent_hide").show();
	        $("#apartman_tinodi .apartman_div_box").addClass("megnyomott");
	        image = $(".tinodi_kep");
	        parent_divId = "#tinodi_div";
	        updateImage(id);
	    }

	    if (id === 'apartman_garazs' && indices[id] === 0) {
	        indices[id] = 0;
	        $("#apartman_garazs").css("cursor", "default");
	        $("#apartman_garazs .accent_hide").show();
	        $("#apartman_garazs .apartman_div_box").addClass("megnyomott");
	        image = $(".chill_kep");
	        parent_divId = "#garazs_div";
	        updateImage(id);
	    }

	    /*if (id === 'apartman_garazs_szoba' && indices[id] === 0) {
	        indices[id] = 0;
	        $("#apartman_garazs_szoba").css("cursor", "default");
	        $("#apartman_garazs_szoba .accent_hide").show();
	        $("#apartman_garazs_szoba .apartman_div_box").addClass("megnyomott");
	        image = $(".chill_plus_kep");
	        parent_divId = "#garazs_szoba_div";
	    }*/

	    $("#" + id + " .apartman_div").css("background-image", "url()");
	    $("#apartmanok-bg").hide();
	    setupArrowListeners(id);
	});

	$(".accent-bg").click(function() {
	    $("#apartmanok-bg").show();
	    $("#apartman_tinodi .apartman_div").css("background-image", "url(static/images/apartman_1_kepek/tinodi_0.svg)");
	    $("#apartman_garazs .apartman_div").css("background-image", "url(static/images/apartman_2_kepek/chill_0.svg)");
	    $("#apartman_garazs_szoba .apartman_div").css("background-image", "url(static/images/apartman_3_kepek/chill_plus_0.svg)");

	    $(".apartman").css("height", "auto");
	    $(".apartman_fo_kep").show();
	    $(".felirat").show();

	    $(".accent_hide").hide();

	    $(".apartman").removeClass("background");
	    $(".apartman").removeClass("foreground");

	    $(this).removeClass("accent-bg-show");
	    $(".apartman").css("cursor", "pointer");

	    indices = {};
	});

	function updateImage(id) {
	    if (!image || image.length === 0) {
	        return;
	    }

	    let currentIndex = indices[id];

	    $(image).removeClass('active').css('transform', '');

	    $(image[currentIndex]).addClass('active').css('transform', 'translateX(0)');

	    $(image[(currentIndex - 1 + image.length) % image.length])
	        .addClass('active')
	        .css('transform', 'translateX(-100%)');

	    $(image[(currentIndex + 1) % image.length])
	        .addClass('active')
	        .css('transform', 'translateX(100%)');

	    $(image).css('transition', 'transform 0.5s ease');

	    if (currentIndex === image.length - 1) {
	        $(image[0]).css('transform', 'translateX(100%)');
	    }
	    if (currentIndex === 0) {
	        $(image[image.length - 1]).css('transform', 'translateX(-100%)');
	    }
	}

	function setupArrowListeners(id) {
	    $(parent_divId + " .jobb_nyil").off("click").on("click", function() {
	        if (image && image.length > 0) {
	            indices[id] = (indices[id] + 1) % image.length;
	            updateImage(id);
	        }
	    });

	    $(parent_divId + " .bal_nyil").off("click").on("click", function() {
	        if (image && image.length > 0) {
	            indices[id] = (indices[id] - 1 + image.length) % image.length;
	            updateImage(id);
	        }
	    });
	}
});
