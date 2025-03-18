const timeOutDurr = 100;

let dateSelectionInProgress = false;
let dateSet = false;
let currentSelectedDateTime;
let selectionStarterDate = new Object;
let selectionEndingDate = new Object;
let clickTimeout;

const szamozottNaptarNap = document.getElementsByClassName("naptar-szamozott-nap");

// date -> yyyy-mm-dd
const dateString = date => `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate())}`;

const getDateFromDOM = element => new Date(`${element.getAttribute("data-year")}-${element.getAttribute("data-month")}-${element.getAttribute("data-day")}`);

const isSet = sessionId => sessionStorage.getItem(sessionId) != "null";

const isValidDate = element => {
	validateDate = getDateFromDOM(element).getTime();
	currentDate = new Date()
	currentDate.setHours(0, 0, 0, 0);

	return validateDate >= currentDate.getTime();
};

const clearDateFull = () => {
	for (let i = 0; i < szamozottNaptarNap.length; i++)
		szamozottNaptarNap[i].firstElementChild.classList.remove("date-full");
}

const resetDateClasses = () => {
	for (let i = 0; i < szamozottNaptarNap.length; i++) {
		szamozottNaptarNap[i].firstElementChild.classList.remove("date-start");
		szamozottNaptarNap[i].firstElementChild.classList.remove("date-end");
	}
	clearDateFull();
}

// Rest api call
const szamozottNaptarNapok = document.getElementsByClassName("naptar-szamozott-nap");
fetch(url)
	.then(response => {
		if (!response.ok) throw new Error(response.message);
		return response.json();
	})
	.then(data => {
		console.log(data);
		if (!data.success) throw new Error(data.message);

		for (let i = 0; i < szamozottNaptarNap.length; i++) { 
			if (szamozottNaptarNap[i].firstElementChild.getAttribute("status") == "enabled") {
				// This is where the magic happens
			}
		}
	})
	.catch(err => console.error(`There was a problem with the fetch operation: ${err.message}`))

// A kezdő- és végdátum be van állítva
if (isSet("starterDate") && isSet("endingDate")) { 
	dateSet = true;
	dateSelectionInProgress = false;
	selectionStarterDate = new Date(sessionStorage.getItem("starterDate"));
	selectionEndingDate = new Date(sessionStorage.getItem("endingDate"));
	

	for (let i = 0; i < szamozottNaptarNap.length; i++) {
		let nap = szamozottNaptarNap[i].firstElementChild;

		if (isValidDate(nap) ) {
			if (getDateFromDOM(nap).getTime() == selectionStarterDate.getTime()) {
				nap.classList.add("date-start");
			} else if (getDateFromDOM(nap).getTime() == selectionEndingDate.getTime()) {
				nap.classList.add("date-end");
			} else if (getDateFromDOM(nap).getTime() > selectionStarterDate.getTime() && getDateFromDOM(nap).getTime() < selectionEndingDate.getTime()) {
				nap.classList.add("date-full");
			}
		}
	}
} else if (isSet("starterDate") && !isSet("endingDate")) { // Csak a kezdődátum van beállítva
	dateSelectionInProgress = true;						   // AKA: a kezdő dátum egy másik hónapban van
	selectionStarterDate = new Date(sessionStorage.getItem("starterDate"));

	clearDateFull();
}

for (let i = 0; i < szamozottNaptarNap.length; i++) {
	
	szamozottNaptarNap[i].addEventListener("mouseenter", e => {
		const dateElemnt = e.target.firstElementChild;


		dateElemnt.addEventListener("click", e => {
			if (clickTimeout) { 								// Kattintás után 0.1s-es timeout, hogy a felhasználó 
				clearTimeout(clickTimeout);						// direkt és véletlenül se tudja spammelni a gombot
				clickTimeout = null;
			} else {
				if (isValidDate(dateElemnt)) {
					// STARTED date selection
					if (!dateSelectionInProgress && !dateSet && !isSet("starterDate")) {
						
						dateSelectionInProgress = true;
						selectionStarterDate = getDateFromDOM(dateElemnt);
						clearDateFull();
						
						sessionStorage.setItem("starterDate", dateString(selectionStarterDate))
					}

					// ENDED date selection
					else if (dateSelectionInProgress && !dateSet) {
						if (selectionStarterDate.getTime() < getDateFromDOM(dateElemnt).getTime()) {
							
							dateSet = true;
							dateSelectionInProgress = false;
							selectionEndingDate = getDateFromDOM(dateElemnt);
							
							sessionStorage.setItem("endingDate", dateString(selectionEndingDate))
						}
						else if (selectionStarterDate.getTime() >= getDateFromDOM(dateElemnt).getTime()) {
							
							sessionStorage.setItem("starterDate", null);
							sessionStorage.setItem("endingDate", null);

							resetDateClasses();

							selectionStarterDate = new Object;
							selectionEndingDate = new Object;

							dateSelectionInProgress = false;
							dateSet = false;
						}
					}

					// RESET date selection
					else if (dateSet && !dateSelectionInProgress) {
						
						sessionStorage.setItem("starterDate", null);
						sessionStorage.setItem("endingDate", null);

						resetDateClasses();

						selectionStarterDate = new Object;
						selectionEndingDate = new Object;
						
						dateElemnt.classList.add("date-start");
						dateSelectionInProgress = true;
						dateSet = false;
						selectionStarterDate = getDateFromDOM(dateElemnt);
						
						sessionStorage.setItem("starterDate", dateString(selectionStarterDate))

					}
				}
				
			}
			clickTimeout = setTimeout(() => {
				clickTimeout = null;
			}, timeOutDurr);
		});

		// Kiválastás után a starter és ending dátumok style-ozása
		if (isValidDate(dateElemnt)) {
			if (!dateSelectionInProgress && !dateSet) {
				dateElemnt.classList.add("date-start");
			} else if (dateSelectionInProgress && !dateSet) {
				if (selectionStarterDate.getTime() >= getDateFromDOM(dateElemnt).getTime()) return;
				dateElemnt.classList.add("date-end");
			}
		}

		// Kiválastás után a starter és ending közötti dátumok style-ozása
		currentSelectedDateTime = getDateFromDOM(dateElemnt).getTime();

		for (let i = 0; i < szamozottNaptarNap.length; i++) {
			let nap = szamozottNaptarNap[i].firstElementChild;

			if (isValidDate(nap) && dateSelectionInProgress && !dateSet && getDateFromDOM(nap).getTime() > selectionStarterDate.getTime()){
				if (getDateFromDOM(nap).getTime() < currentSelectedDateTime)
					nap.classList.add("date-full");
				else if (getDateFromDOM(szamozottNaptarNap[i].firstElementChild).getTime() >= currentSelectedDateTime)
					nap.classList.remove("date-full");
			}
		}
	});

	szamozottNaptarNap[i].addEventListener("mouseleave", e => {
		const dateElemnt = e.target.firstElementChild;

		if (isValidDate(dateElemnt) && !dateSelectionInProgress && !dateSet) {
			dateElemnt.classList.remove("date-start");
		}
		if (isValidDate(dateElemnt) && dateSelectionInProgress && !dateElemnt.classList.contains("date-start") && !dateSet) {
			dateElemnt.classList.remove("date-end");
		}

		for (let i = 0; i < szamozottNaptarNap.length; i++)
			if (dateSelectionInProgress && !dateSet)
				szamozottNaptarNap[i].firstElementChild.classList.remove("date-full");
	});
}	

