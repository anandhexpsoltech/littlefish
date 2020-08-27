jQuery(function($){
	jQuery(document).ready(function($){
		if ($('.set_custom_images').length > 0) {
			if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
				$(document).on('click', '.set_custom_images', function(e) {
					e.preventDefault();
					var button = $(this);
					var id = button.prev();
					wp.media.editor.send.attachment = function(props, attachment) {
						//~ alert(JSON.stringify(attachment));
						id.val(attachment.id);
						if(attachment.type == 'image'){
							$('.uploadedImage').html("<img src='"+attachment.url+"' width='250'>");
						} else if(attachment.type == 'audio' || attachment.type == 'video' || attachment.type == 'application' ){
							$('.uploadedImage').html("File Name: "+attachment.filename);
						}
					};
					wp.media.editor.open(button);
					return false;
				});
			}
		}
	});
});
