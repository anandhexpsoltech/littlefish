jQuery(document).ready(function($){
	$('.TasksectionClone').hide();
	
	$('.addmore').click(function(e){
		var cloneHtml = $('.TasksectionClone').html();
		
		$('.tasksection').append(cloneHtml);		
		e.preventDefault();
		return false;
	});
	
	$(document).on("click", ".tasksectionRow .deletetaskrow", function(e) {
		//$(this).closest('.tasksection').remove(); 
		$(this).parents('.tasksectionRow').remove();	
		e.preventDefault();
		return false;
	});
	
});
