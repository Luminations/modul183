$.getScript('js/classes/Drawing.inc.js', function(){
	
	$("form").submit(function(e){
		e.preventDefault();
	});
	
	var element = document.getElementById('char');
	Drawing.setCanvas(element);
	
	element.addEventListener("mousemove", function(e) {
		Drawing.updateCursorPosition(e);
		if(Drawing.isDown === 1){
			var coordinates = [e.pageX, e.pageY];
			if(Drawing.checkLocation(coordinates)) {
				Drawing.draw();
			}
		}
	});

	window.addEventListener("mousedown", function(e){
		var coordinates = [e.pageX, e.pageY];
		if(Drawing.checkLocation(coordinates)){
			Drawing.savePaths();
			Drawing.setIsDown(1);
		}
	});

	window.addEventListener("mouseup", function(e){
		Drawing.setIsDown(0);
	});
	
	$("#submit").click(function(){
		var imgUri = Drawing.canvasToUrl();
		var title = $("#image-title").val();
		if (!title.trim()) {
			// is empty or whitespace
			title = "Untitled";
		}
		$.ajax({
			url: "php/api.php",
			method: "POST",
			data: { title: title, imgUri: imgUri }
		})
		.done(function( data ) {			
			alert(data);
		});
	});
	
	$('#logout').click(function(e){
		e.preventDefault();
		var win = window.open('php/logout.php', '_self');
	});
	
});