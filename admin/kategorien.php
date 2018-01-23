<?php
$action=$_GET['action'];
include("include/dbconnect.php");
include("include/header.php");
include("include/left.php");
$meldung="";
if ($action=='new') {
$kategorie=$_POST['kategorie'];
$kategorie = str_replace(array("<",">","\$","{","}","[","]"),"",$kategorie);
$kategorie = str_replace("&","&amp;",$kategorie);
$kategorie = str_replace(array("ä","ö","ü","Ä","Ö","Ü","ß"),array("&auml;","&ouml;","&uuml;","&Auml;","&Ouml;","&Uuml;","&szlig;"),$kategorie);
$eintragen = "INSERT INTO `kategorien` (`db_katid`, `db_kategorie`) VALUES ('', '$kategorie')";
$eintrag = mysqli_query($verbindung, $eintragen);
$meldung="Die Kategorie wurde hinzugef&uuml;gt!";
}
if ($action=='del') {
$kat=$_GET['kat'];
$loeschen = "DELETE FROM kategorien WHERE db_katid = '$kat'";
$loesch = mysqli_query($verbindung, $loeschen);
$meldung="Die Kategorie wurde gel&ouml;scht!";
}
if ($action=='2') {
$kat=$_GET['kat'];
$kategorie=$_POST['kategorie'];
$kategorie = str_replace(array("<",">","\$","{","}","[","]"),"",$kategorie);
$kategorie = str_replace("&","&amp;",$kategorie);
$kategorie = str_replace(array("ä","ö","ü","Ä","Ö","Ü","ß"),array("&auml;","&ouml;","&uuml;","&Auml;","&Ouml;","&Uuml;","&szlig;"),$kategorie);
$aendern = "UPDATE kategorien SET db_kategorie = '$kategorie' WHERE db_katid = '$kat'";
$upd = mysqli_query($verbindung, $aendern);
$meldung="Die Kategorie wurde ge&auml;ndert!";
}
print ("
<tr><td class='tdcont'>neue Kategorie</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='kategorien.php?action=new' method='POST'>
<tr height=22><td width=160>Kategorie:</td>
<td width=400><input type='text' name='kategorie' style='width:400px;' class='tf' value=''></td></tr>
<tr><td colspan=2 id='space' height=5>&nbsp;</td></tr>
<tr height=22><td>&nbsp;</td>
<td><input type='submit' name='update' value='Kategorie speichern' style='width:400px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td class='tdcont'>Kategorien &auml;ndern/l&ouml;schen</td></tr>
<tr><td>&nbsp;</td></tr>");
if ($action!='1') {print ("<tr><td>$meldung</td></tr><tr><td>&nbsp;</td></tr>");}
print ("
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>");
$sqlk1 = "SELECT * FROM kategorien";
$resk1 = mysqli_query($verbindung, $sqlk1);
while($row = mysqli_fetch_assoc($resk1)) {
$db_katid = $row['db_katid'];
$db_kategorie = $row['db_kategorie'];
print ("
<form action='kategorien.php?action=2&kat=$db_katid' method='POST'>
<tr height=22>
<td width=440><input type='text' name='kategorie' style='width:440px;' class='tf' value='$db_kategorie'></td>
<td width=100 align=right><input type='submit' name='update' value='&auml;ndern' style='width:90px;' class='bt'></td>
<td width=20 align=right><a href='kategorien.php?action=del&kat=$db_katid'><img src='img/trash.gif' width='15' height='16' border='0'></a></td>
</tr>
</form>
");
}
print ("


</table>
</td></tr>
");

include("include/footer.php");
mysqli_close($verbindung);
?>