$(document).ready(function() {
    let betoltottImg = 0;

    // Create an intersection observer to detect when the images come into view
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // When the image enters the viewport, load the image with a slight delay
                const img = entry.target;
                const src = $(img).data('src'); // Get the dedicated image URL from data-src
                
                // Add a slight delay to avoid loading too many images at once
                setTimeout(() => {
                    $(img).attr('src', src).addClass('betoltott');
                }, betoltottImg * 100); // Delay each image load by 100ms
                betoltottImg++;

                observer.unobserve(img); // Stop observing once the image is loaded
            }
        });
    }, { threshold: 0.5 }); // 50% of the image must be visible

    // Target only images with the class 'gallery_img'
    $('.lazy_toltes').each(function() {
        observer.observe(this);
    });
});