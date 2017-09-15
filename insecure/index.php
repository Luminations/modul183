<?php
	require_once("login_functions.php");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="screen.css" />
</head>
<body>
	
<div id="kopf"> 
  <?PHP
    include "kopf.inc.php";	
  ?>
</div>
  
<div id="inhalt_links">
    <?PHP
	if(isLoggedIn()){
		include "navigation.inc.php";
	}
    ?>
</div>
			
			
<div id="inhalt_mitte"> 
    <?PHP
	if(isLoggedIn()){
		if(isset($_GET["inhalt_mitte"])){    
			include($_GET["inhalt_mitte"]);
		}
		else{
			include("home.inc.php");	
		}
	}else{
		include("login_form.php");
	}
    ?>      
</div>
        
</body>
</html>