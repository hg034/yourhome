<?php
$action=$_GET["action"];
include("include/dbconnect.php");
include("include/header.php");
include("include/left.php");

if ($action == '1') {
$firma = $_POST['firma'];
$nachname = $_POST['nachname'];
$vorname = $_POST['vorname'];
$anschrift = $_POST['anschrift'];
$plz = $_POST['plz'];
$ort = $_POST['ort'];
$telefon = $_POST['telefon'];
$telefax = $_POST['telefax'];
$email = $_POST['email'];
$webseite = $_POST['webseite'];
$aendern = "UPDATE admin SET db_adminfirma = '$firma' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminnachname = '$nachname' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminvorname = '$vorname' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminanschrift = '$anschrift' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminplz = '$plz' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminort = '$ort' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_admintelefon = '$telefon' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_admintelefax = '$telefax' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminemail = '$email' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminwebseite = '$webseite' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
}

if ($action == '2') {
$steuernummer = $_POST['steuernummer'];
$ustid = $_POST['ustid'];
$handelsreg = $_POST['handelsreg'];
$finanzamt = $_POST['finanzamt'];

$aendern = "UPDATE admin SET db_adminstnr = '$steuernummer' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminustid = '$ustid' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminfinamt = '$finanzamt' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminhandelsreg = '$handelsreg' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
}


include("include/adminvars.php");

print ("
<tr><td class='tdcont'>Admindaten</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='admindaten_update.php?action=1' method='POST'>
<tr height=22><td width=160>Firma:</td>
<td width=400><input type='text' name='firma' style='width:400px;' class='tf' value='$db_adminfirma'></td></tr>
<tr height=22><td>Nachname:</td>
<td><input type='text' name='nachname' style='width:400px;' class='tf' value='$db_adminnachname'></td></tr>
<tr height=22><td>Vorname:</td>
<td><input type='text' name='vorname' style='width:400px;' class='tf' value='$db_adminvorname'></td></tr>
<tr height=22><td>Anschrift:</td>
<td><input type='text' name='anschrift' style='width:400px;' class='tf' value='$db_adminanschrift'></td></tr>
<tr height=22><td>PLZ/Ort:</td>
<td><table width=400 border=0 cellpadding=0 cellspacing=0>
<tr><td width=80><input type='text' name='plz' style='width:75px;' class='tf' value='$db_adminplz'></td>
<td width=320><input type='text' name='ort' style='width:320px;' class='tf' value='$db_adminort'></td></tr></table></td></tr>
<tr height=22><td>Telefon:</td>
<td><input type='text' name='telefon' style='width:400px;' class='tf' value='$db_admintelefon'></td></tr>
<tr height=22><td>Telefax:</td>
<td><input type='text' name='telefax' style='width:400px;' class='tf' value='$db_admintelefax'></td></tr>
<tr height=22><td>E-Mail-Adresse:</td>
<td><input type='text' name='email' style='width:400px;' class='tf' value='$db_adminemail'></td></tr>
<tr height=22><td>Webseite:</td>
<td><input type='text' name='webseite' style='width:400px;' class='tf' value='$db_adminwebseite'></td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr height=22><td>&nbsp;</td>
<td align=center><input type='submit' name='update' value='Daten &auml;ndern' style='width:400px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td class='tdcont'>rechtliche Daten</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='admindaten_update.php?action=2' method='POST'>
<tr height=22><td width=160>Steuernummer:</td>
<td width=400>
<table width=400 border=0 cellpadding=0 cellspacing=0>
<tr>
<td width=150><input type='text' name='steuernummer' style='width:150px;' class='tf' value='$db_adminstnr'></td>
<td width=100> &nbsp;&nbsp;UstID-Nr.:</td>
<td width=150><input type='text' name='ustid' style='width:150px;' class='tf' value='$db_adminustid'></td>
</tr>
</table>
</td></tr>
<tr height=22><td width=160>Handelsregister:</td>
<td width=400>
<table width=400 border=0 cellpadding=0 cellspacing=0>
<tr>
<td width=150><input type='text' name='handelsreg' style='width:150px;' class='tf' value='$db_adminhandelsreg'></td>
<td width=100> &nbsp;&nbsp;Finanzamt:</td>
<td width=150><input type='text' name='finanzamt' style='width:150px;' class='tf' value='$db_adminfinamt'></td>
</tr>
</table>
</td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr height=22><td>&nbsp;</td>
<td align=center><input type='submit' name='update' value='Daten &auml;ndern' style='width:400px;' class='bt'></td></tr>
</form>
</table>
</td></tr>

");
include("include/footer.php");
mysqli_close($verbindung);
?>