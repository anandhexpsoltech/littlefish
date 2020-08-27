var winHt, hdrMarTp, menuHt, menuLnth, oneHtMenu, TotalMenuHt, RemHt, eachMar;
jQuery(document).ready(function() {

jQuery('.header .compact .nav').scroll(function (event) {
    //console.log('lolva');
    var scrollHeight = jQuery(document).height();
    var scrollPosition =  jQuery(this).scrollTop();

    var offsetTop =  jQuery('html').offset().top;
    //console.log(scrollPosition);
    //console.log('scrollPosition'+scrollPosition);
    setTimeout(function(){
    jQuery('#sticker').animate({marginTop: -scrollPosition}, 0); //.css('top', -    scrollPosition);
    },0);
    if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
        // when scroll to bottom of the page
    }
});


    jQuery('.compact.active .animatedNo li.bg').live('click',function(){
        //alert('alert');
        jQuery('.btn-menu').trigger('click');
    });
    menuOnLoadFunction();
    jQuery(document).on('mouseover', '.compact.active .animatedNo li:not(.bg):not(.MouseOut)', function(event) {
        var classNew = jQuery(this).attr('id');

        jQuery('.compact.active .animatedNo li.bg').removeClass('active  animateID0  animateID1 animateID2 animateID3 animateID4 animateID5 animateID6 animateID7');
        jQuery('.compact.active .animatedNo li.bg').removeClass('active');
        jQuery('.compact.active .animatedNo li.bg').addClass(classNew);
        jQuery('.compact.active .animatedNo li.bg').addClass('active');
    });

    jQuery.browser.chrome = /chrom(e|ium)/.test(navigator.userAgent.toLowerCase());
    if(jQuery.browser.chrome){
        jQuery(document).on('mouseleave', '.header .compact .nav ul.animatedNo li.MouseOut', function(event) {
            //setTimeout(function(){
                jQuery('.compact.active .animatedNo li.bg').removeClass('active  animateID0  animateID1 animateID2 animateID3 animateID4 animateID5 animateID6 animateID7');
            console.log('Mouse Out chrome Mouse Leave');
            //},1000);
        });
        jQuery(document).on('mouseenter', '.compact.active .animatedNo li.bg', function(event) {
            //setTimeout(function(){
                jQuery('.compact.active .animatedNo li.bg').removeClass('active  animateID0  animateID1 animateID2 animateID3 animateID4 animateID5 animateID6 animateID7');
            //console.log('Mouse Out chrome mouseOut');
            //},1000);
        });
    }else{
                jQuery(document).on('mouseleave', '.header .compact .nav ul.animatedNo li.MouseOut , .header .compact .nav ul.animatedNo', function(event) {
            //setTimeout(function(){
                jQuery('.compact.active .animatedNo li.bg').removeClass('active  animateID0  animateID1 animateID2 animateID3 animateID4 animateID5 animateID6 animateID7');
            //console.log('Mouse Out mozila');
            //},1000);
        });
        jQuery(document).on('mouseenter', '.header .compact .nav ul.animatedNo li.bg', function(event) {
            jQuery('.compact.active .animatedNo li.bg').removeClass('active  animateID0  animateID1 animateID2 animateID3 animateID4 animateID5 animateID6 animateID7');
            //console.log('Mouse Out mozila');
        });

    }
    jQuery('.compact .animatedNo li').eq(0).addClass('animationStart');
    jQuery('.compact .animatedNo li').each(function() {
        var index = jQuery(this).index();
        jQuery(this).attr('id', 'animateID' + index);
        jQuery(this).addClass('animateID' + index);
    });
    jQuery('.header .compact .btn-menu').click(function() {
       // jQuery('.compact .nav .animatedNo li').css('margin-top', '-500px');
	   jQuery(this).toggleClass('open');
	   jQuery('.compact .nav .animatedNo li').css('opacity', '0');
        jQuery('.compact .animatedNo li').removeClass('animationStart');
        jQuery('body').removeClass('menuAnimationComplete');
       // revMenu();
        setTimeout(function() {
            if (jQuery('.compact').hasClass('active')) {
				menuFunction();
            }else {
                menuOnLoadFunction();
            }
        }, 50);
    });
    var resizeTimer;
    jQuery(window).on('resize', function(e) {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            resizeMenu();
        }, 250);
    });
});
var NewHt = 0;

function menuOnLoadFunction() {
    jQuery('.compact .animatedNo li').eq(7).addClass('animationStart');
    var thisObj = jQuery('.compact .animatedNo');
    //resizeMenu();
    var $cards = jQuery('.compact .animatedNo li');
    var time = 0;
    jQuery(jQuery(".compact .animatedNo li").get().reverse()).each(function() {
        if (jQuery(this).hasClass('bg')) {} else {
            var index = jQuery(this).index();
            index + 1;
            setTimeout(function() {
                jQuery('.compact .animatedNo ').find('li').remove('animationStart');
                jQuery('.compact .animatedNo').find('.animateID' + index).addClass('animationStart');
                var winHt = jQuery(window).height();
                //console.log('Height '+winHt);
                if(winHt > 768){
                    var winHt = 950;
                }

                else if(winHt > 600 && winHt < 768){
                    var winHt = 750;
                    //console.log(winHt);
                }
                else if(winHt > 500 && winHt < 600){
                    var winHt = 600;
                    //console.log(winHt);
                }
                else if(winHt < 500){
                    var winHt = 550;
                    //console.log(winHt);
                }

                //console.log(winHt);
                var hdrMarTp = jQuery('.compact .nav .animatedNo').css('margin-top').replace(/px/, ''); // Margin Top
                var MenuLiHt = jQuery('.compact .nav .animatedNo li').height(); // Single Li Height
                var menuLnth = jQuery('.compact .animatedNo li:not(.bg)').length; // Lenght of li items
                //console.log('Menu Length ==> ' + menuLnth);
                var menuFullHt = winHt - (hdrMarTp * 1);
                //console.log('menuFullHt ==> '+menuFullHt)
                jQuery('.compact .nav .animatedNo').css('min-height', menuFullHt);
                var menuPos = MenuLiHt * index;
                var menuFHt = winHt - (hdrMarTp * 2);
                var SinglePos = menuFHt / menuLnth;
                var eachInx = (SinglePos * index) * 1;
                var newMin = eachInx - 150;
                //alert(typeof(eachInx));
                if (winHt < 700) {} else {}
                jQuery('.compact .animatedNo li.animationStart.animateID' + index).animate({
                    top: newMin,
                    opacity:0,
                }, {
                    duration: 0,
                    //easing: 'easeInOutCirc',
                    //easing: 'easeInBack',
                    //easing: 'easeInOutQuart',
                    // easing: 'easeInQuad',easeInOutExpo,easeInOutCubiceaseInOutQuint easeInBack easeInOutBack easeInOutCirc easeOutBack easeInOutBack
                    easing: 'easeInOutElastic',
                    complete: function() {
                        if (jQuery('.compact.active .animatedNo li').hasClass('animateID8')) {
                            jQuery('body').addClass('menuAnimationComplete');
                            //console.log('Run '+index);
                        }
                    }
                });
            }, time)
            time += 1;
        }
    });
}


function menuFunction() {
    jQuery('.compact .animatedNo li').eq(7).addClass('animationStart');
    var thisObj = jQuery('.compact.active .animatedNo');
    //resizeMenu();
    var $cards = jQuery('.compact.active .animatedNo li');
    var time = 0;
    jQuery(jQuery(".compact.active .animatedNo li").get().reverse()).each(function() {
        if (jQuery(this).hasClass('bg')) {} else {
            var index = jQuery(this).index();
            index + 1;
            setTimeout(function() {
                jQuery('.compact.active .animatedNo ').find('li').remove('animationStart');
                jQuery('.compact.active .animatedNo').find('.animateID' + index).addClass('animationStart');
                var winHt = jQuery(window).height();

                if(winHt > 768){
                    var winHt = 950;
                }

                else if(winHt > 600 && winHt < 768){
                    var winHt = 750;
                    //console.log(winHt);
                }
                else if(winHt > 500 && winHt < 600){
                    var winHt = 600;
                    //console.log(winHt);
                }
                else if(winHt < 500){
                    var winHt = 550;
                    //console.log(winHt);
                }
                //console.log(winHt);


                var hdrMarTp = jQuery('.compact.active .nav.show .animatedNo').css('margin-top').replace(/px/, ''); // Margin Top
                var MenuLiHt = jQuery('.compact.active .nav.show .animatedNo li').height(); // Single Li Height
                var menuLnth = jQuery('.compact.active .animatedNo li:not(.bg)').length; // Lenght of li items
                //console.log('Menu Length ==> ' + menuLnth);
                var menuFullHt = winHt - (hdrMarTp * 1);
                //console.log('menuFullHt ==> '+ menuFullHt);
                jQuery('.compact.active .nav.show .animatedNo').css('min-height', menuFullHt);
                var menuPos = MenuLiHt * index;
                var menuFHt = winHt - (hdrMarTp * 2);
                var SinglePos = menuFHt / menuLnth;
                var eachInx = (SinglePos * index) * 1;
                console.log('SinglePos ==> '+SinglePos);
                if (winHt < 700) {} else {}
                jQuery('.compact.active .animatedNo li.animationStart.animateID' + index).animate({


                    top: eachInx,
                    opacity: 1,
                }, {
                    duration: 50,
                    //easing: 'easeInOutCirc',
                    //easing: 'easeInBack',
                    //easing: 'easeInOutQuart',
                    // easing: 'easeInQuad',easeInOutExpo,easeInOutCubiceaseInOutQuint easeInBack easeInOutBack easeInOutCirc easeOutBack easeInOutBack
                   // easing: 'easeInOutElastic',
                    easing: 'easeInOutBounce',

                     //easing: 'easeInQuad',
                    complete: function() {
                        if (jQuery('.compact.active .animatedNo li').hasClass('animateID8')) {
                            jQuery('body').addClass('menuAnimationComplete');
                            //console.log('Run '+index);
                        }
                    }
                });
            }, time)
            time += 100;
        }
    });
}

function revMenu() {
    var topmar = 60;
    jQuery('.compact.active .nav.show .animatedNo li').each(function() {
        var thisIndex = jQuery(this).index();
        if (thisIndex == 0) {
            var thisIndex = 1;
            var topmar = 80;
        } else {
            var topmar = 50;
        }
        var topMar = topmar * thisIndex;
    });
}

function resizeMenu() {
    jQuery(jQuery(".compact.active .animatedNo li").get().reverse()).each(function() {
        if (jQuery(this).hasClass('bg')) {} else {
            var winHt = jQuery(window).height();
            var index = jQuery(this).index();
            index + 1;
            jQuery('.compact.active .animatedNo ').find('li').remove('animationStart');
            jQuery('.compact.active .animatedNo').find('.animateID' + index).addClass('animationStart');
            var winHt = jQuery(window).height(); //Window Height

            if(winHt > 768){
                var winHt = 950;
            }

            else if(winHt > 600 && winHt < 768){
                var winHt = 750;
                //console.log(winHt);
            }
            else if(winHt > 500 && winHt < 600){
                var winHt = 600;
                //console.log(winHt);
            }
            else if(winHt < 500){
                var winHt = 550;
                //console.log(winHt);
            }


            var hdrMarTp = jQuery('.compact.active .nav.show .animatedNo').css('margin-top').replace(/px/, ''); // Margin Top
            var MenuLiHt = jQuery('.compact.active .nav.show .animatedNo li').height(); // Single Li Height
            var menuLnth = jQuery('.compact.active .animatedNo li:not(.bg)').length; // Lenght of li items
           // console.log('Menu Length ==> ' + menuLnth);
            var menuFullHt = winHt - (hdrMarTp * 1);
            jQuery('.compact.active .nav.show .animatedNo').css('min-height', menuFullHt);
            var menuPos = MenuLiHt * index;
            var menuFHt = winHt - (hdrMarTp * 2);
            var SinglePos = menuFHt / menuLnth;
            var eachInx = (SinglePos * index) * 1;
            if (jQuery('body').hasClass('menuAnimationComplete')) {
                if (eachInx > 1) {
                    jQuery(this).css('top', eachInx);
                }
            }
        }
    });
}
