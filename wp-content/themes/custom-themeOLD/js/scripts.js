jQuery(document).ready(function($){
	/* Mobile Menu */

	/*$('header .nav').meanmenu({
		meanScreenWidth: "800",
		meanMenuContainer: ".header .wrapper"
	});*/

	$('.header .btn-menu').click(function(){
		$(this).parent().toggleClass('active');
		$('.header .compact .nav').toggleClass('show');
	});

	/* Sticky Header */

	$('#sticker').sticky({topSpacing:0});

	/* WOW Init */

	var wow = new WOW(
		{
			boxClass:     'wow',      // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset:       0,          // distance to the element when triggering the animation (default is 0)
			mobile:       false,      // trigger animations on mobile devices (default is true)
			live:         true,       // act on asynchronously loaded content (default is true)
			callback:     function(box) {
			  // the callback is fired every time an animation is started
			  // the argument that is passed in is the DOM node being animated
			},
			scrollContainer: null // optional scroll container selector, otherwise use window
		}
	);

	wow.init();

	/* Scroll Up */

	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollup').fadeIn();
		} else {
			$('.scrollup').fadeOut();
		}
	});

	$('.scrollup').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 600);
		return false;
	});

	/* Infinite Scroll */

	if($(window).width() >= 800) {
		$('.infinite-scroll').jscroll({
			loadingHtml: '<div class="btn-loading">Load More Insights & News</div>',
			padding: 0,
			nextSelector: '.pagination .next',
			contentSelector: '.infinite-scroll',
		});
	};

	/* Smooth Scroll */

	$('a[href*=#].btn-smooth:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top - 120
			}, 1000);
				return false;
			}
		}
	});

	/* Slick Shortcode */

	$('.wp-slick-slider').slick({
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		speed: 300,
		fade: true,
		autoplay: false,
		autoplaySpeed: 2000
	});

	/* Project Accordion */

	$('.updates-wrap .updates h3.title').click(function(ev){
  		ev.preventDefault();
  		$(this).toggleClass('active');
		$('.updates-wrap .updates .update').toggle();
 	});

	/* Normal Accordion */

	$('.accordion .title').click(function(ev){
		ev.preventDefault();
	    $(this).toggleClass('active');
	    $(this).next('.content').slideToggle();
	});

	/* LightGallery */

	$('.has-lightbox').lightGallery({
    	selector: 'a',
		pager: true,
		download: false,
		fullScreen: true,
		mode: 'lg-fade',
		getCaptionFromTitleOrAlt: false,
	});
});
