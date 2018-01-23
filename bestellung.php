<?php
$gesamtwert=0;
include("include/dbconnect.php");
include("include/sess.php");
$header = "Ihre Bestellung";
include("include/header.php");
include("include/left.php");
$sqlup = "SELECT * FROM login WHERE db_logts = '$ts' AND db_loguser != '0'";
$resup = mysqli_query($verbindung, $sqlup);
$zeilen = mysqli_num_rows($resup);
$sqllt = "SELECT * FROM login WHERE db_logts = '$ts'";
$reslt = mysqli_query($verbindung, $sqllt);
while($row = mysqli_fetch_assoc($reslt)) {
$db_logid = $row['db_logid'];
$db_logts = $row['db_logts'];
$db_logsess = $row['db_logsess'];
$db_logip = $row['db_logip'];
$db_loguser = $row['db_loguser'];
}
if ($zeilen != '0') {
$sql = "SELECT * FROM user WHERE db_userid = '$db_loguser'";
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
$sqlb1 = "SELECT * FROM basket WHERE db_bsess = '$sess' AND db_bmenge != '0'";
$resb1 = mysqli_query($verbindung, $sqlb1);
$zeilenb1 = mysqli_num_rows($resb1);
if ($zeilenb1 != '0') {
print ("
<tr><td>Bitte kontrollieren Sie die Artikeldaten und vervollst&auml;ndigen Sie Ihre Angaben. Hier geht es zur&uuml;ck zum <a href='warenkorb.php?sess=$sess&ts=$ts&kat=0&artikel=0&next=0&page=0&back=index&action=view'>Warenkorb</a>.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td>
<table width=480 border=0 cellpadding=0 cellspacing=0>
<tr height=20>
<td width=50><b>Menge</b></td>
<td width=290><b>Artikel</b></td>
<td width=70 align=right><b>Preis</b></td>
<td width=70 align=right><b>Gesamt</b></td>
</tr>
<tr><td id='linebsk' colspan=4><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td id='space' colspan=4 height=3>&nbsp;</td></tr>
");
$sqlbas1 = "SELECT * FROM basket WHERE db_bsess = '$sess' AND db_bmenge != '0' ORDER by db_bid";
$resbas1 = mysqli_query($verbindung, $sqlbas1);
while($row = mysqli_fetch_assoc($resbas1)) {
$db_bid = $row['db_bid'];
$db_bsess = $row['db_bsess'];
$db_bartid = $row['db_bartid'];
$db_bartikel = $row['db_bartikel'];
$db_bopt1 = $row['db_bopt1'];
$db_bopt2 = $row['db_bopt2'];
$db_bpreis = $row['db_bpreis'];
$db_bmenge = $row['db_bmenge'];
$db_bgesamt = $db_bmenge * $db_bpreis;
$db_bgesamt1 = sprintf("%01.2f", $db_bgesamt);
print ("
<tr height=18>
<td>$db_bmenge x</td>
<td>$db_bartikel</td>
<td align=right>$db_bpreis</td>
<td align=right><b>$db_bgesamt1</b></td>
</tr>
<tr><td colspan=4 id='space' height=5>&nbsp;</td></tr>");
$gesamtwert = $gesamtwert + $db_bgesamt1;
$gesamtwert = sprintf("%01.2f", $gesamtwert);
}
$sqlvk = "SELECT * FROM laender WHERE db_laendercode = '$db_userland'";
$resvk = mysqli_query($verbindung, $sqlvk);
while($row = mysqli_fetch_assoc($resvk)) {
$db_laenderid = $row['db_laenderid'];
$db_laendercode = $row['db_laendercode'];
$db_land = $row['db_land'];
$db_vk = $row['db_vk'];
}
$rechnungsbetrag = $gesamtwert + $db_vk;
$rechnungsbetrag = sprintf("%01.2f", $rechnungsbetrag);
print ("
<tr><td id='linebsk' colspan=4><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr height=22><td colspan=3>Warenwert:</td><td align=right><b>$gesamtwert</b></td></tr>
<tr height=22><td colspan=3>Versandkosten:</td><td align=right><b>$db_vk</b></td></tr>
<tr><td id='linebsk' colspan=4><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr height=30><td colspan=3>Gesamtbetrag in $db_adminwaehrung: ");
if ($db_adminmwst!='') { print ("<font class='tdklein'>(inkl. $mwst Mehrwertsteuer)</font>"); }
print ("</td><td align=right><b>$rechnungsbetrag</b></td></tr>
<tr><td id='linebsk' colspan=4><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td colspan=4><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td id='linebsk' colspan=4><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=480 border=0 cellpadding=0 cellspacing=0>
<form action='bestellung_senden.php?sess=$sess&ts=$ts&userid=$db_loguser' method='POST'>
<tr><td width=160 valign=top><b>Lieferanschrift:</b></td><td width=320><b>$db_useranrede<br>
$db_uservorname $db_usernachname<br>$db_useranschrift<br>
$db_userland-$db_userplz $db_userort</b></td></tr>
<tr><td colspan=2>&nbsp;</td></tr>
<tr><td id='linebsk' colspan=2><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr><tr><td colspan=2>&nbsp;</td></tr>
<tr><td valign=top><b>Zahlungsweise:</b></td><td><input type='radio' name='zahlung' value='2' checked>per Vorkasse/&Uuml;berweisung<br><input type='radio' name='zahlung' value='1'>per PayPal
</td></tr>
<tr><td colspan=2 id='space' height=5>&nbsp;</td></tr>
<tr><td valign=top><b>Bemerkungen:</b></td><td><textarea name='bemerkungen' rows='4' cols='30' style='width:320px;' class='tf1'></textarea></td></tr>
<tr><td colspan=2 id='space' height=5>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><input type='checkbox' name='agb' value='1'>Ich habe Ihre AGBs gelesen und akzeptiert!</td></tr>
<tr><td colspan=2>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><input type='submit' value='Bestellung senden' style='width:320px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
");
}
else {
print ("<tr><td>Ihr Warenkorb ist leer!</td></tr>");
}
}
else {
print ("<tr><td>Sie sind nicht eingeloggt!</td></tr>");
}




include("include/pages0.php");
include("include/right.php");
include("include/footer.php");
mysqli_close($verbindung);
?>