if (window.innerWidth < 1000) {
	const container = document.getElementById('ertekeles_sor');
	const originalReviews = Array.from(container.querySelectorAll('.ertekeles_elem'));
	container.innerHTML = '';

	for (let i = 0; i < originalReviews.length; i += 2) {
		const slide = document.createElement('div');
		slide.classList.add('ertekeles_slide');

		slide.appendChild(originalReviews[i]);
		if (originalReviews[i + 1]) {
			slide.appendChild(originalReviews[i + 1]);
		}

		container.appendChild(slide);
	}

	const slides = document.querySelectorAll('.ertekeles_slide');
	let currentIndex = 0;

	let startX = 0;
	let endX = 0;

	container.addEventListener('touchstart', (e) => {
		startX = e.touches[0].clientX;
	});

	container.addEventListener('touchend', (e) => {
		endX = e.changedTouches[0].clientX;
		handleSwipe();
	});

	function handleSwipe() {
		const swipeThreshold = 50;
		if (endX - startX > swipeThreshold) {
			prevSlide();
		} else if (startX - endX > swipeThreshold) {
			nextSlide();
		}
	}

	function nextSlide() {
		currentIndex = (currentIndex + 1) % slides.length;
		updateCarousel();
	}

	function prevSlide() {
		currentIndex = (currentIndex - 1 + slides.length) % slides.length;
		updateCarousel();
	}

	function updateCarousel() {
		const itemWidth = window.innerWidth;
		container.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
	}

	window.addEventListener('resize', updateCarousel);
	updateCarousel();
}
