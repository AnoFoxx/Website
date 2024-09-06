let apartmanok = $(".wrap").children();

$(".apartman").click(function() {
	if (Object.values(apartmanok).indexOf($(this)[0]) > -1) {
		$(".wrapper").css("height", $(".wrapper").height()*2);
		$(this).insertAfter($(".wrap"));
	} else {
		$(".wrapper").css("height", $(".wrapper").height()/2);
		$(this).insertAfter($(".wrap").children(":last-child"));
	}
	apartmanok = $(".wrap").children();
	var sortArr = [];
	for (const [key, val] of Object.entries(apartmanok)) {
		if (!isNaN(key)) sortArr.push([key, val.id]);
	}
	
	sortArr.sort((a, b) => {
		if (a[1] === b[1]) {
        	return 0;
	    }
	    else {
	        return (a[1] < b[1]) ? -1 : 1;
	    }
	});
	for (let i = 0; i < sortArr.length; i++) {
		$(".wrap").append(apartmanok[sortArr[i][0]]);
	}

	
});
