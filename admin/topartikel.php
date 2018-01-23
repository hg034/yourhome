<?php
$action=$_GET['action'];
include("include/dbconnect.php");
include("include/header.php");
include("include/left.php");
print ("<tr><td class='tdcont'>Top-Artikel</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Hier k&ouml;nnen Sie Artikel w&auml;hlen, die in der rechten Spalte Ihres Shops in der Rubrik &quot;Top-Artikel&quot; angezeigt werden.</td></tr>
<tr><td>&nbsp;</td></tr>
");
if ($action=='del') {
$artikel=$_GET['artikel'];
$loeschen = "DELETE FROM topartikel WHERE db_topid = '$artikel'";
$loesch = mysqli_query($verbindung, $loeschen);
print ("<tr><td><b>Der Eintrag wurde aus den Top-Artikeln gel&ouml;scht!</b></td></tr><tr><td>&nbsp;</td></tr>");
}
if ($action=='update') {
$artikel=$_GET['artikel'];
$art=$_POST['art'];
$sqla1 = "SELECT * FROM shopartikel WHERE db_artid = '$art'";
$resa1 = mysqli_query($verbindung, $sqla1);
while($row = mysqli_fetch_assoc($resa1)) {
$db_artid = $row['db_artid'];
$db_arttitel = $row['db_arttitel'];
$db_artpreis = $row['db_artpreis'];
$db_artimg = $row['db_artimg'];
$db_artimgw = $row['db_artimgw'];
$db_artimgh = $row['db_artimgh'];
}
$aendern = "UPDATE topartikel SET db_topart = '$art' WHERE db_topid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE topartikel SET db_toptitel = '$db_arttitel' WHERE db_topid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE topartikel SET db_toppreis = '$db_artpreis' WHERE db_topid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE topartikel SET db_topimg = '$db_artimg' WHERE db_topid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE topartikel SET db_topimgw = '$db_artimgw' WHERE db_topid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE topartikel SET db_topimgh = '$db_artimgh' WHERE db_topid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
print ("<tr><td><b>Der Artikel wurde ge&auml;ndert!</b></td></tr><tr><td>&nbsp;</td></tr>");
}
if ($action=='new') {
$art=$_POST['art'];
$sqla1 = "SELECT * FROM shopartikel WHERE db_artid = '$art'";
$resa1 = mysqli_query($verbindung, $sqla1);
while($row = mysqli_fetch_assoc($resa1)) {
$db_artid = $row['db_artid'];
$db_arttitel = $row['db_arttitel'];
$db_artpreis = $row['db_artpreis'];
$db_artimg = $row['db_artimg'];
$db_artimgw = $row['db_artimgw'];
$db_artimgh = $row['db_artimgh'];
}
$eintragen = "INSERT INTO `topartikel` (`db_topid`, `db_topart`, `db_toptitel`, `db_toppreis`, `db_topimg`, `db_topimgw`, `db_topimgh`) VALUES ('', '$db_artid', '$db_arttitel', '$db_artpreis', '$db_artimg', '$db_artimgw', '$db_artimgh')";
$eintrag = mysqli_query($verbindung, $eintragen);
print ("<tr><td><b>Der Artikel wurde gespeichert!</b></td></tr><tr><td>&nbsp;</td></tr>");
}
if ($action=='2') {
$anzahl=$_POST['anzahl'];
$aendern = "UPDATE admin SET db_topid1 = '$anzahl' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
print ("<tr><td><b>Die Anzahl wurde ge&auml;ndert!</b></td></tr><tr><td>&nbsp;</td></tr>");
}
$sql = "SELECT * FROM admin WHERE db_adminid = '1'";
$res = mysqli_query($verbindung, $sql);
while($row = mysqli_fetch_assoc($res)) {
$db_adminid = $row['db_adminid'];
$db_topid1 = $row['db_topid1'];
}
print ("
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='topartikel.php?action=2' method='POST'>
<tr><td width=160><b>Anzahl:</b></td><td width=400><input type='text' name='anzahl' style='width:100px;' class='tf' value='$db_topid1'> *unbedingt ausf&uuml;llen</td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><input type='submit' name='update' value='Anzahl speichern' style='width:400px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td class='tdcont'>gespeicherte Top-Artikel</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>");
$sql = "SELECT * FROM topartikel";
$res = mysqli_query($verbindung, $sql);
$z = mysqli_num_rows($res);
if ($z!=0) {
$i=1;
$sql1 = "SELECT * FROM topartikel";
$res1 = mysqli_query($verbindung, $sql1);
while($row = mysqli_fetch_assoc($res1)) {
$db_topid = $row['db_topid'];
$db_topart = $row['db_topart'];
$db_toptitel = $row['db_toptitel'];
$db_toppreis = $row['db_toppreis'];
$db_topimg = $row['db_topimg'];
$db_topimgw = $row['db_topimgw'];
$db_topimgh = $row['db_topimgh'];
print ("
<form action='topartikel.php?action=update&artikel=$db_topid' method='POST'>
<tr height=24><td width=160><b>Top-Artikel $i:</b></td><td width=280><select name='art' class='tf' style='width:280px;'>");
$sqla1 = "SELECT * FROM shopartikel ORDER by db_artid DESC";
$resa1 = mysqli_query($verbindung, $sqla1);
while($row = mysqli_fetch_assoc($resa1)) {
$db_artid = $row['db_artid'];
$db_arttitel = $row['db_arttitel'];
print ("<option value='$db_artid'");
if ($db_artid==$db_topart) {print (" selected");}
print (">ID: $db_artid - $db_arttitel");
}
print ("</select></td>
<td width=100 align=right><input type='submit' name='update' value='&auml;ndern' style='width:90px;' class='bt'></td>
<td width=20 align=right><a href='topartikel.php?action=del&artikel=$db_topid'><img src='img/trash.gif' width='15' height='16' border='0'></a></td>
</tr>
</form>");
$i++;
}
}
else {
print ("<tr><td>Es sind noch keine Top-Artikel gespeichert. Bitte w&auml;hlen Sie unten aus der Liste Ihre Artikel.</td></tr>");
}
print ("</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td class='tdcont'>neuen Top-Artikel ausw&auml;hlen</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='topartikel.php?action=new' method='POST'>
<tr height=24><td width=160><b>Top-Artikel:</b></td><td><select name='art' class='tf' style='width:400px;'>");
$sqla2 = "SELECT * FROM shopartikel ORDER by db_artid DESC";
$resa2 = mysql_query($sqla2);
while($row = mysql_fetch_assoc($resa2)) {
$db_artid = $row['db_artid'];
$db_arttitel = $row['db_arttitel'];
print ("<option value='$db_artid'>ID: $db_artid - $db_arttitel");
}
print ("</select></td></tr>
<tr><td colspan=2>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><input type='submit' name='update' value='Top-Artikel speichern' style='width:400px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");

include("include/footer.php");
mysqli_close($verbindung);
?>