const container = document.getElementById('ertekeles_sor');
const reviews = Array.from(document.querySelectorAll('.ertekeles_elem'));
const nextButton = document.getElementById('next_review');
const prevButton = document.getElementById('prev_review');

let currentIndex = 0;
let startX = 0;
let endX = 0;

// ----------- DESKTOP (Above 900px) -----------
function initializeDesktopCarousel() {
	container.innerHTML = '';
	reviews.forEach(review => {
		review.style.width = "600px"; // static pixel width
		container.appendChild(review);
	});

	nextButton?.addEventListener('click', handleNextDesktop);
	prevButton?.addEventListener('click', handlePrevDesktop);
	nextButton?.classList.remove('hidden');
	prevButton?.classList.remove('hidden');

	updateDesktopCarousel();
}

function handleNextDesktop() {
	currentIndex = (currentIndex + 1) % reviews.length;
	updateDesktopCarousel();
}

function handlePrevDesktop() {
	currentIndex = (currentIndex - 1 + reviews.length) % reviews.length;
	updateDesktopCarousel();
}

function updateDesktopCarousel() {
	const itemWidth = getReviewWidth();
	const viewportWidth = window.innerWidth;
	const gap = getReviewGap();
	const offset = (viewportWidth / 2) - (itemWidth / 2) - (currentIndex * (itemWidth + gap));
	container.style.transform = `translateX(${offset}px)`;
}

// ----------- TABLET MODE (600px to 900px) -----------
function initializeTabletCarousel() {
	container.innerHTML = '';
	reviews.forEach(review => {
		review.style.width = "85vw"; // fluid width
		container.appendChild(review);
	});

	nextButton?.addEventListener('click', handleNextDesktop);
	prevButton?.addEventListener('click', handlePrevDesktop);
	nextButton?.classList.remove('hidden');
	prevButton?.classList.remove('hidden');

	updateDesktopCarousel(); // reuses desktop logic
}

// ----------- MOBILE SWIPE (Below 600px) -----------
function initializeMobileCarousel() {
	container.innerHTML = '';
	reviews.forEach(review => {
		review.style.width = "90vw"; // fluid width on mobile
		container.appendChild(review);
	});

	container.addEventListener('touchstart', handleTouchStart);
	container.addEventListener('touchend', handleTouchEnd);

	nextButton?.classList.add('hidden');
	prevButton?.classList.add('hidden');

	updateMobileCarousel();
}

function handleTouchStart(e) {
	startX = e.touches[0].clientX;
}

function handleTouchEnd(e) {
	endX = e.changedTouches[0].clientX;
	handleSwipe();
}

function handleSwipe() {
	const swipeThreshold = 50;
	if (endX - startX > swipeThreshold) {
		prevSlideMobile();
	} else if (startX - endX > swipeThreshold) {
		nextSlideMobile();
	}
}

function nextSlideMobile() {
	currentIndex = (currentIndex + 1) % reviews.length;
	updateMobileCarousel();
}

function prevSlideMobile() {
	currentIndex = (currentIndex - 1 + reviews.length) % reviews.length;
	updateMobileCarousel();
}

function updateMobileCarousel() {
	const itemWidth = getReviewWidth();
	const viewportWidth = window.innerWidth;
	const gap = getReviewGap();
	const offset = (viewportWidth / 2) - (itemWidth / 2) - (currentIndex * (itemWidth + gap));
	container.style.transform = `translateX(${offset}px)`;
}

// UTILITY FUNCTIONS
function getReviewWidth() {
	const reviewEl = document.querySelector('.ertekeles_elem');
	if (!reviewEl) return 500;
	return reviewEl.offsetWidth;
}

function getReviewGap() {
	const reviewEl = document.querySelector('.ertekeles_elem');
	if (!reviewEl) return 0;
	const style = window.getComputedStyle(reviewEl);
	const marginLeft = parseInt(style.marginLeft) || 0;
	const marginRight = parseInt(style.marginRight) || 0;
	return marginLeft + marginRight;
}

// SMART SWITCH (3 zones)
function initCarousels() {
	container.innerHTML = '';
	currentIndex = 0;

	nextButton?.removeEventListener('click', handleNextDesktop);
	prevButton?.removeEventListener('click', handlePrevDesktop);
	container.removeEventListener('touchstart', handleTouchStart);
	container.removeEventListener('touchend', handleTouchEnd);

	const w = window.innerWidth;

	if (w <= 600) {
		initializeMobileCarousel();
	} else if (w > 600 && w <= 900) {
		initializeTabletCarousel();
	} else {
		initializeDesktopCarousel();
	}
}

window.addEventListener('resize', initCarousels);
window.addEventListener('load', initCarousels);
