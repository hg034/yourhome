<?php
$action=$_GET['action'];
include("include/dbconnect.php");
include("include/sess.php");
$header = "Ihre Zugangsdaten";
include("include/header.php");
include("include/left.php");
if ($action=='1') {
print ("
<tr><td>Sie haben Ihr Passwort vergessen? Tragen Sie hier die E-Mail-Adresse ein, welche Sie bei der Registrierung angegeben haben.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=480 border=0 cellpadding=0 cellspacing=0>
<form action='passwort.php?sess=$sess&ts=$ts&action=2' method='POST'>
<tr height=30><td width=180>E-Mail-Adresse:</td>
<td width=300><input type='text' name='email' style='width:300px;' class='tf'></td></tr>
<tr height=30><td width=180>&nbsp;</td>
<td width=300><input type='submit' value='Passwort anfordern' style='width:300px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");
}
if ($action=='2') {
$email=$_POST['email'];
$sqlup = "SELECT * FROM user WHERE db_useremail = '$email'";
$resup = mysqli_query($verbindung, $sqlup);
$zeilen = mysqli_num_rows($resup);
if ($zeilen != '0') {
$sql = "SELECT * FROM user WHERE db_useremail = '$email'";
$res = mysqli_query($verbindung, $sql);
while($row = mysqli_fetch_assoc($res)) {
$db_userid = $row['db_userid'];
$db_userts = $row['db_userts'];
$db_userpass = $row['db_userpass'];
$db_useranrede = $row['db_useranrede'];
$db_usernachname = $row['db_usernachname'];
$db_uservorname = $row['db_uservorname'];
$db_useranschrift = $row['db_useranschrift'];
$db_userplz = $row['db_userplz'];
$db_userort = $row['db_userort'];
$db_userland = $row['db_userland'];
$db_usertelefon = $row['db_usertelefon'];
$db_useremail = $row['db_useremail'];
}
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
$aendern = "UPDATE user SET db_userpass = '$encrypt' WHERE db_useremail = '$email'";
$upd = mysqli_query($verbindung, $aendern);
//mail an kunden
if ($db_useranrede == 'Herr') { $gruss = "Sehr geehrter Herr"; }
if ($db_useranrede == 'Frau') { $gruss = "Sehr geehrte Frau"; }
$betreff = "Ihre Zugangsdaten";
$mailtext = "$gruss $db_usernachname,\n\nIhr Passwort wurde aus Sicherheitsgründen neu zugewiesen. Sie können sich jetzt mit\nden folgenden Daten einloggen:\n\nE-Mail: $email\nPasswort: $passwort\n\nMit freundlichen Grüßen\n\n$mailfooter";

mail($email, $betreff, $mailtext, "FROM: $db_adminfirma <$db_adminemail>");

//ausgabe login-formular
print ("<tr><td><b>$gruss $db_usernachname,</b><br><br>Sie k&ouml;nnen Sich jetzt hier einloggen. Ihre Zugangsdaten wurden Ihnen soeben per E-Mail gesendet.</td></tr>
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
else {
print ("
<tr><td>Sie haben Ihr Passwort vergessen? Tragen Sie hier die E-Mail-Adresse ein, welche Sie bei der Registrierung angegeben haben.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td class='tdf'>Die angegebene E-Mail-Adresse ist nicht in unserer Datenbank!</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=480 border=0 cellpadding=0 cellspacing=0>
<form action='passwort.php?sess=$sess&ts=$ts&action=2' method='POST'>
<tr height=30><td width=180>E-Mail-Adresse:</td>
<td width=300><input type='text' name='email' style='width:300px;' class='tf'></td></tr>
<tr height=30><td width=180>&nbsp;</td>
<td width=300><input type='submit' value='Passwort anfordern' style='width:300px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
");
}
}



include("include/pages0.php");
include("include/right.php");
include("include/footer.php");
mysqli_close($verbindung);
?>