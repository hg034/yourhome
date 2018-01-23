<?php
$action=$_GET['action'];
include("include/dbconnect.php");
include("include/header.php");
include("include/left.php");
print ("
<tr><td class='tdcont'>Neuen Artikel speichern</td></tr>
<tr><td>&nbsp;</td></tr>");
if ($action=='2') {
$ts=time();
$fehler = "";
//formular pruefen
$kategorie = $_POST['kategorie']; $artnr = $_POST['artnr'];
$titel = $_POST['titel']; $preis = $_POST['preis']; $beschreibung = $_POST['beschreibung'];
if (empty($_POST['artnr']) || empty($_POST['titel']) || empty($_POST['preis']) || empty($_POST['beschreibung'])) { $formok=0; $fehler .= "- Bitte f&uuml;llen Sie alle gekennzeichneten Felder aus.<br>"; } else {$formok=1;}
//bild pruefen
$newdatei=""; $breite=""; $hoehe=""; $typeok=1;
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
}
//////////
if (($typeok == '1') && ($formok == '1')) {
$preis =  ereg_replace(",", ".", $preis);
$titel =  ereg_replace("&", "&amp;", $titel);
$titel = str_replace(array("<",">","\$","{","}","[","]","\""),"",$titel);
$titel = str_replace(array("ä","ö","ü","Ä","Ö","Ü","ß"),array("&auml;","&ouml;","&uuml;","&Auml;","&Ouml;","&Uuml;","&szlig;"),$titel);
$beschreibung =  ereg_replace("&", "&amp;", $beschreibung);
$beschreibung = str_replace(array("<",">","\$","{","}","[","]","\""),"",$beschreibung);
$beschreibung = str_replace(array("ä","ö","ü","Ä","Ö","Ü","ß"),array("&auml;","&ouml;","&uuml;","&Auml;","&Ouml;","&Uuml;","&szlig;"),$beschreibung);
$beschreibung =  ereg_replace("\n", "<br>", $beschreibung);
$beschreibung =  ereg_replace("\r", "", $beschreibung);
//in DB speichern
$eintragen = "INSERT INTO `shopartikel` (`db_artid`, `db_artkat`, `db_artts`, `db_artnr`, `db_arttitel`, `db_artpreis`, `db_artimg`, `db_artimgw`, `db_artimgh`, `db_artdescr`) VALUES ('', '$kategorie', '$ts', '$artnr', '$titel', '$preis', '', '', '', '$beschreibung')";
$eintrag = mysqli_query($verbindung, $eintragen);
//Artid auslesen
$sqla1 = "SELECT * FROM shopartikel WHERE db_artts = '$ts'";
$resa1 = mysqli_query($verbindung, $sqla1);
while($row = mysqli_fetch_assoc($resa1)) {
$db_artid = $row['db_artid'];
}
$artikelid=$db_artid;
if ($uploaddatei != '') {
//Bild hochladen
$size = getimagesize($tmpdatei);
$breite = $size[0];
$hoehe = $size[1];
$newdatei = "art".$artikelid.$endung;
$newdatei1 = "../artikel/".$newdatei;
//Datei hochladen
move_uploaded_file($_FILES['datei']['tmp_name'], "../artikel/$newdatei");
//Update
$aendern = "UPDATE shopartikel SET db_artimg = '$newdatei' WHERE db_artid = '$artikelid'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE shopartikel SET db_artimgw = '$breite' WHERE db_artid = '$artikelid'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE shopartikel SET db_artimgh = '$hoehe' WHERE db_artid = '$artikelid'";
$upd = mysqli_query($verbindung, $aendern);
}
//ausgabe
print ("<tr><td>Der Artikel wurde gespeichert.<br><br><a href='artikel.php?back=1&kat=0&action=details&artikel=$artikelid&next=0&page=1'>zu den Artikeldetails</a></td></tr>");
}
else {
print ("
<tr><td>Wenn Sie kein Artikelbild haben, lassen Sie das Feld &quot;Artikelbild&quot; frei.</td></tr><tr><td>&nbsp;</td></tr>
<tr><td class='tdf'>$fehler</td></tr><tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='newartikel.php?action=2' method='POST' enctype='multipart/form-data'>
<tr><td width=160><b>Artikelbild w&auml;hlen:</b></td><td width=400><input name='datei' type='file' class='tf'></td></tr><tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr height=22><td width=160><b>Kategorie:</b></td><td width=400>
<select name='kategorie' class='tf' style='width:400px;'>");
$sqlk1 = "SELECT * FROM kategorien";
$resk1 = mysqli_query($verbindung, $sqlk1);
while($row = mysqli_fetch_assoc($resk1)) {
$db_katid = $row['db_katid'];
$db_kategorie = $row['db_kategorie'];
print ("<option value='$db_katid'");
if ($db_katid==$kategorie) {print (" selected");}
print (">$db_kategorie");
}
print ("</select>
</td></tr>
<tr height=22><td");
if (empty($_POST['artnr'])) { print (" class='tdf'"); }
print ("><b>Artikelnummer:</b></td>
<td><input type='text' name='artnr' style='width:400px;' class='tf' value='$artnr'></td></tr>
<tr height=22><td");
if (empty($_POST['titel'])) { print (" class='tdf'"); }
print ("><b>Artikel:</b></td>
<td><input type='text' name='titel' style='width:400px;' class='tf' value='$titel'></td></tr>
<tr height=22><td");
if (empty($_POST['preis'])) { print (" class='tdf'"); }
print ("><b>Verkaufspreis:</b></td>
<td><input type='text' name='preis' style='width:200px;' class='tf' value='$preis'> in $db_adminwaehrung</td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr><td colspan=2 height=20");
if (empty($_POST['beschreibung'])) { print (" class='tdf'"); }
print ("><b>Beschreibung:</b></td></tr>
<tr><td colspan=2><textarea name='beschreibung' rows='15' cols='56' style='width:560px;' class='tf1'>$beschreibung</textarea></td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr><td colspan=2><input type='submit' name='update' value='Artikel speichern' style='width:560px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");
}
}
if ($action=='1') {
print ("
<tr><td>Wenn Sie kein Artikelbild haben, lassen Sie das Feld &quot;Artikelbild&quot; frei.</td></tr>
<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='newartikel.php?action=2' method='POST' enctype='multipart/form-data'>
<tr><td width=160><b>Artikelbild w&auml;hlen:</b></td><td width=400><input name='datei' type='file' class='tf'></td></tr><tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr height=22><td width=160><b>Kategorie:</b></td><td width=400>
<select name='kategorie' class='tf' style='width:400px;'>");
$sqlk1 = "SELECT * FROM kategorien";
$resk1 = mysqli_query($verbindung, $sqlk1);
while($row = mysqli_fetch_assoc($resk1)) {
$db_katid = $row['db_katid'];
$db_kategorie = $row['db_kategorie'];
print ("<option value='$db_katid'>$db_kategorie");
}
print ("</select>
</td></tr>
<tr height=22><td><b>Artikelnummer:</b></td>
<td><input type='text' name='artnr' style='width:400px;' class='tf' value='$db_artnr'></td></tr>
<tr height=22><td><b>Artikel:</b></td>
<td><input type='text' name='titel' style='width:400px;' class='tf' value='$db_arttitel'></td></tr>
<tr height=22><td><b>Verkaufspreis:</b></td>
<td><input type='text' name='preis' style='width:200px;' class='tf' value='$db_artpreis'> in $db_adminwaehrung</td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr><td colspan=2 height=20><b>Beschreibung:</b></td></tr>
<tr><td colspan=2><textarea name='beschreibung' rows='15' cols='56' style='width:560px;' class='tf1'>$db_artdescr</textarea></td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr><td colspan=2><input type='submit' name='update' value='Artikel speichern' style='width:560px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");
}
include("include/footer.php");
mysqli_close($verbindung);
?>