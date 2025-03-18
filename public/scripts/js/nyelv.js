let nyelv = "hu";

const loadLang = lang => {
    fetch(`static/json/${lang}.json`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            updateTextFromJson(data);
        })
        .catch(error => {
            console.error(`Fetch error: ${error}`);
        });
    
};

const updateTextFromJson = jsonData => {
	const elements = document.querySelectorAll('[data-key]');
	
	elements.forEach(element => {
		const key = element.getAttribute('data-key');
		if (jsonData[key]) {
			element.textContent = jsonData[key];
		}
	});
}

window.onload = e => {
    console.log("nyelv betölés folyamatban");
	loadLang(nyelv);
    console.log("nyelv betöltve");
}
