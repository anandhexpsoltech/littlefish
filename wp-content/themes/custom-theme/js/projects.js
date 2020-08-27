jQuery(document).ready(function($){
    var targetSelector = '.mix';

	var mixer = mixitup('.mixitup-container', {
        selectors: {
            target: targetSelector
        }
    });

    $('.project-nav ul li span').click(function(ev){
        var title = $(this).text();

        $('.project-nav .current-nav').text(title);
    });
});
