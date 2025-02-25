const DEBUG = true;
const log = str => {if (DEBUG) console.log(str);}
const dateString = (date) => `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate())}`;

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

window.onload = () => {
	if (sessionStorage.getItem("starterDate") != "null" && sessionStorage.getItem("endingDate") != "null") {
		dateSet = true;
		dateSelectionInProgress = false;
		selectionStarterDate = new Date(sessionStorage.getItem("starterDate"));
		selectionEndingDate = new Date(sessionStorage.getItem("endingDate"));
		

		for (let i = 0; i < szamozottNaptarNap.length; i++) {
			let nap = szamozottNaptarNap[i].firstElementChild;
			if (nap.getAttribute("status") == "enabled" ) {
				if (getDateFromDOM(nap).getTime() == selectionStarterDate.getTime()) {
					nap.classList.add("date-start");
				} else if (getDateFromDOM(nap).getTime() == selectionEndingDate.getTime()) {
					nap.classList.add("date-end");
				} else if (getDateFromDOM(nap).getTime() > selectionStarterDate.getTime() && getDateFromDOM(nap).getTime() < selectionEndingDate.getTime()) {
					nap.classList.add("date-full");
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

	for (let i = 0; i < szamozottNaptarNap.length; i++) {
		
		szamozottNaptarNap[i].addEventListener("mouseenter", e => {
			const dateElemnt = e.target.firstElementChild;

			dateElemnt.addEventListener("click", e => {
				if (clickTimeout) {
					clearTimeout(clickTimeout);
					clickTimeout = null;
				} else {

					
					// STARTED date selection
					if (dateElemnt.getAttribute("status") == "enabled" && !dateSelectionInProgress && !dateSet && sessionStorage.getItem("starterDate") == "null") {
						log("started")
						dateSelectionInProgress = true;
						selectionStarterDate = getDateFromDOM(dateElemnt);

						for (let i = 0; i < szamozottNaptarNap.length; i++)
							szamozottNaptarNap[i].firstElementChild.classList.remove("date-full");

						log(dateString(selectionStarterDate));
						
						sessionStorage.setItem("starterDate", dateString(selectionStarterDate))
					}

					// ENDED date selection
					else if (dateElemnt.getAttribute("status") == "enabled" && dateSelectionInProgress && !dateSet) {
						if (selectionStarterDate.getTime() < getDateFromDOM(dateElemnt).getTime()) {
							log("ended")
							dateSet = true;
							dateSelectionInProgress = false;
							selectionEndingDate = getDateFromDOM(dateElemnt);

							log(dateString(selectionEndingDate));

							sessionStorage.setItem("endingDate", dateString(selectionEndingDate))
						}
						else if (selectionStarterDate.getTime() >= getDateFromDOM(dateElemnt).getTime()) {
							log("reset")
							sessionStorage.setItem("starterDate", null);
							sessionStorage.setItem("endingDate", null);
							resetDateClasses();
							selectionStarterDate = new Object;
							selectionEndingDate = new Object;

							for (let i = 0; i < szamozottNaptarNap.length; i++)
								szamozottNaptarNap[i].firstElementChild.classList.remove("date-full");
							dateSelectionInProgress = false;
							dateSet = false;
						}
					}

					// RESET date selection
					else if ((dateElemnt.getAttribute("status") == "enabled" && dateSet && !dateSelectionInProgress)) {
						log("reset")
						sessionStorage.setItem("starterDate", null);
						sessionStorage.setItem("endingDate", null);
						resetDateClasses();
						selectionStarterDate = new Object;
						selectionEndingDate = new Object;

						for (let i = 0; i < szamozottNaptarNap.length; i++)
							szamozottNaptarNap[i].firstElementChild.classList.remove("date-full");
						
						log("started")
						dateElemnt.classList.add("date-start");
						dateSelectionInProgress = true;
						dateSet = false;
						selectionStarterDate = getDateFromDOM(dateElemnt);
						
						log(dateString(selectionStarterDate));
						
						sessionStorage.setItem("starterDate", dateString(selectionStarterDate))

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
				let nap = szamozottNaptarNap[i].firstElementChild;
				if (dateElemnt.getAttribute("status") == "enabled" && dateSelectionInProgress && !dateSet)
					nap.classList.remove("date-full");

				if (nap.getAttribute("status") == "enabled" && dateSelectionInProgress && !dateSet && getDateFromDOM(nap).getTime() > selectionStarterDate.getTime()){
					if (getDateFromDOM(nap).getTime() < currentSelectedDateTime)
						nap.classList.add("date-full");
					else if (getDateFromDOM(szamozottNaptarNap[i].firstElementChild).getTime() >= currentSelectedDateTime)
						nap.classList.remove("date-full");
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
