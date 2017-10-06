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
		console.log(imgUri);
		$.ajax({
			url: "php/api.php",
			method: "POST",
			data: { title: "Painting 1", imgUri: imgUri },
			beforeSend: function( xhr ) {
				console.log("sending..");
			}
		})
		.done(function( data ) {
			var win = window.open(imgUri, '_blank');
			if (win) {
				//Browser has allowed it to be opened
				win.focus();
			} else {
				//Browser has blocked it
				alert('Please allow popups for this website');
			}
		});
	});
	
});