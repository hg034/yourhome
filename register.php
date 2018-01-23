<?php
include("include/dbconnect.php");
include("include/sess.php");
$header = "Registrierung";
include("include/header.php");
include("include/left.php");
$anrede = $_POST['anrede'];
$nachname = $_POST['nachname'];
$vorname = $_POST['vorname'];
$anschrift = $_POST['anschrift'];
$plz = $_POST['plz'];
$ort = $_POST['ort'];
$land = $_POST['land'];
$telefon = $_POST['telefon'];
$email = $_POST['email'];
$nachname = str_replace(array("<",">","\$","{","}","[","]"),"",$nachname);
$vorname = str_replace(array("<",">","\$","{","}","[","]"),"",$vorname);
$anschrift = str_replace(array("<",">","\$","{","}","[","]"),"",$anschrift);
$plz = str_replace(array("<",">","\$","{","}","[","]"),"",$plz);
$ort = str_replace(array("<",">","\$","{","}","[","]"),"",$ort);
$telefon = str_replace(array("<",">","\$","{","}","[","]"),"",$telefon);
$fehler = "";
//formulareingaben pruefen
if (empty($nachname) || empty($vorname) || empty($anschrift) || empty($plz) || empty($ort) || empty($email)) {  $form_ok = 0; $fehler .= "<br>Bitte f&uuml;llen Sie alle markierten Felder aus!";
} else { $form_ok = 1; }
//emailadresse pruefen

if ($email != '') { $fehler .= "- Geben Sie bitte eine g&uuml;ltige E-Mail-Adresse ein!<br>"; }

else {$mail_ok=1;}

  //pruefen ob user existiert
$sqlup = "SELECT * FROM user WHERE db_useremail = '$email'";
$resup = mysqli_query($verbindung, $sqlup);
$zeilen = mysqli_num_rows($resup);
if ($zeilen == '0') { $user_ok = 1; } else { $user_ok = 0; $fehler .= "Die angegebene E-Mail-Adresse existiert bereits. Bitte loggen Sie sich ein oder fordern Sie Ihr Passwort an.";}

if (($form_ok == '0') || ($mail_ok == '0') || ($user_ok == '0')) {
print ("
<tr><td height=20><b>Neukunden-Registrierung:</b></td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td class='tdf'>$fehler</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=480 border=0 cellpadding=0 cellspacing=0>
<form action='register.php?sess=$sess&ts=$ts' method='POST'>
<tr height=22><td width=160>&nbsp;</td>
<td width=300 colspan=2><input type='radio' name='anrede' value='Herr'");
if ($anrede == 'Herr') {print (" checked");}
print (">Herr &nbsp;&nbsp;<input type='radio' name='anrede' value='Frau'");
if ($anrede == 'Frau') {print (" checked");}
print (">Frau</td></tr>
<tr height=22><td");
if (empty($nachname)) { print (" class='tdf'"); }
print (">Nachname:</td>
<td width=300 colspan=2><input type='text' name='nachname' style='width:300px;' class='tf' value='$nachname'></td></tr>
<tr height=22><td");
if (empty($vorname)) { print (" class='tdf'"); }
print (">Vorname:</td>
<td width=300 colspan=2><input type='text' name='vorname' style='width:300px;' class='tf' value='$vorname'></td></tr>
<tr height=22><td");
if (empty($anschrift)) { print (" class='tdf'"); }
print (">Anschrift:</td>
<td width=300 colspan=2><input type='text' name='anschrift' style='width:300px;' class='tf' value='$anschrift'></td></tr>
<tr height=22><td");
if (empty($plz) || empty($ort)) { print (" class='tdf'"); }
print (">PLZ/Ort:</td>
<td width=300 colspan=2>
<table width=300 border=0 cellpadding=0 cellspacing=0>
<tr>
<td width=90><input type='text' name='plz' style='width:85px;' class='tf' value='$plz'></td>
<td width=210><input type='text' name='ort' style='width:210px;' class='tf' value='$ort'></td>
</tr>
</table>
</td></tr>
<tr height=22><td>Land:</td>
<td width=300 colspan=2><select name='land' class='tf' style='width:300px;'>");
$sql = "SELECT * FROM laender ORDER by db_laenderid";
$res = mysqli_query($verbindung, $sql);
while($row = mysqli_fetch_assoc($res)) {
$db_laenderid = $row['db_laenderid'];
$db_laendercode = $row['db_laendercode'];
$db_land = $row['db_land'];
print ("<option value='$db_laendercode'");
if ($land == $db_laendercode) {print (" selected");}
print (">$db_land");
}
print ("</select>
</td></tr>
<tr height=22><td>Telefon:</td>
<td width=300 colspan=2><input type='text' name='telefon' style='width:300px;' class='tf' value='$telefon'></td></tr>
<tr height=22><td");
if (empty($email) || $mail_ok == '0') { print (" class='tdf'"); }
print (">E-Mail-Adresse:</td>
<td width=300 colspan=2><input type='text' name='email' style='width:300px;' class='tf' value='$email'></td></tr>
<tr><td colspan=2 id='space' height=5>&nbsp;</td></tr>
<tr height=22><td>&nbsp;</td>
<td width=300 colspan=2 class='tdklein'>Mit dem Absenden der Registrierung erkl&auml;ren Sie sich damit einverstanden, dass Ihre Daten f&uuml;r interne Zwecke gespeichert werden. Ihre Daten werden nicht weitergegeben.</td></tr>
<tr><td colspan=2 id='space' height=5>&nbsp;</td></tr>
<tr height=22><td>&nbsp;</td>
<td width=300 colspan=2><input type='submit' value='Registrierung absenden' style='width:300px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");
}
else {
$regtime = time();
//passwort erstellen
$pwges = strlen($regtime); $pwzahl = 6; $pwlen = $pwges - $pwzahl;
$passwort = substr($regtime, $pwlen, $pwges);
$pwd = $passwort;
 $passwort = str_replace ("0", "a", $passwort); $passwort = str_replace ("1", "y", $passwort);
 $passwort = str_replace ("2", "s", $passwort); $passwort = str_replace ("3", "d", $passwort);
 $passwort = str_replace ("4", "1", $passwort); $passwort = str_replace ("5", "f", $passwort);
 $passwort = str_replace ("6", "x", $passwort); $passwort = str_replace ("7", "z", $passwort);
 $passwort = str_replace ("8", "7", $passwort); $passwort = str_replace ("9", "5", $passwort);
//passwort verschluesseln
$encrypt=md5($passwort);
//daten speichern
$eintragen = "INSERT INTO `user` (`db_userid`, `db_userts`, `db_userpass`, `db_useranrede`, `db_usernachname`, `db_uservorname`, `db_useranschrift`, `db_userplz`, `db_userort`, `db_userland`, `db_usertelefon`, `db_useremail`) VALUES ('', '$regtime', '$encrypt', '$anrede', '$nachname', '$vorname', '$anschrift', '$plz', '$ort', '$land', '$telefon', '$email')";
$eintrag = mysqli_query($verbindung, $eintragen);

//mail an kunden
if ($anrede == 'Herr') { $gruss = "Sehr geehrter Herr"; }
if ($anrede == 'Frau') { $gruss = "Sehr geehrte Frau"; }
$betreff = "Ihre Registrierung";
$mailtext = "$gruss $nachname,\n\nIhre Registrierung war erfolgreich. Sie können sich jetzt mit\nden folgenden Daten einloggen und Ihre Bestellung abschließen:\n\nE-Mail: $email\nPasswort: $passwort\n\nMit freundlichen Grüßen\n\n$mailfooter";

mail($email, $betreff, $mailtext, "FROM: $db_adminfirma <$db_adminemail>");

//ausgabe login-formular
print ("<tr><td><b>$gruss $nachname,</b><br><br>Ihre Registrierung war erfolgreich. Sie k&ouml;nnen Sich jetzt hier einloggen. Ihre Zugangsdaten wurden Ihnen soeben per E-Mail gesendet.</td></tr>
<tr><td>&nbsp;</td></tr>
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
<td width=300 colspan=2><a href='passwort.php?sess=$sess&ts=$ts&action=1' class='a3'><b>&#187; Passwort vergessen?</b></a></td>
</tr>
</form>
</table>
</td></tr>
");
}
include("include/pages0.php");
include("include/right.php");
include("include/footer.php");
mysqli_close($verbindung);
?>