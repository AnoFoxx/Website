const DEBUG = true;
const log = str => {if (DEBUG) console.log(str);}

const timeOutDurr = 100;
let dateSelectionInProgress = false;
let dateSet = false;
let currentSelectedDateTime;
let selectionStarterDate = new Object;
let selectionEndingDate = new Object;
let clickTimeout;

let url = location.href;



const szamozottNaptarNap = document.getElementsByClassName("naptar-szamozott-nap");

const getDateFromDOM = element => new Date(`${element.getAttribute("data-year")}-${element.getAttribute("data-month")}-${element.getAttribute("data-day")}`);

const resetDateClasses = () => {
	for (let i = 0; i < szamozottNaptarNap.length; i++) {
		szamozottNaptarNap[i].firstElementChild.classList.remove("date-start");
		szamozottNaptarNap[i].firstElementChild.classList.remove("date-end");
	}
}

window.onload = () => {
	for (let i = 0; i < szamozottNaptarNap.length; i++) {
		if (sessionStorage.getItem("starterDate") != "null" && sessionStorage.getItem("endingDate") != "null") {
			dateSet = true;
			dateSelectionInProgress = false;
			selectionStarterDate = new Date(sessionStorage.getItem("starterDate"));
			selectionEndingDate = new Date(sessionStorage.getItem("endingDate"));

			for (let i = 0; i < szamozottNaptarNap.length; i++) {
				if (szamozottNaptarNap[i].firstElementChild.getAttribute("status") == "enabled" ) {
					if (getDateFromDOM(szamozottNaptarNap[i].firstElementChild).getTime() > selectionStarterDate.getTime() && getDateFromDOM(szamozottNaptarNap[i].firstElementChild).getTime() < selectionEndingDate.getTime()) {
						szamozottNaptarNap[i].firstElementChild.classList.add("date-full");
					} else if (getDateFromDOM(szamozottNaptarNap[i].firstElementChild).getTime() == selectionStarterDate.getTime()) {
						szamozottNaptarNap[i].firstElementChild.classList.add("date-start");
					} else if (getDateFromDOM(szamozottNaptarNap[i].firstElementChild).getTime() == selectionEndingDate.getTime()) {
						szamozottNaptarNap[i].firstElementChild.classList.add("date-end");
					}
				}
				
			}
		} else if (sessionStorage.getItem("starterDate") != "null" && sessionStorage.getItem("endingDate") == "null") {
			dateSelectionInProgress = true;
			selectionStarterDate = new Date(sessionStorage.getItem("starterDate"));

			for (let i = 0; i < szamozottNaptarNap.length; i++) {
			    szamozottNaptarNap[i].firstElementChild.classList.remove("date-full");
			}
		}

		szamozottNaptarNap[i].addEventListener("mouseenter", e => {
			const dateElemnt = e.target.firstElementChild;

			dateElemnt.addEventListener("click", e => {
				if (clickTimeout) {
					clearTimeout(clickTimeout);
					clickTimeout = null;
				} else {

					
					// STARTED date selection
					if (dateElemnt.getAttribute("status") == "enabled" && !dateSelectionInProgress && !dateSet && sessionStorage.getItem("starterDate") == "null") {
						dateSelectionInProgress = true;
						selectionStarterDate = getDateFromDOM(dateElemnt);

						for (let i = 0; i < szamozottNaptarNap.length; i++)
							szamozottNaptarNap[i].firstElementChild.classList.remove("date-full");

						log(`${selectionStarterDate.getFullYear()}-${String(selectionStarterDate.getMonth() + 1).padStart(2, '0')}-${String(selectionStarterDate.getDate()).padStart(2, '0')}`);
						
						sessionStorage.setItem("starterDate", `${selectionStarterDate.getFullYear()}-${String(selectionStarterDate.getMonth() + 1).padStart(2, '0')}-${String(selectionStarterDate.getDate()).padStart(2, '0')}`)
					}

					// ENDED date selection
					else if (dateElemnt.getAttribute("status") == "enabled" && dateSelectionInProgress && !dateSet) {
						if (selectionStarterDate.getTime() < getDateFromDOM(dateElemnt).getTime()) {
							dateSet = true;
							dateSelectionInProgress = false;
							selectionEndingDate = getDateFromDOM(dateElemnt);
							sessionStorage.setItem("endingDate", `${selectionEndingDate.getFullYear()}-${String(selectionEndingDate.getMonth() + 1).padStart(2, '0')}-${String(selectionEndingDate.getDate()).padStart(2, '0')}`)
						}
					}

					// RESET date selection
					else if (dateElemnt.getAttribute("status") == "enabled" && dateSet && !dateSelectionInProgress) {
						sessionStorage.setItem("starterDate", null);
						sessionStorage.setItem("endingDate", null);
						resetDateClasses();
						selectionStarterDate = new Object;
						selectionEndingDate = new Object;

						for (let i = 0; i < szamozottNaptarNap.length; i++)
							szamozottNaptarNap[i].firstElementChild.classList.remove("date-full");

						dateElemnt.classList.add("date-start");
						dateSelectionInProgress = true;
						dateSet = false;
						selectionStarterDate = getDateFromDOM(dateElemnt);
						sessionStorage.setItem("starterDate", `${selectionStarterDate.getFullYear()}-${String(selectionStarterDate.getMonth() + 1).padStart(2, '0')}-${String(selectionStarterDate.getDate()).padStart(2, '0')}`)

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
				if (dateElemnt.getAttribute("status") == "enabled" && dateSelectionInProgress && !dateSet)
					szamozottNaptarNap[i].firstElementChild.classList.remove("date-full");

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

			for (let i = 0; i < szamozottNaptarNap.length; i++)
				if (dateSelectionInProgress && !dateSet)
					szamozottNaptarNap[i].firstElementChild.classList.remove("date-full");
		});
	}	
}
