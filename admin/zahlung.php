<?php
$action=$_GET['action'];
include("include/dbconnect.php");
include("include/header.php");
include("include/left.php");
if ($action=='3') {
$waehrung = $_POST['waehrung'];
$mwst = $_POST['mwst'];
$vk = $_POST['vk'];
$aendern = "UPDATE admin SET db_adminwaehrung = '$waehrung' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminmwst = '$mwst' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminvk = '$vk' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
}
if ($action=='2') {
$kontoinh = $_POST['kontoinh'];
$kontonr = $_POST['kontonr'];
$blz = $_POST['blz'];
$bank = $_POST['bank'];
$iban = $_POST['iban'];
$bic = $_POST['bic'];
$paypal = $_POST['paypal'];
$aendern = "UPDATE admin SET db_adminktoinh = '$kontoinh' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminktonr = '$kontonr' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminblz = '$blz' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminbank = '$bank' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminiban = '$iban' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminbic = '$bic' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
$aendern = "UPDATE admin SET db_adminpaypal = '$paypal' WHERE db_adminid = '1'";
$upd = mysqli_query($verbindung, $aendern);
}
include("include/adminvars.php");
print ("
<tr><td class='tdcont'>Zahlungsdaten</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='zahlung.php?action=2' method='POST'>
<tr height=22><td width=160>PayPal-Adresse:</td>
<td width=400><input type='text' name='paypal' style='width:400px;' class='tf' value='$db_adminpaypal'></td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr height=22><td>Kontoinhaber:</td>
<td><input type='text' name='kontoinh' style='width:400px;' class='tf' value='$db_adminktoinh'></td></tr>
<tr height=22><td>Kontonummer:</td>
<td><input type='text' name='kontonr' style='width:400px;' class='tf' value='$db_adminktonr'></td></tr>
<tr height=22><td>Bankleitzahl:</td>
<td><input type='text' name='blz' style='width:400px;' class='tf' value='$db_adminblz'></td></tr>
<tr height=22><td>Bank:</td>
<td><input type='text' name='bank' style='width:400px;' class='tf' value='$db_adminbank'></td></tr>
<tr height=22><td>IBAN:</td>
<td><input type='text' name='iban' style='width:400px;' class='tf' value='$db_adminiban'></td></tr>
<tr height=22><td>BIC-/SWIFT-Code:</td>
<td><input type='text' name='bic' style='width:400px;' class='tf' value='$db_adminbic'></td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr height=22><td>&nbsp;</td>
<td><input type='submit' name='update' value='Daten &auml;ndern' style='width:400px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td class='tdcont'>Sonstige Zahlungsinfos</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>Wichtig: Bei der W&auml;hrung geben Sie bitte die Abk&uuml;rzung ein wie sie von PayPal benutzt wird (f&uuml;r Euro z.B. EUR). Wenn keine Mwst. angezeigt werden soll, das Feld leer lassen.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=560 border=0 cellpadding=0 cellspacing=0>
<form action='zahlung.php?action=3' method='POST'>
<tr height=22><td width=160>W&auml;hrung:</td>
<td width=400><input type='text' name='waehrung' style='width:400px;' class='tf' value='$db_adminwaehrung'></td></tr>
<tr height=22><td width=160>Mehrwertsteuer:</td>
<td width=400><input type='text' name='mwst' style='width:200px;' class='tf' value='$db_adminmwst'> in Prozent</td></tr>
<tr height=22><td width=160>Versand:</td>
<td width=400><input type='radio' name='vk' value='ja'");
if ($db_adminvk=='ja') { print (" checked"); }
print (">Versand mit Versandkosten</td></tr>
<tr height=22><td width=160>&nbsp;</td>
<td width=400><input type='radio' name='vk' value=''");
if ($db_adminvk=='') { print (" checked"); }
print (">Lieferung versandkostenfrei</td></tr>
<tr><td colspan=2 id='space' height=10>&nbsp;</td></tr>
<tr height=22><td>&nbsp;</td>
<td><input type='submit' name='update' value='Daten &auml;ndern' style='width:400px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");

include("include/footer.php");
mysqli_close($verbindung);
?>