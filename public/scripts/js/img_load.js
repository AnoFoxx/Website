$(document).ready(function() {
	let betoltottImg = 0;

	const observer = new IntersectionObserver((entries, observer) => {
		entries.forEach(entry => {
			if (entry.isIntersecting) {
				const img = entry.target;
				const src = $(img).data('src'); 
				
				setTimeout(() => {
						$(img).attr('src', src).addClass('betoltott');
				}, betoltottImg * 100); 
				betoltottImg++;

				observer.unobserve(img); 
			}
		});
	}, { threshold: 0.1}); 

	$('.lazy_toltes').each(function() {
			observer.observe(this);
	});
});
