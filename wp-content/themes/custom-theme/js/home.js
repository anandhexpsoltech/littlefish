jQuery(document).ready(function($){
	$('.carousel-home').slick();

	/* Banner Slider */

	$('.header-image').slick({
		dots: true,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 4000,
		speed: 500,
		fade: true,
		cssEase: 'linear'
	});

	/* Logo Carousel */

	$('.gallery-wrap .carousel').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 2000,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
				}
			},
			{
				breakpoint: 800,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				}
			}
		]
	});
});
