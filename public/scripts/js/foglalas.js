$(document).ready(function(){
	$("#felirat").click(function(){
		window.location.href="index.php";
	})
	$("#dark_mode").change(function(){
		if($(this).is(":checked")){
			$("#full").css("background-color","grey");
			$("#kerek_img").css("filter","brightness(0%)");
			$("#full").css("color","white");
		}
		if(!($(this).is(":checked"))){
			$("#full").css("background-color","white");
			$("#kerek_img").css("filter","brightness(100%)");
			$("#full").css("color","black");
		}
	})

	$("#settings").click(function(){
		$("#kerek").hide();
		$("#menu").show(500);
		$("#menu_hatter").show(500);
	})
	$("#iksz").click(function(){
		$("#kerek").show(500);
		$("#menu").hide(500);
		$("#menu_hatter").hide(500);
	})
	$("#menu_hatter").click(function(){
		$("#kerek").show(500);
		$("#menu").hide(500);
		$("#menu_hatter").hide(500);
	})

	$("#apartman_select").change(function(){
		
		var selected= $("#apartman_select option:selected");
		var width=$(window).innerWidth();

		function updateInfoDiv() {
			var width = $(window).innerWidth();

			if (selected.attr('id') != "default_option") {
				$("#apartman_info").show();

				if (width > 950) {
					$("#info_div").css({
							"align-items": "stretch",
							"flex-direction": "row"
					});

					if (selected.attr('id') == "apartman_1") {
							$("#naptar").attr('src', "naptar.php?apartman=1");
							$("#apartman").val("1");
					} else if (selected.attr('id') == "apartman_2") {
							$("#naptar").attr('src', "naptar.php?apartman=2");
							$("#apartman").val("2");
					} else if (selected.attr('id') == "apartman_3") {
							$("#naptar").attr('src', "naptar.php?apartman=3");
							$("#apartman").val("3");
					}
				} 
				else {
					$("#info_div").css({
							"align-items": "center",
							"flex-direction": "column"
					});

					if (selected.attr('id') == "apartman_1") {
							$("#naptar").attr('src', "naptar.php?apartman=1");
							$("#apartman").val("1");
					} else if (selected.attr('id') == "apartman_2") {
							$("#naptar").attr('src', "naptar.php?apartman=2");
							$("#apartman").val("2");
					} else if (selected.attr('id') == "apartman_3") {
							$("#naptar").attr('src', "naptar.php?apartman=3");
							$("#apartman").val("3");
					}
				}
			} 
			else {
				$("#naptar").attr('src', "");
				$("#info_div").css({
						"align-items": "center",
						"flex-direction": "column"
				});
				$("#apartman_info").hide();
			}
		}

		updateInfoDiv();

		$(window).resize(function () {
				updateInfoDiv();
		});

	})
})
