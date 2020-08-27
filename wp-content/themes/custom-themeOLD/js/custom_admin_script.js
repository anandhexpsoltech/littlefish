jQuery(document).ready(function($){
	$('.deleteUploaded').click(function(){
		var id = $(this).attr('attachment-id');
		var clickedDiv = $(this);
		$.ajax({
			type : "post",
			dataType : "json",
			url : ajaxurl,
			data : {action: "delete_uploaded", id: id},
			success: function(response) {
				if(response == 1){
					alert('File deleted successfully.');
					clickedDiv.closest("li").remove(); 
				} else {
					alert('Error in deleting data. Please try againlater.');
				}
			}
		});
	});
});
