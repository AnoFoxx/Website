$(document).ready(() => {
	$(".apartman").click(function() {
		
		let poppedOut;
		if ($(this).parent().attr("class") == $(".wrap").attr("class")) poppedOut = true;
		if ($(this).parent().attr("class") == $(".wrapper").attr("class")) poppedOut = false;

		if (poppedOut) {
			$(".wrapper").css("height", $(".wrapper").height()*2);
			$(this).insertAfter($(this).parent());
		} else {
			$(".wrapper").css("height", $(".wrapper").height()/2);
			$(this).insertAfter($(this).parent().children(".wrap").children(":last-child"));
		}
		
	});
});