jQuery(document).ready(function($){
	$('.carousel-home').slick();

	$('.testimonials-slider').slick({
		autoplay: true,
		autoplaySpeed: 4000
	});

	$('.header-image').slick({
		dots: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 4000,
		speed: 500,
		fade: true,
		cssEase: 'linear'
	});
});
