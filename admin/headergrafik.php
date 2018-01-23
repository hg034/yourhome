<?php
$action=$_GET['action'];
include("include/dbconnect.php");
include("include/header.php");
include("include/left.php");
print ("<tr><td class='tdcont'>eigene Headergrafik hochladen</td></tr>
<tr><td>&nbsp;</td></tr>
");
if ($action=='2') {
$fehler=""; $sizeok=0;
//bild pruefen
$uploaddatei = $_FILES['datei']['name'];
$tmpdatei = $_FILES['datei']['tmp_name'];
$dateityp = $_FILES['datei']['type'];
if ($uploaddatei != '') {
if (($dateityp == 'image/gif') || ($dateityp == 'image/jpeg') || ($dateityp == 'image/png')) {
$typeok = 1;
if ($dateityp == 'image/gif') { $endung = ".gif"; $endung1 = "IMAGE"; }
if ($dateityp == 'image/jpeg') { $endung = ".jpeg"; $endung1 = "IMAGE"; }
if ($dateityp == 'image/png') { $endung = ".png"; $endung1 = "IMAGE"; }
}
else { $typeok = 0; $fehler .= "- Es sind nur die Bild-Formate GIF, JPEG und PNG erlaubt!<br>"; }
$size = getimagesize($tmpdatei);
$breite = $size[0];
$hoehe = $size[1];
if ($breite=='880') { $sizeok=1;} else {
$sizeok=0; $fehler .= "- Die Grafik muss 880 Pixel breit sein.<br>";
}
}
else { $sizeok=0; $typeok = 0; $fehler .= "- Bitte w&auml;hlen Sie eine Datei aus!<br>"; }
//////////
if (($typeok == '1') && ($sizeok == '1')) {
$ts=time();
$newdatei = "head".$ts.$endung;
$newdatei1 = "../img/".$newdatei;
//Datei hochladen
move_uploaded_file($_FILES['datei']['tmp_name'], "../img/$newdatei");
$aendern = "UPDATE admin SET db_adminheadimg = '$newdatei' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
print ("<tr><td>Die neue Grafik wurde hochgeladen!</td></tr>");
}
else {
print ("
<tr><td class='tdf'>$fehler</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='headergrafik.php?action=2' method='POST' enctype='multipart/form-data'>
<tr><td width=160><b>Grafik w&auml;hlen:</b></td><td width=400><input name='datei' type='file' class='tf'></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><input type='submit' name='update' value='Grafik speichern' style='width:400px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");
}
}
if ($action=='1') {
print ("
<tr><td>Die Grafik muss 880 Pixel breit und vom Dateityp GIF, JPEG oder PNG sein.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='headergrafik.php?action=2' method='POST' enctype='multipart/form-data'>
<tr><td width=160><b>Grafik w&auml;hlen:</b></td><td width=400><input name='datei' type='file' class='tf'></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><input type='submit' name='update' value='Grafik speichern' style='width:400px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");
}
include("include/footer.php");
mysqli_close($verbindung);
?>