jQuery(document).ready(function($){
	/* Mobile Menu */

	/*$('header .nav').meanmenu({
		meanScreenWidth: "800",
		meanMenuContainer: ".header .wrapper"
	});*/

	$('.header .btn-menu').click(function(){
		$(this).toggleClass('open');
		$(this).parent().toggleClass('active');
		$('.header .compact .nav').toggleClass('show');
	});

	$('.header .compact .nav li.menu-item-has-children > a').click(function(event){
		event.preventDefault();
		$(this).parent().toggleClass('open');
		$(this).next().slideToggle();
	});

	$('.header .compact.active li.bg').live('click',function(){
        $('.btn-menu').trigger('click');
    });

	/* Video */

	if ($('.js-player').length > 0) {
		const players = Plyr.setup('.js-player', {hideControls: false});

		players.forEach(function(instance) {
			instance.toggleControls(false);

			instance.on('play', event => {
				instance.toggleControls(true);
			});
		});
	}

	/* Sticky Header */

	$('#sticker').sticky({topSpacing:0});

	/* WOW Init */

	var wow = new WOW(
		{
			boxClass:     'wow',      // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset:       0,          // distance to the element when triggering the animation (default is 0)
			mobile:       true,      // trigger animations on mobile devices (default is true)
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

	/* Scroll Down Button */

	$('.scrolldown').click(function(){
	    $('html, body').animate({ scrollTop: $(this).parent().innerHeight() - 82}, 600);
	    return false;
	});

	/* Popup Form */

	$('body').on('click', '.btn-inquiry', function (event) {
		event.preventDefault();

		$('body').toggleClass('show-form');
	});

	/* Popup Form (List) */

	$('body').on('click', '.btn-list', function (event) {
		event.preventDefault();

		$('body').toggleClass('show-list');
	});

	$('body').on('click', '.fancybox-wrap .close', function (event) {
		event.preventDefault();

		$('.fancybox-wrap').removeClass('fancybox-opened');

		setTimeout(function(){
			$('.fancybox-close').click();
		}, 1000);
	});

	/* Select Fields */

	$('.wpcf7-select').chosen({disable_search_threshold: 10});

	$('.wpcf7-select').on('change', function () {
		$(this).addClass('active');
		$('.chosen-container-single').addClass('active');
	});

	document.addEventListener('wpcf7mailsent', function(event) {
		$('.wpcf7-select').val('').trigger('chosen:updated');
		$('.chosen-container-single').removeClass('active');

		if ($('.form-wrap').length) {
			$('.form-wrap').addClass('success');
		}
	}, false );

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

	$('a[href*=#]:not(.normal)').click(function() {
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

	/* Testimonial Carousel */

	$('.testimonials-slider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		fade: true,
		arrows: false,
		asNavFor: '.testimonials-thumbnails'
	});

	$('.testimonials-thumbnails').slick({
		slidesToShow: 8,
		slidesToScroll: 1,
		asNavFor: '.testimonials-slider',
		variableWidth: true,
		focusOnSelect: true,
		responsive: [
			{
				breakpoint: 960,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					arrows: true,
				}
			}
		]
	});

	/* Project Accordion */

	$('.updates-wrap .updates h3.title').click(function(ev){
  		ev.preventDefault();
  		$(this).toggleClass('active');
		$(this).find('i').toggleClass('fa-chevron-circle-down fa-chevron-circle-up');
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

	$('.has-lightbox-video').lightGallery({
    	selector: 'a',
		dots: false,
		counter: false,
		zoom: false,
		autoplayControls: false,
		controls: false,
		pager: false,
		download: false,
		fullScreen: false,
		mode: 'lg-fade',
		videoMaxWidth: '80%',
		getCaptionFromTitleOrAlt: false,
	});

	/* Slide Content */

	$('.btn-slide-next').click(function(event){
		event.preventDefault();
		$(this).find('span').toggleClass('active');
		$(this).next().slideToggle();
	});

	/* Menu Drop-down */

	$('.nav li.btn-dropdown a').on('click', function (event) {
		event.preventDefault();

		$(this).next().slideToggle();
	});

	/* Form Buttons (Pinned) */

	$('body').on('click', '#_form_11_submit', function (event) {
		if($('._form_11 ._form-content').css('display')){
			$('.form-wrap.pinned').addClass('sent');
		}
	});

	/* Activity Tooltip */

	$('body').on('hover', '.btn-activity', function (event) {
		event.preventDefault();

		$(this).toggleClass('active');
	});
});
