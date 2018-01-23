<?php
include("include/dbconnect.php");
include("include/sess.php");
$header = "Kasse";
$sqllt = "SELECT * FROM login WHERE db_logts = '$ts'";
$reslt = mysqli_query($verbindung, $sqllt);
while($row = mysqli_fetch_assoc($reslt)) {
$db_logid = $row['db_logid'];
$db_logts = $row['db_logts'];
$db_logsess = $row['db_logsess'];
$db_logip = $row['db_logip'];
$db_loguser = $row['db_loguser'];
$db_loguser = $row['db_loguser'];
}
if ($db_loguser != '0') {
$link = "bestellung.php?sess=$sess&ts=$ts";
header("Location: $link");
}
else {
include("include/header.php");
include("include/left.php");
print ("
<tr><td>Um die Bestellung abschlie&szlig;en zu k&ouml;nnen m&uuml;ssen Sie eingeloggt sein.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td height=20><b>Login f&uuml;r registrierte Kunden:</b></td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=480 border=0 cellpadding=0 cellspacing=0>
<form action='login.php?sess=$sess&ts=$ts' method='POST'>
<tr height=22>
<td width=180>E-Mail-Adresse:</td>
<td width=300 colspan=2><input type='text' name='email' style='width:300px;' class='tf'></td>
</tr>
<tr height=22>
<td>Passwort:</td>
<td width=150><input type='password' name='passwort' style='width:140px;' class='tf'></td>
<td width=150><input type='submit' value='Login' style='width:150px;' class='bt'></td>
</tr>
<tr height=22>
<td>&nbsp;</td>
<td colspan=2><a href='passwort.php?sess=$sess&ts=$ts&action=1' class='a3'><b>&#187; Passwort vergessen?</b></a></td>
</tr>
</form>
</table>
</td></tr>
<tr><td height=20>&nbsp;</td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td height=20><b>Neukunden-Registrierung:</b></td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=480 border=0 cellpadding=0 cellspacing=0>
<form action='register.php?sess=$sess&ts=$ts' method='POST'>
<tr height=22><td width=180>&nbsp;</td>
<td width=300 colspan=2><input type='radio' name='anrede' value='Herr' checked>Herr &nbsp;&nbsp;<input type='radio' name='anrede' value='Frau'>Frau</td></tr>
<tr height=22><td>Nachname:</td>
<td colspan=2><input type='text' name='nachname' style='width:300px;' class='tf' value=''></td></tr>
<tr height=22><td>Vorname:</td>
<td colspan=2><input type='text' name='vorname' style='width:300px;' class='tf' value=''></td></tr>
<tr height=22><td>Anschrift:</td>
<td colspan=2><input type='text' name='anschrift' style='width:300px;' class='tf' value=''></td></tr>
<tr height=22><td>PLZ/Ort:</td>
<td colspan=2>
<table width=300 border=0 cellpadding=0 cellspacing=0>
<tr>
<td width=90><input type='text' name='plz' style='width:85px;' class='tf' value=''></td>
<td width=210><input type='text' name='ort' style='width:210px;' class='tf' value=''></td>
</tr>
</table>
</td></tr>
<tr height=22><td>Land:</td>
<td colspan=2><select name='land' class='tf' style='width:300px;'>");
$sql = "SELECT * FROM laender ORDER by db_laenderid";
$res = mysqli_query($verbindung, $sql);
while($row = mysqli_fetch_assoc($res)) {
$db_laenderid = $row['db_laenderid'];
$db_laendercode = $row['db_laendercode'];
$db_land = $row['db_land'];
print ("<option value='$db_laendercode'>$db_land");
}
print ("</select>
</td></tr>
<tr height=22><td>Telefon:</td>
<td colspan=2><input type='text' name='telefon' style='width:300px;' class='tf' value=''></td></tr>
<tr height=22><td>E-Mail-Adresse:</td>
<td colspan=2><input type='text' name='email' style='width:300px;' class='tf' value=''></td></tr>
<tr><td colspan=2 id='space' height=5>&nbsp;</td></tr>
<tr height=22><td>&nbsp;</td>
<td colspan=2 class='tdklein'>Mit dem Absenden der Registrierung erkl&auml;ren Sie sich damit einverstanden, dass Ihre Daten f&uuml;r in- terne Zwecke gespeichert werden. Ihre Daten wer- den nicht weitergegeben.</td></tr>
<tr><td colspan=2 id='space' height=5>&nbsp;</td></tr>
<tr height=22><td>&nbsp;</td>
<td colspan=2><input type='submit' value='Registrierung absenden' style='width:300px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");
include("include/pages0.php");
include("include/right.php");
include("include/footer.php");
}
mysqli_close($verbindung);
?>