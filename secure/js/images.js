$('.delete-link').click(function( e ){
	var confirmString = "Are you sure you want to delete this image? You wont be able to restore it.";
	if(!confirm(confirmString)){
		e.preventDefault();
	};
	
});