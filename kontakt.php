<?php
$action=$_GET['action'];
include("include/dbconnect.php");
include("include/sess.php");
$header = "Kontakt";
include("include/header.php");
include("include/left.php");
$tabsize = 480; $tdheight = 22;
$size0 = 180; $size1 = 300; $size2 = 80;
$size3 = $size1 - $size2; $size4 = $size2 - 5;
if ($action=='1') {
print ("<tr><td>
<table width=$tabsize align=center border=0 cellpadding=0 cellspacing=0>
<form action='kontakt.php?sess=$sess&ts=$ts&action=2' method='POST'>
<tr height=$tdheight><td width=$size0>&nbsp;</td>
<td width=$size1><input type='radio' name='anrede' value='Herr' checked>Herr &nbsp;&nbsp;<input type='radio' name='anrede' value='Frau'>Frau</td></tr>
<tr height=$tdheight><td>Nachname:</td>
<td><input type='text' name='nachname' style='width:$size1;' class='tf' value=''></td></tr>
<tr height=$tdheight><td>Vorname:</td>
<td><input type='text' name='vorname' style='width:$size1;' class='tf' value=''></td></tr>
<tr height=$tdheight><td>E-Mail-Adresse:</td>
<td><input type='text' name='email' style='width:$size1;' class='tf' value=''></td></tr>
<tr height=$tdheight><td>Betreff:</td>
<td><input type='text' name='betreff' style='width:$size1;' class='tf' value=''></td></tr>
<tr><td id='space' colspan=2 height=5>&nbsp;</td></tr>
<tr><td valign=top>Ihre Nachricht:</td>
<td><textarea name='nachricht' rows='6' cols='30' style='width:$size1;' class='tf1'></textarea></td></tr>
<tr><td id='space' colspan=2 height=5>&nbsp;</td></tr>
<tr height=$tdheight><td>&nbsp;</td>
<td><input type='submit' name='senden' style='width:$size1;' class='bt' value='Nachricht senden'></td></tr>
</form>
</table>
</td></tr>
");
}
if ($action=='2') {
$fehler = "";
$anrede = $_POST["anrede"];
$nachname = $_POST["nachname"];
$vorname = $_POST["vorname"];
$email = $_POST["email"];
$betreff = $_POST["betreff"];
$nachricht = $_POST["nachricht"];
$nachname = str_replace(array("<",">","\$","{","}","[","]"),"",$nachname);
$vorname = str_replace(array("<",">","\$","{","}","[","]"),"",$vorname);
$betreff = str_replace(array("<",">","\$","{","}","[","]"),"",$betreff);
$nachricht = str_replace(array("<",">","\$","{","}","[","]"),"",$nachricht);
if ($anrede == 'Herr') { $gruss = "Sehr geehrter Herr"; }
if ($anrede == 'Frau') { $gruss = "Sehr geehrte Frau"; }
//formulareingaben pruefen
if (empty($_POST['nachname']) || empty($_POST['vorname']) || empty($_POST['email']) || empty($_POST['nachricht'])) {  $form_ok = 0; $fehler .= "- Bitte f&uuml;llen Sie alle markierten Felder aus!<br>";
} else { $form_ok = 1; }
//emailadresse pruefen
if(!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,4})$",$email)){
  $mail_ok=0;
if ($email != '') { $fehler .= "- Geben Sie bitte eine g&uuml;ltige E-Mail-Adresse ein!<br>"; }
}
else {$mail_ok=1;}
if (($form_ok == '0') || ($mail_ok == '0')) {
print ("<tr><td>
<table width=$tabsize align=center border=0 cellpadding=0 cellspacing=0>
<form action='kontakt.php?sess=$sess&ts=$ts&action=2' method='POST'>
<tr><td colspan=2 class='tdf'>$fehler</td></tr>
<tr><td colspan=2>&nbsp;</td></tr>
<tr height=$tdheight><td width=$size0>&nbsp;</td>
<td width=$size1><input type='radio' name='anrede' value='Herr'");
if ($anrede == 'Herr') { print (" checked"); }
print (">Herr &nbsp;&nbsp;<input type='radio' name='anrede' value='Frau'");
if ($anrede == 'Frau') { print (" checked"); }
print (">Frau</td></tr>
<tr height=$tdheight><td");
if (empty($_POST['nachname'])) { print (" class='tdf'"); }
print (">Nachname:</td>
<td><input type='text' name='nachname' style='width:$size1;' class='tf' value='$nachname'></td></tr>
<tr height=$tdheight><td");
if (empty($_POST['vorname'])) { print (" class='tdf'"); }
print (">Vorname:</td>
<td><input type='text' name='vorname' style='width:$size1;' class='tf' value='$vorname'></td></tr>
<tr height=$tdheight><td");
if (empty($_POST['email'])) { print (" class='tdf'"); }
print (">E-Mail-Adresse:</td>
<td><input type='text' name='email' style='width:$size1;' class='tf' value='$email'></td></tr>
<tr><td id='space' colspan=2 height=5>&nbsp;</td></tr>
<tr height=$tdheight><td>Betreff:</td>
<td><input type='text' name='betreff' style='width:$size1;' class='tf' value='$betreff'></td></tr>
<tr><td valign=top");
if (empty($_POST['nachricht'])) { print (" class='tdf'"); }
print (">Ihre Nachricht:</td>
<td><textarea name='nachricht' rows='6' cols='30' style='width:$size1;' class='tf1'>$nachricht</textarea></td></tr>
<tr><td id='space' colspan=2 height=5>&nbsp;</td></tr>
<tr height=$tdheight><td>&nbsp;</td>
<td><input type='submit' name='senden' style='width:$size1;' class='bt' value='Nachricht senden'></td></tr>
</form>
</table>
</td></tr>");
}
else {
$empfaenger = $db_adminemail;
$betreff1 = "Kontaktformular";
$text = "$anrede\n$vorname $nachname\nE-Mail: $email\n\nBetreff: $betreff\n\nNachricht:\n$nachricht";
mail($empfaenger, $betreff1, $text, "FROM: $nachname $vorname <$email>");
print ("
<tr><td>
<table width=$tabsize align=center border=0 cellpadding=0 cellspacing=0>
<tr><td>$gruss $nachname,<br><br>vielen Dank f&uuml;r Ihre Nachricht. Wir setzen uns schnellstm&ouml;glich mit Ihnen in Verbindung.</td></tr>
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