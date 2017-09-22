<!doctype html>
<html>
  <head>
    <title>Socket.IO chat</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
	<link rel="stylesheet" href="style/css/custom-overlay.css">
  </head>
  <body>
	<div class="pure-g" id="overlay-wrapper">
		<div class="pure-u-1-1 control-u">
			<form class="pure-form" id="draw-controls">

				<fieldset>

					<div class="control-group double-size">
						<input id="size" type="number" max="50" min="1" value="10">
						<label for="size"><span>Size</span></label>
					</div>

					<div class="control-group">
						<input id="color" type="color" value="#000000">
						<label for="color"><span>Color</span></label>
					</div>

					<div class="control-group">
						<input id="opacity" type="range" max="1" min="0.01" step="0.01" value="1">
						<label for="opacity"><span>Opacity</span></label>
					</div>

					<div class="control-group">
						<input id="eraser" class="draw-icon pure-button" type="button" onclick="Drawing.toggleEraser()">
						<label for="eraser"><span>Eraser</span></label>
					</div>

					<div class="control-group">
						<input id="clear" class="draw-icon pure-button" type="button" onclick="Drawing.clearCanvas()">
						<label for="clear"><span>Clear</span></label>
					</div>

					<div class="control-group">
						<input id="paint" class="draw-icon pure-button" type="button" onclick="Drawing.paintOver()">
						<label for="paint"><span>Paint</span></label>
					</div>

					<div class="control-group">
						<input id="back" class="draw-icon pure-button" type="button" onclick="Drawing.restorePaths()">
						<label for="back"><span>Back</span></label>
					</div>

					<div class="control-group">
						<button id="submit" class="draw-icon pure-button"></button>
						<label for="submit"><span>Submit</span></label>
					</div>

				</fieldset>
			</form>
		</div>
		<div class="pure-u-1-1 canvas-u">
			<div class="canvas-wrapper">
				<canvas name="canvas" id="char" class="char" height="300px" width="300px" onclick="Drawing.draw()"></canvas>
			</div>
		</div>
	</div>
    <script src="https://code.jquery.com/jquery-1.11.1.js"></script>
    <script src="js/draw.js"></script>
  </body>
</html>