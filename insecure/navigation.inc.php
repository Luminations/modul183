<?php
$siteRoot="index.php?inhalt_mitte=";
$menuStruct = array("Home"=>array("root"=>$siteRoot."home.inc.php"),
                    "Vorwort"=>array("root"=>$siteRoot."vorwort.inc.php"),
                    "Eigenschaften"=>array("root"=>$siteRoot."eigenschaften.inc.php"),
                    "Aufgaben"=>array("root"=>$siteRoot."aufgaben.inc.php"),
					"Anmeldung Schlosslauf"=>array("root"=>$siteRoot."schlosslauf.php"),
					"Logout"=>array("root"=>$siteRoot."logout.php")
                   );
$url = "";
if(isset($_GET["inhalt_mitte"])){
	$aktuell = $_GET["inhalt_mitte"]; 
	$url = $siteRoot.$aktuell;
}
foreach($menuStruct as $key=>$value)
{
  if($url == $value['root'])
  {
    echo "<a  class=\"fstLevelActive\" href=".$value['root'].">$key</a>\n";
  }
  else
  {
    echo "<a class=\"fstLevel\" href=".$value['root'].">$key</a>\n";
  }
}
?>