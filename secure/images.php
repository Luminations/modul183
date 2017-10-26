<?php
session_start();
include("php/sql.php");
?>
<!doctype html>
<html>
<head>
    <title>Secure Paintings</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <link rel="stylesheet" href="style/css/login.css">
</head>
<body id="body">
	<div class="pure-g" id="overlay-wrapper">
		<div class="pure-u-1-4 gallery">
			<a href="index.php"><h2>Get back to drawing</h2></a>
		</div>
		<div class="pure-u-1-2 main">
			
			<h1 id="gallery-title">Gallery</h1>
			<?php
				$MySql = new Sql();
				if(isset($_POST['delete']) && !empty($_POST['delete'])){
					$MySql->deleteImage($_POST['delete']);
				}
				$images = $MySql->displayImages();
				foreach($images as $image){
					?>
					<form method="POST" class="pure-form image-container">
						<h2><?php echo $image['title']; ?></h2>
						<img src="<?php echo $image['imageuri'] ?>" class="image">
						<button name="delete" type="submit" class="delete-link pure-button" value="<?php echo $image['imgid'] ?>">delete</button>
					</form>
					<?php
				}
			?>
		</div>
		<div class="pure-u-1-4 galery">
		</div>
	</div>
<script src="https://code.jquery.com/jquery-1.11.1.js"></script>
<script src="js/images.js"></script>
</body>
</html>