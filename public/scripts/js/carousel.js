const reviews = document.querySelectorAll('.ertekeles_elem');
const nextButton = document.getElementById('next_review');
const prevButton = document.getElementById('prev_review');
const container = document.getElementById('ertekeles_sor');
let currentIndex = 0;

function updateCarousel() {
	container.style.transform = `translateX(-${currentIndex * 640}px)`;
}

nextButton.addEventListener('click', () => {
	currentIndex = (currentIndex + 1) % reviews.length;
	updateCarousel();
});

prevButton.addEventListener('click', () => {
	currentIndex = (currentIndex - 1 + reviews.length) % reviews.length;
	updateCarousel();
});

updateCarousel();
