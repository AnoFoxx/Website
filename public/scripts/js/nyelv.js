let nyelvek = ["hu", "en"];
let nyelv = 0;

const loadLang = lang => {
	fetch(`static/json/${lang}.json`)
		.then(response => {
			if (!response.ok) {
				throw new Error("Network response was not ok");
			}
			return response.json();
		})
		.then(data => {
			updateTextFromJson(data.content);
            document.querySelector(".flag").src = `static/images/${data.img}`;
		})
		.catch(error => {
			console.error(`Fetch error: ${error}`);
		});
	
};

const updateTextFromJson = jsonData => {
	const elements = document.querySelectorAll("[data-key]");
	
	elements.forEach(element => {
		const key = element.getAttribute("data-key");
		if (jsonData[key]) {
			element.textContent = jsonData[key];
		}
	});
}

window.onload = e => {
	let elements = document.getElementsByClassName("lang-container");
	for (const e of elements) {
		e.addEventListener("click", e => {
			if (nyelv == nyelvek.length - 1) nyelv = 0;
	        else nyelv++;

	        loadLang(nyelvek[nyelv]);

		})
	}


	loadLang(nyelvek[nyelv]);
}


