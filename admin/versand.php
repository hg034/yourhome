<?php
$action=$_GET['action'];
include("include/dbconnect.php");
include("include/header.php");
include("include/left.php");
//update
if ($action=='2') {
$id = $_GET['id'];
$land = $_POST['land']; $code = $_POST['code']; $vk = $_POST['vk'];
$vk =  ereg_replace(",", ".", $vk);
$land = str_replace(array("ä","ö","ü","Ä","Ö","Ü","ß"),array("&auml;","&ouml;","&uuml;","&Auml;","&Ouml;","&Uuml;","&szlig;"),$land);
$aendern = "UPDATE laender SET db_land = '$land' WHERE db_laenderid = '$id'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE laender SET db_laendercode = '$code' WHERE db_laenderid = '$id'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE laender SET db_vk = '$vk' WHERE db_laenderid = '$id'";
$upd = mysqli_query($verbindung, $aendern);
}
//loeschen
if ($action=='3') {
$id = $_GET['id'];
$loeschen = "DELETE FROM laender WHERE db_laenderid = '$id'";
$loesch = mysqli_query($verbindung, $loeschen);
}
//neu
if ($action=='4') {
$land = $_POST['land']; $code = $_POST['code']; $vk = $_POST['vk'];
$land = str_replace(array("ä","ö","ü","Ä","Ö","Ü","ß"),array("&auml;","&ouml;","&uuml;","&Auml;","&Ouml;","&Uuml;","&szlig;"),$land);
$eintragen = "INSERT INTO `laender` (`db_laenderid`, `db_laendercode`, `db_land`, `db_vk`) VALUES ('', '$code', '$land', '$vk')";
$eintrag = mysqli_query($verbindung, $eintragen);
}

print ("
<tr><td class='tdcont'>Versandkosten</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Als Code geben Sie bitte das L&auml;nderk&uuml;rzel an, wie z.B. D f&uuml;r Deutschland oder CH f&uuml;r die Schweiz.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td class='tdcont'>neuer Eintrag</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='versand.php?action=4' method='POST'>
<tr height=22><td width=160>Land:</td>
<td width=300><input type='text' name='land' style='width:400px;' class='tf'></td></tr>
<tr height=22><td width=160>Code:</td>
<td width=300><input type='text' name='code' style='width:400px;' class='tf'></td></tr>
<tr height=22><td width=160>Versandkosten:</td>
<td width=300><input type='text' name='vk' style='width:400px;' class='tf'></td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr height=22><td>&nbsp;</td>
<td><input type='submit' name='update' value='Eintrag speichern' style='width:400px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td class='tdcont'>gespeicherte Eintr&auml;ge</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<tr height=22><td width=260>Land</td>
<td width=100 align=right>Code</td>
<td width=100 align=right>$db_adminwaehrung</td>
<td width=80 align=right>&nbsp;</td>
<td width=20 align=right>&nbsp;</td>
</tr>");
$sql = "SELECT * FROM laender ORDER by db_laenderid";
$res = mysqli_query($verbindung, $sql);
while($row = mysqli_fetch_assoc($res)) {
$db_laenderid = $row['db_laenderid'];
$db_laendercode = $row['db_laendercode'];
$db_land = $row['db_land'];
$db_vk = $row['db_vk'];
print ("
<form action='versand.php?action=2&id=$db_laenderid' method='POST'>
<tr height=22><td><input type='text' name='land' style='width:260px;' class='tf' value='$db_land'></td>
<td align=right><input type='text' name='code' style='width:95px; text-align:right;' class='tf' value='$db_laendercode'></td>
<td align=right><input type='text' name='vk' style='width:95px; text-align:right;' class='tf' value='$db_vk'></td>
<td align=right><input type='submit' style='width:75px;' class='bt' value='&auml;ndern'></td>
<td align=right><a href='versand.php?action=3&id=$db_laenderid'><img src='img/trash.gif' width='15' height='16' border='0'></a></td>
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