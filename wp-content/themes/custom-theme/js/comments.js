jQuery(document).ready(function($){
	$(document).on('click', '.btn-featured', function(e) {
		e.preventDefault();

		var element = $(this);
		var comment_id = $(this).data('comment');
		var comment_value = $(this).data('value');

		$.ajax({
			url : object.ajax_url,
			type : 'post',
			data : {
				action : 'update_featured_comment',
				comment_id : comment_id,
				comment_value : comment_value
			},
			success : function(response) {
				location.reload(true);
			}
		});
	});

	$(document).on('click', '.btn-thumb', function(e) {
		e.preventDefault();

		var element = $(this);
		var comment_id = $(this).data('comment');

		$.ajax({
			url : object.ajax_url,
			type : 'post',
			data : {
				action : 'update_viewed_comment',
				comment_id : comment_id
			},
			success : function(response) {
				location.reload(true);
			}
		});
	});

	$(document).on('mouseover, mouseleave', '.btn-thumb', function(e) {
		$(this).parent().toggleClass('show');
	});

	$(document).on({
		mouseenter: function() {
			$(this).parent().addClass('show');
		},
		mouseleave: function() {
			$(this).parent().removeClass('show');
		}
	}, '.btn-thumb');

	$(document).on('click', '.wc-up', function(e) {
		$(this).addClass('voted');
		$(this).next().addClass('voted');
	});
});
