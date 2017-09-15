<br>
<title>Anmeldung Schlosslauf</title>
<script type="text/javascript">
function chkFormular () {

 var format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
  if (document.Formular.Name.value == "") {
    alert("Bitte Ihren Namen eingeben!");
    document.Formular.Name.focus();
    return false;
  }
  if (document.Formular.Vorname.value == "") {
    alert("Bitte Ihren Vornamen eingeben!");
    document.Formular.Vorname.focus();
    return false;
  }
  if (document.Formular.Strasse.value == "") {
    alert("Bitte Ihre Strasse eingeben!");
    document.Formular.Strasse.focus();
    return false;
  }
  if (document.Formular.Ort.value == "") {
    alert("Bitte Ihren Wohnort eingeben!");
    document.Formular.Ort.focus();
    return false;
  }
  if (document.Formular.PLZ.value == "") {
    alert("Bitte Ihre PLZ eingeben!");
    document.Formular.PLZ.focus();
    return false;
  }
  if (document.Formular.Mail.value == "") {
    alert("Bitte Ihre E-Mail-Adresse eingeben!");
    document.Formular.Mail.focus();
    return false;
  }
 

  if (!document.Formular.Mail.value.match(format)) {
    alert("Keine E-Mail-Adresse!");
    document.Formular.Mail.focus();
    return false;
  }
  var chkZ = 1;
  for (i = 0; i < document.Formular.PLZ.value.length; ++i)
    if (document.Formular.PLZ.value.charAt(i) < "0" ||
        document.Formular.PLZ.value.charAt(i) > "9")
      chkZ = -1;
  if (chkZ == -1) {
    alert("PLZ keine Zahl!");
    document.Formular.PLZ.focus();
    return false;
  }if (!document.Formular.Deutsch.checked && !document.Formular.Franzoesisch.checked && !document.Formular.Italienisch.checked && !document.Formular.Englisch.checked) {
    alert("Bitte Sprache wählen!");
    document.Formular.Deutsch.focus();
    return false;
  }
  
  
}
</script>
</head>
<body>

<h2>Anmeldung Schlosslauf</h2>

<form name="Formular" action="save.php"
  method="post" onsubmit="return chkFormular()">
<table>
<tr><td>Name:</td><td><input type="text"name="Name"></td></tr>
<tr><td>Vorname: </td><td>    <input type="text"name="Vorname"></td></tr>
<tr><td>Strasse: </td><td> <input type="text"  name="Strasse"></td></tr>
<tr><td>Ort:</td><td>  <input type="text" name="Ort"></td></tr>
<tr><td>PLZ: </td><td> <input type="text"  name="PLZ"></td></tr>
<tr><td>E-Mail:  </td><td> <input type="text"  name="Mail"></td></tr>
<tr><td>Gruppe:  </td><td>  <select  name="Gruppe">
				<option value="a">A</option>
				<option value="b">B</option>
				<option value="c">C</option>
			</select></td></tr>
<tr><td>Land:  </td><td>  <select  name="Land">
	<option value="schweiz">Schweiz</option>
	<option value="deutschland">Deutschland</option>
	<option value="italien">Italien</option>
	<option value="frankreich">Frankreich</option>
</select></td></tr>
<tr><td>Sprache:</td><td><input type="checkbox" value="Deutsch" name="Deutsch">Deutsch
<input type="checkbox" value="Franzoesisch" name="Franzoesisch">Franz&ouml;sisch
<input type="checkbox" value="Italienisch" name="Italienisch">Italienisch
<input type="checkbox" value="Englisch" name="Englisch">Englisch
</td></tr>
<tr><td><input type="submit" value="Absenden"></td><td><input type="reset" value="Abbrechen"></td></tr>
</table>
</form>