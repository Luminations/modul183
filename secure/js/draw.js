$.getScript('js/classes/Drawing.inc.js', function(){
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
	
});