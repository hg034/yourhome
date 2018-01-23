<?php

include("include/dbconnect.php");
include("include/sess.php");
$header = "Login";
include("include/header.php");
include("include/left.php");
$email = $_POST['email'];
$passwort = $_POST['passwort'];
$encrypt=md5($passwort);
//pruefen ob user existiert
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
if ($encrypt==$db_userpass) {
$aendern = "UPDATE login SET db_loguser = '$db_userid' WHERE db_logts = '$ts'";
$upd = mysqli_query($verbindung, $aendern);
if ($db_useranrede == 'Herr') { $gruss = "Sehr geehrter Herr"; }
if ($db_useranrede == 'Frau') { $gruss = "Sehr geehrte Frau"; }
print ("
<tr><td><b>$gruss $db_usernachname,</b><br><br>Sie haben sich erfolgreich eingeloggt.<br><br>Sie k&ouml;nnen Ihre Bestellung jetzt abschlie&szlig;en.<br><br><a href='bestellung.php?sess=$sess&ts=$ts'><b>Hier geht es zur Kasse &gt;&gt;</b></a></td></tr>
");
}
else {
print ("
<tr><td>Bitte geben Sie Ihr korrektes Passwort ein!</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=480 border=0 cellpadding=0 cellspacing=0>
<form action='login.php?sess=$sess&ts=$ts' method='POST'>
<tr height=22>
<td width=180>E-Mail-Adresse:</td>
<td width=300 colspan=2><input type='text' name='email' style='width:300px;' class='tf' value='$email'></td>
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
}
else {
print ("
<tr><td>Die eingegebene E-Mail-Adresse existiert nicht in unserer Datenbank. Bitte kontrollieren Sie Ihre Eingabe!</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=480 border=0 cellpadding=0 cellspacing=0>
<form action='login.php?sess=$sess&ts=$ts' method='POST'>
<tr height=22>
<td width=180>E-Mail-Adresse:</td>
<td width=300 colspan=2><input type='text' name='email' style='width:300px;' class='tf' value='$email'></td>
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