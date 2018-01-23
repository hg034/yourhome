<?php
$action=$_GET['action']; $next=$_GET['next']; $page=$_GET['page'];
$prosite = 20;
include("include/dbconnect.php");
include("include/header.php");
include("include/left.php");
if (($action!=1) && ($action!=2)) {
$back=$_GET['back'];
if ($back=='1') {$kat=0; $backlink="artikel.php?action=1&next=$next&page=$page";}
if ($back=='2') {$kat=$_GET['kat']; $backlink="artikel.php?action=2&kat=$kat&next=$next&page=$page";}
print ("<tr><td class='tdcont'>Artikel</td></tr>
<tr><td height=15>&nbsp;</td></tr>
<tr><td height=450 valign=top>
<table width=560 border=0 cellpadding=0 cellspacing=0>");
}
if ($action=='deleteimg') {
$artikel = $_GET['artikel'];
$image=$_GET['image'];
$aendern = "UPDATE shopartikel SET db_artimg = '' WHERE db_artid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE shopartikel SET db_artimgw = '' WHERE db_artid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE shopartikel SET db_artimgh = '' WHERE db_artid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);

$imgdat = "../artikel/".$image;
unlink ($imgdat);
print ("<tr><td>Das Artikelbild $image wurde gel&ouml;scht!</td></tr>");
}
if ($action=='delimg') {
$image=$_GET['image'];
$artikel = $_GET['artikel'];
print ("<tr><td>M&ouml;chten Sie das Artikelbild $image wirklich l&ouml;schen? Diese Aktion ist nicht r&uuml;ckg&auml;ngig zu machen!<br><br><a href='artikel.php?back=$back&kat=$kat&action=deleteimg&artikel=$artikel&image=$image&next=$next&page=$page'><b>Ja, das Artikelbild jetzt l&ouml;schen!</b></a></td></tr>");
}
if ($action=='upload') {
$artikel = $_GET['artikel']; $img = $_GET['img'];
$fehler = "";
$uploaddatei = $_FILES['datei']['name'];
$tmpdatei = $_FILES['datei']['tmp_name'];
$dateityp = $_FILES['datei']['type'];
if ($uploaddatei == '') { $dateiok = 0; $fehler .= "- Bitte w&auml;hlen Sie eine Datei aus!<br>"; } else { $dateiok = 1; }
//Endung ermitteln
if (($dateityp == 'image/gif') || ($dateityp == 'image/jpeg') || ($dateityp == 'image/png')) {
$typeok = 1;
if ($dateityp == 'image/gif') { $endung = ".gif"; $endung1 = "IMAGE"; }
if ($dateityp == 'image/jpeg') { $endung = ".jpeg"; $endung1 = "IMAGE"; }
if ($dateityp == 'image/png') { $endung = ".png"; $endung1 = "IMAGE"; }
}
else { $typeok = 0; $fehler .= "- Es sind nur die Formate GIF, JPEG und PNG erlaubt!<br>"; }

if (($dateiok == '1') && ($typeok == '1')) {
//bildmaße ermitteln
$size = getimagesize($tmpdatei);
$breite = $size[0];
$hoehe = $size[1];
$newdatei = "art".$artikel.$endung;
$newdatei1 = "..artikel/".$newdatei;
//Datei hochladen
move_uploaded_file($_FILES['datei']['tmp_name'], "../artikel/$newdatei");
//in DB eintragen
$aendern = "UPDATE shopartikel SET db_artimg = '$newdatei' WHERE db_artid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE shopartikel SET db_artimgw = '$breite' WHERE db_artid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE shopartikel SET db_artimgh = '$hoehe' WHERE db_artid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);

print ("<tr><td>Die Datei wurde hochgeladen!<br><br><a href='artikel.php?back=$back&kat=$kat&action=details&artikel=$artikel&next=$next&page=$page'>zur&uuml;ck zu den Artikeldetails</a></td></tr>");
}
else {
print ("<tr><td class='tdf'>$fehler</td></tr><tr><td height=30>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form enctype='multipart/form-data' action='artikel.php?back=$back&kat=$kat&action=upload&artikel=$artikel&img=$img&next=$next&page=$page' method='POST'>
<tr><td width=160>Bild hochladen:</td><td width=400><input name='datei' type='file' class='tf'></td></tr>
<tr><td colspan=2 id='space' height=20>&nbsp;</td></tr>
<tr><td colspan=2><input type='submit' name='update' value='neues Bild f&uuml;r diesen Artikel hochladen' style='width:560px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");
}
}

if ($action=='update') {
$artikel = $_GET['artikel']; $kategorie = $_POST['kategorie']; $artnr = $_POST['artnr'];
$titel = $_POST['titel']; $preis = $_POST['preis']; $beschreibung = $_POST['beschreibung'];
$titel = str_replace(array("<",">","\$","{","}","[","]","\""),"",$titel);
$titel = str_replace(array("ä","ö","ü","Ä","Ö","Ü","ß"),array("&auml;","&ouml;","&uuml;","&Auml;","&Ouml;","&Uuml;","&szlig;"),$titel);


$aendern = "UPDATE shopartikel SET db_artkat = '$kategorie' WHERE db_artid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE shopartikel SET db_artnr = '$artnr' WHERE db_artid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE shopartikel SET db_arttitel = '$titel' WHERE db_artid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE shopartikel SET db_artpreis = '$preis' WHERE db_artid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE shopartikel SET db_artdescr = '$beschreibung' WHERE db_artid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
print ("<tr><td>Die Artikeldaten wurden ge&auml;ndert!</td></tr>");
}

if ($action=='delete') {
$artikel = $_GET['artikel'];
$loeschen = "DELETE FROM shopartikel WHERE db_artid = '$artikel'";
$loesch = mysqli_query($verbindung, $loeschen);
print ("<tr><td>Der Artikel $artikel wurde gel&ouml;scht!</td></tr>");
}
if ($action=='del') {
$artikel = $_GET['artikel'];
print ("<tr><td>M&ouml;chten Sie den Artikel wirklich l&ouml;schen? Diese Aktion ist nicht r&uuml;ckg&auml;ngig zu machen!<br><br><a href='artikel.php?back=$back&kat=$kat&action=delete&artikel=$artikel&next=$next&page=$page'><b>Ja, den Artikel jetzt l&ouml;schen!</b></a></td></tr>");
}
if ($action=='details') {
$artikel = $_GET['artikel'];
$sqla1 = "SELECT * FROM shopartikel WHERE db_artid = '$artikel'";
$resa1 = mysqli_query($verbindung, $sqla1);
while($row = mysqli_fetch_assoc($resa1)) {
$db_artid = $row['db_artid'];
$db_artkat = $row['db_artkat'];
$db_artts = $row['db_artts'];
$db_artnr = $row['db_artnr'];
$db_arttitel = $row['db_arttitel'];
$db_artpreis = $row['db_artpreis'];
$db_artimg = $row['db_artimg'];
$db_artimgw = $row['db_artimgw'];
$db_artimgh = $row['db_artimgh'];
$db_artdescr = $row['db_artdescr'];
if ($db_artimg != '') { $image= "../artikel/".$db_artimg;    $img=1;
if ($db_artimgw>=$db_artimgh) {
$breite = "140"; $brprozent = ((100 * $breite) / $db_artimgw);
$hoehe = (($db_artimgh * $brprozent) / 100); $hoehe = (ceil ($hoehe));
}
else {
$hoehe = "93"; $brprozent = ((100 * $hoehe) / $db_artimgh);
$breite = (($db_artimgw * $brprozent) / 100); $breite = (ceil ($breite));
}
}
else {
$img=0;
$image = "../img/nopic1.png"; $breite = "140"; $hoehe = "93";
}
print ("
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<tr>
<td width=160 valign=top>");
if ($db_artimg != '') {
print ("<a href='#' onClick=\"javascript:open('$image','Details','width=$db_artimgw, height=$db_artimgh');\" onFocus='if (this.blur) this.blur()'><img src='$image' width='$breite' height='$hoehe' style='border:1px solid #CCCCCC;'></a>");
}
else {
print ("<img src='$image' width='$breite' height='$hoehe' style='border:1px solid #CCCCCC;'>");
}
print ("</td>
<td width=400 align=center valign=top>
<table width=400 border=0 cellpadding=0 cellspacing=0>
<tr><td width=200><a href='artikel.php?back=$back&kat=$kat&action=del&artikel=$artikel&next=$next&page=$page'><b>Artikel l&ouml;schen</b></a></td><td width=200 align=right>");
if ($db_artimg != '') { print ("<a href='artikel.php?back=$back&kat=$kat&action=delimg&artikel=$artikel&image=$db_artimg&next=$next&page=$page'><b>Artikelbild l&ouml;schen</b></a>"); }
print ("&nbsp;</td></tr>
<tr><td colspan=2 height=30>&nbsp;</td></tr>
<tr><td colspan=2>
<table width=400 border=0 cellpadding=0 cellspacing=0>
<form enctype='multipart/form-data' action='artikel.php?back=$back&kat=$kat&action=upload&artikel=$artikel&img=$img&next=$next&page=$page' method='POST'>
<tr><td width=140>Bild hochladen:</td><td width=260><input name='datei' type='file' class='tf'></td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr><td colspan=2><input type='submit' name='update' value='neues Bild f&uuml;r diesen Artikel hochladen' style='width:400px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
</table>
</td>
</tr>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td class='tdcont'>Artikeldaten &auml;ndern (Datenbank-ID: $db_artid)</td></tr>
<tr><td height=15>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='artikel.php?back=$back&kat=$kat&action=update&artikel=$artikel&next=$next&page=$page' method='POST'>
<tr height=22><td width=160><b>Kategorie:</b></td><td width=400>
<select name='kategorie' class='tf' style='width:400px;'>");
$sqlk1 = "SELECT * FROM kategorien";
$resk1 = mysqli_query($verbindung, $sqlk1);
while($row = mysqli_fetch_assoc($resk1)) {
$db_katid = $row['db_katid'];
$db_kategorie = $row['db_kategorie'];
print ("<option value='$db_katid'");
if ($db_katid==$db_artkat) {print (" selected");}
print (">$db_kategorie");
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
<tr><td colspan=2><b>Beschreibung:</b></td></tr>
<tr><td colspan=2><textarea name='beschreibung' rows='10' cols='56' style='width:560px;' class='tf1'>$db_artdescr</textarea></td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr><td colspan=2><input type='submit' name='update' value='Artikeldaten &auml;ndern' style='width:560px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");
}
}
if (($action!=1) && ($action!=2)) {
print ("</table>
</td></tr>
<tr><td id='space' height=10>&nbsp;</td></tr>
<tr><td bgcolor='#CCCCCC'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td height=19 align=center><a href='$backlink'><b>zur&uuml;ck zur &Uuml;bersicht</b></a></td></tr>
");
 }
if ($action=='2') {
$kat=$_GET['kat'];
$prosite = 19;
if ($kat=='0') { $sqla0 = "SELECT * FROM shopartikel"; }
else { $sqla0 = "SELECT * FROM shopartikel WHERE db_artkat = '$kat'"; }
$resa0 = mysqli_query($verbindung, $sqla0); $za0 = mysqli_num_rows($resa0);
$contseiten = $za0 / $prosite; $contseiten1 = (ceil ($contseiten));
print ("<tr><td class='tdcont'>Artikel</td></tr>
<tr><td height=20 align=right>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='artikel.php' method='GET'>
<input type='hidden' name='action' value='2'><input type='hidden' name='next' value='0'><input type='hidden' name='page' value='1'><input type='hidden' name='back' value='2'>
<tr><td width=520 align=right>
<select name='kat' class='tf' style='width:300px;'>
<option value='0'");
if ($kat=='0') {print (" selected");}
print (">alle Kategorien");
$sqlk1 = "SELECT * FROM kategorien";
$resk1 = mysqli_query($verbindung, $sqlk1);
while($row = mysqli_fetch_assoc($resk1)) {
$db_katid = $row['db_katid'];
$db_kategorie = $row['db_kategorie'];
print ("<option value='$db_katid'");
if ($kat==$db_katid) {print (" selected");}
print (">$db_kategorie");
}
print ("</select></td>
<td width=40 align=right><input type='submit' name='update' value='Go' style='width:30px;' class='bt1'></td></tr>
</form>
</table>
</td></tr>
<tr><td height=430 valign=top>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<tr height=20><td width=40><b>ID</b></td><td width=350><b>Artikel</b></td>
<td width=50 align=right><b>Preis</b></td><td width=100 align=right>&nbsp;</td>
<td width=20 align=right>&nbsp;</td></tr>
<tr><td bgcolor='#CCCCCC' colspan=5><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr><tr><td height=15>&nbsp;</td></tr>");
if ($kat=='0') { $sqla1 = "SELECT * FROM shopartikel ORDER by db_artid DESC limit $next, $prosite"; }
else { $sqla1 = "SELECT * FROM shopartikel WHERE db_artkat = '$kat' ORDER by db_artid DESC limit $next, $prosite"; }
$resa1 = mysqli_query($verbindung, $sqla1);
while($row = mysqli_fetch_assoc($resa1)) {
$db_artid = $row['db_artid'];
$db_artkat = $row['db_artkat'];
$db_artts = $row['db_artts'];
$db_artnr = $row['db_artnr'];
$db_arttitel = $row['db_arttitel'];
$db_artpreis = $row['db_artpreis'];
$db_artimg = $row['db_artimg'];
$db_artimgw = $row['db_artimgw'];
$db_artimgh = $row['db_artimgh'];
$db_artdescr = $row['db_artdescr'];
print ("<form action='artikel.php?back=2&kat=$kat&action=details&artikel=$db_artid&next=$next&page=$page' method='POST'>
<tr height=20><td width=40>$db_artid</td>
<td width=350>$db_arttitel</td>
<td width=50 align=right>$db_artpreis</td>
<td width=100 align=right><input type='submit' name='update' value='Details' style='width:90px;' class='bt'></td>
<td width=20 align=right><a href='artikel.php?back=2&kat=$kat&action=del&artikel=$db_artid&next=$next&page=$page'><img src='img/trash.gif' width='15' height='16' border='0'></a></td>
</tr></form>");
}
print ("</table>
</td></tr>
<!---------------->
<tr><td id='space' height=10>&nbsp;</td></tr>
<tr><td bgcolor='#CCCCCC'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td height=19 align=center>");
$p = 1; $newstart = 0;
for ($a = 1; $a <= $contseiten1; $a++) {
if ($contseiten1 >= '$p') {
print ("<a href='artikel.php?action=1&next=$newstart&page=$p'");
if ($p == $page) { print (" class='aaktiv'>[$p]"); }
else { print (" class='ainaktiv'>[$p]"); }
if ($p < $contseiten1) { print ("&nbsp;"); }
}
$p++;
$newstart = $newstart + $prosite;
}
print ("</td></tr>
");
}
if ($action=='1') {
$sqla0 = "SELECT * FROM shopartikel";
$resa0 = mysqli_query($verbindung, $sqla0); $za0 = mysqli_num_rows($resa0);
$contseiten = $za0 / $prosite; $contseiten1 = (ceil ($contseiten));
print ("<tr><td class='tdcont'>Artikel</td></tr>
<tr><td height=15>&nbsp;</td></tr>
<tr><td height=450 valign=top>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<tr height=20><td width=40><b>ID</b></td><td width=350><b>Artikel</b></td>
<td width=50 align=right><b>Preis</b></td><td width=100 align=right>&nbsp;</td>
<td width=20 align=right>&nbsp;</td></tr>
<tr><td bgcolor='#CCCCCC' colspan=5><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr><tr><td height=15>&nbsp;</td></tr>");
$sqla1 = "SELECT * FROM shopartikel ORDER by db_artid DESC limit $next, $prosite";
$resa1 = mysqli_query($verbindung, $sqla1);
while($row = mysqli_fetch_assoc($resa1)) {
$db_artid = $row['db_artid'];
$db_artkat = $row['db_artkat'];
$db_artts = $row['db_artts'];
$db_artnr = $row['db_artnr'];
$db_arttitel = $row['db_arttitel'];
$db_artpreis = $row['db_artpreis'];
$db_artimg = $row['db_artimg'];
$db_artimgw = $row['db_artimgw'];
$db_artimgh = $row['db_artimgh'];
$db_artdescr = $row['db_artdescr'];
print ("<form action='artikel.php?back=1&action=details&artikel=$db_artid&next=$next&page=$page' method='POST'>
<tr height=20><td width=40>$db_artid</td>
<td width=350>$db_arttitel</td>
<td width=50 align=right>$db_artpreis</td>
<td width=100 align=right><input type='submit' name='update' value='Details' style='width:90px;' class='bt'></td>
<td width=20 align=right><a href='artikel.php?back=1&action=del&artikel=$db_artid&next=$next&page=$page'><img src='img/trash.gif' width='15' height='16' border='0'></a></td>
</tr></form>");
}
print ("</table>
</td></tr>
<!---------------->
<tr><td id='space' height=10>&nbsp;</td></tr>
<tr><td bgcolor='#CCCCCC'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td height=19 align=center>");
$p = 1; $newstart = 0;
for ($a = 1; $a <= $contseiten1; $a++) {
if ($contseiten1 >= '$p') {
print ("<a href='artikel.php?action=1&next=$newstart&page=$p'");
if ($p == $page) { print (" class='aaktiv'>[$p]"); }
else { print (" class='ainaktiv'>[$p]"); }
if ($p < $contseiten1) { print ("&nbsp;"); }
}
$p++;
$newstart = $newstart + $prosite;
}
print ("</td></tr>
");
}
include("include/footer.php");
mysqli_close($verbindung);
?>