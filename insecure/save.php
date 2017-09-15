<?php
$file = fopen("file.txt", "a");
fwrite($file, "Name: ".$_POST["Name"]."\r\n");
fwrite($file, "Vorname: ".$_POST["Vorname"]."\r\n");
fwrite($file, "Strasse: ".$_POST["Strasse"]."\r\n");
fwrite($file, "Ort: ".$_POST["Ort"]."\r\n");
fwrite($file, "PLZ: ".$_POST["PLZ"]."\r\n");
fwrite($file, "E-Mail: ".$_POST["Mail"]."\r\n");
fwrite($file, "Gruppe: ".$_POST["Gruppe"]."\r\n");
fwrite($file, "Land: ".$_POST["Land"]."\r\n");
fwrite($file, "Sprache: ");
if(isset($_POST["Deutsch"])){
	fwrite($file, $_POST["Deutsch"]." ");
}
if(isset($_POST["Franzoesisch"])){
	fwrite($file, $_POST["Franzoesisch"]." ");
}
if(isset($_POST["Italienisch"])){
	fwrite($file, $_POST["Italienisch"]." ");
}
if(isset($_POST["Englisch"])){
	fwrite($file, $_POST["Englisch"]." ");
}

fwrite($file,"\r\n\r\n");
echo "Ihre Daten wurden erfolgreich gespeichert.";
echo "<br><button><a href='index.php?inhalt_mitte=schlosslauf.php'>Zur&uuml;ck</a></button>";
?>