<?php
$action=$_GET['action']; $id=$_GET['id'];
include("include/dbconnect.php");
include("include/header.php");
include("include/left.php");

if ($action=='2') {
$inhalt=$_POST['inhalt'];
$inhalt = str_replace(array("ä","ö","ü","Ä","Ö","Ü","ß"),array("&auml;","&ouml;","&uuml;","&Auml;","&Ouml;","&Uuml;","&szlig;"),$inhalt);
$aendern = "UPDATE texte SET db_txtcontent = '$inhalt' WHERE db_txtid = '$id'";
$upd = mysqli_query($verbindung, $aendern);
}

if ($id=='1') { $header="Impressum"; }
if ($id=='2') { $header="Disclaimer"; }
if ($id=='3') { $header="Copyright"; }
if ($id=='4') { $header="AGB"; }
if ($id=='5') { $header="Widerrufsrecht"; }
if ($id=='6') { $header="Zahlung/Versand"; }
if ($id=='7') { $header="Header Startseite"; }
if ($id=='8') { $header="Text Startseite"; }
if ($id=='9') { $header="Fusszeile"; }
if ($id=='10') { $header="Meta-Tags - description"; }
if ($id=='11') { $header="Meta-Tags - keywords"; }

$sqlt = "SELECT * FROM texte WHERE db_txtid = '$id'";
$rest = mysqli_query($verbindung, $sqlt);
while($row = mysqli_fetch_assoc($rest)) {
$db_txtid = $row['db_txtid'];
$db_txtcontent = $row['db_txtcontent'];
print ("
<tr><td class='tdcont'>Text &auml;ndern - $header</td></tr>
<tr><td>&nbsp;</td></tr>");
if ($id=='10') {
print ("<tr><td>Beschreibung Ihres Shops. Geben Sie hier 2 bis 3 aussagekr&auml;ftige S&auml;tze ein die als Ergebnis in Suchmaschinen angezeigt werden sollen.</td></tr><tr><td>&nbsp;</td></tr>");
}
if ($id=='11') {
print ("<tr><td>Geben Sie hier die keywords ein nach denen Ihre Webseite gefunden werden soll. Getrennt durch Komma.</td></tr><tr><td>&nbsp;</td></tr>");
}

print ("<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='texte.php?action=2&id=$id' method='POST'>
<tr><td><textarea name='inhalt' rows='30' cols='56' style='width:560px;' class='tf1'>$db_txtcontent</textarea></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td><input type='submit' name='update' value='Text &auml;ndern' style='width:560px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");
}
include("include/footer.php");
mysqli_close($verbindung);
?>