const DEBUG = true;
const log = str => {if (DEBUG) console.log(str);}

const timeOutDurr = 100;
let dateSelectionInProgress = false;
let dateSet = false;
let currentSelectedDateTime;
let selectionStarterDate = new Object;
let selectionEndingDate = new Object;
let clickTimeout;

const szamozottNaptarNap = document.getElementsByClassName("naptar-szamozott-nap");

const getDateFromDOM = element => new Date(`${element.getAttribute("data-year")}-${element.getAttribute("data-month")}-${element.getAttribute("data-day")}`);

const resetDateClasses = () => {
	for (let i = 0; i < szamozottNaptarNap.length; i++) {
		szamozottNaptarNap[i].firstElementChild.classList.remove("date-start");
		szamozottNaptarNap[i].firstElementChild.classList.remove("date-end");
	}
}

for (let i = 0; i < szamozottNaptarNap.length; i++) {
	szamozottNaptarNap[i].addEventListener("mouseenter", e => {
		const dateElemnt = e.target.firstElementChild;

		dateElemnt.addEventListener("click", e => {
			if (clickTimeout) {
				clearTimeout(clickTimeout);
				clickTimeout = null;
			} else {

				// STARTED date selection
				if (dateElemnt.getAttribute("status") == "enabled" && !dateSelectionInProgress && !dateSet) {
					dateSelectionInProgress = true;
					selectionStarterDate = getDateFromDOM(dateElemnt);
					log("start");
					log(selectionStarterDate);
				}

				// ENDED date selection
				else if (dateElemnt.getAttribute("status") == "enabled" && dateSelectionInProgress && !dateSet) {
					if (selectionStarterDate.getTime() < getDateFromDOM(dateElemnt).getTime()) {
						dateSet = true;
						dateSelectionInProgress = false;
						selectionEndingDate = getDateFromDOM(dateElemnt);
						log("end");
						log(selectionEndingDate);	
					}
				}

				// RESET date selection
				else if (dateElemnt.getAttribute("status") == "enabled" && dateSet && !dateSelectionInProgress) {
					resetDateClasses();
					selectionStarterDate = new Object;
					selectionEndingDate = new Object;
					log("reset");


					for (let i = 0; i < szamozottNaptarNap.length; i++)
						szamozottNaptarNap[i].firstElementChild.classList.remove("date-full");

					dateElemnt.classList.add("date-start");
					dateSelectionInProgress = true;
					dateSet = false;
					selectionStarterDate = getDateFromDOM(dateElemnt);
					log("start");
					log(selectionStarterDate);
				}
			}
			clickTimeout = setTimeout(() => {
				clickTimeout = null;
			}, timeOutDurr);
		});

		// After styling start/end
		if (dateElemnt.getAttribute("status") == "enabled" && !dateSelectionInProgress && !dateSet) {
			dateElemnt.classList.add("date-start");
		} else if (dateElemnt.getAttribute("status") == "enabled" && dateSelectionInProgress && !dateSet) {
			if (selectionStarterDate.getTime() >= getDateFromDOM(dateElemnt).getTime()) return;
			dateElemnt.classList.add("date-end");
		}

		currentSelectedDateTime = getDateFromDOM(dateElemnt).getTime();

		for (let i = 0; i < szamozottNaptarNap.length; i++) {
			if (szamozottNaptarNap[i].firstElementChild.getAttribute("status") == "enabled" && dateSelectionInProgress && !dateSet && getDateFromDOM(szamozottNaptarNap[i].firstElementChild).getTime() > selectionStarterDate.getTime()) {
				if (getDateFromDOM(szamozottNaptarNap[i].firstElementChild).getTime() < currentSelectedDateTime)
					szamozottNaptarNap[i].firstElementChild.classList.add("date-full");
				else if (getDateFromDOM(szamozottNaptarNap[i].firstElementChild).getTime() >= currentSelectedDateTime)
					szamozottNaptarNap[i].firstElementChild.classList.remove("date-full");
			}
		}


	});

	szamozottNaptarNap[i].addEventListener("mouseleave", e => {
		const dateElemnt = e.target.firstElementChild;

		if (dateElemnt.getAttribute("status") == "enabled" && !dateSelectionInProgress && !dateSet) {
			dateElemnt.classList.remove("date-start");
		}
		if (dateElemnt.getAttribute("status") == "enabled" && dateSelectionInProgress && !dateElemnt.classList.contains("date-start") && !dateSet) {
			dateElemnt.classList.remove("date-end");
		}
		
	});

	

}


