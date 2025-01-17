const szamozottNaptarNap = document.getElementsByClassName("naptar-szamozott-nap");


for (let i = 0; i < szamozottNaptarNap.length; i++) {
	szamozottNaptarNap[i].addEventListener("mouseover", e => {
		console.log(e);
	});	
}
