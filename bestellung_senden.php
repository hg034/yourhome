<?php
$gesamtwert=0;
include("include/dbconnect.php");
include("include/sess.php");
$header = "Ihre Bestellung";
include("include/header.php");
include("include/left.php");
$userid=$_GET['userid'];
$zahlung=$_POST['zahlung'];
$bemerkungen=$_POST['bemerkungen'];
$bemerkungen = str_replace(array("<",">","\$","{","}","[","]"),"",$bemerkungen);
$sql = "SELECT * FROM user WHERE db_userid = '$userid'";
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
$db_username = "$db_uservorname $db_usernachname";
if (empty($_POST['agb'])) {
$sqllt = "SELECT * FROM login WHERE db_logts = '$ts'";
$reslt = mysqli_query($verbindung, $sqllt);
while($row = mysqli_fetch_assoc($reslt)) {
$db_logid = $row['db_logid'];
$db_logts = $row['db_logts'];
$db_logsess = $row['db_logsess'];
$db_logip = $row['db_logip'];
$db_loguser = $row['db_loguser'];
}

print ("
<tr><td class='tdf'>Bitte best&auml;tigen Sie unsere AGBs!</td></tr>
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
<form action='bestellung_senden.php?sess=$sess&ts=$ts&userid=$userid' method='POST'>
<tr><td width=160 valign=top><b>Lieferanschrift:</b></td><td width=320><b>$db_useranrede<br>
$db_uservorname $db_usernachname<br>$db_useranschrift<br>
$db_userland-$db_userplz $db_userort</b></td></tr>
<tr><td colspan=2>&nbsp;</td></tr>
<tr><td id='linebsk' colspan=2><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr><tr><td colspan=2>&nbsp;</td></tr>
<tr><td valign=top><b>Zahlungsweise:</b></td><td><input type='radio' name='zahlung' value='2' checked>per Vorkasse/&Uuml;berweisung<br><input type='radio' name='zahlung' value='1'>per PayPal</td></tr>
<tr><td colspan=2 id='space' height=5>&nbsp;</td></tr>
<tr><td valign=top><b>Bemerkungen:</b></td><td><textarea name='bemerkungen' rows='4' cols='30' style='width:320px;' class='tf1'></textarea></td></tr>
<tr><td colspan=2 id='space' height=5>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td class='tdf'><input type='checkbox' name='agb' value='1'>Ich habe Ihre AGBs gelesen und akzeptiert!</td></tr>
<tr><td colspan=2>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><input type='submit' value='Bestellung senden' style='width:320px;' class='bt'></td></tr>
</form>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
");
}
else {
$besttime = time();
$bstmenge = "0";
$bstartikel = "0";
$bstpreis = "0";
$bstges = "0";
$bstfuermail = "";
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
$gesamtwert = $gesamtwert + $db_bgesamt1;
$gesamtwert = sprintf("%01.2f", $gesamtwert);
$bstmenge .= "|$db_bmenge";
$bstartikel .= "|$db_bartikel";
$bstpreis .= "|$db_bpreis";
$bstges .= "|$db_bgesamt1";
$bstfuermail .= "\n$db_bartikel - $db_bmenge x $db_bpreis = $db_bgesamt1\n-----------------------------------------------------------------------------------------------";
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
if ($db_adminmwst!='') {
$mehrwertsteuersatz = $db_adminmwst + 100;
$bstnetto = (($rechnungsbetrag * 100)/$mehrwertsteuersatz);
$bstnetto = sprintf("%01.2f", $bstnetto);
$bstmwst = $rechnungsbetrag - $bstnetto;
$bstmwst = sprintf("%01.2f", $bstmwst);
}
else {
$bstnetto = 0;
$bstmwst = 0;
}
//bestellung speichern
$eintragen = "INSERT INTO `bestellungen` (`db_bstid`, `db_bstts`, `db_bstuserid`, `db_bstmenge`, `db_bstartikel`, `db_bstpreis`, `db_bstges`, `db_bstgesamt`, `db_bstvk`, `db_bstbetrag`, `db_bstnetto`, `db_bstmwst`, `db_bstzahlung`, `db_bstbemerkungen`, `db_bststatus`, `db_bstversand`, `db_bstrechnung`) VALUES ('', '$besttime', '$db_userid', '$bstmenge', '$bstartikel', '$bstpreis', '$bstges', '$gesamtwert', '$db_vk', '$rechnungsbetrag', '$bstnetto', '$bstmwst', '$zahlung', '$bemerkungen', '0', '0', '0')";
$eintrag = mysqli_query($verbindung, $eintragen);

$sqlbst = "SELECT * FROM bestellungen WHERE db_bstuserid = '$userid' AND db_bstts = '$besttime'";
$resbst = mysqli_query($verbindung, $sqlbst);
while($row = mysqli_fetch_assoc($resbst)) {
$db_bstid = $row['db_bstid'];
$db_bstts = $row['db_bstts'];
$db_bstuserid = $row['db_bstuserid'];
$db_bstmenge = $row['db_bstmenge'];
$db_bstartikel = $row['db_bstartikel'];
$db_bstpreis = $row['db_bstpreis'];
$db_bstges = $row['db_bstges'];
$db_bstgesamt = $row['db_bstgesamt'];
$db_bstvk = $row['db_bstvk'];
$db_bstbetrag = $row['db_bstbetrag'];
$db_bstnetto = $row['db_bstnetto'];
$db_bstmwst = $row['db_bstmwst'];
$db_bstzahlung = $row['db_bstzahlung'];
$db_bstbemerkungen = $row['db_bstbemerkungen'];
$db_bststatus = $row['db_bststatus'];
$db_bstversand = $row['db_bstversand'];
$db_bstrechnung = $row['db_bstrechnung'];
}

//mail an kunde
if ($db_useranrede == 'Herr') { $gruss = "Sehr geehrter Herr"; }
if ($db_useranrede == 'Frau') { $gruss = "Sehr geehrte Frau"; }
$betreff1 = "Ihre Bestellung";
$mailtext1 = "$gruss $db_username,\n\nvielen Dank für Ihre Bestellung und das uns entgegengebrachte Vertrauen.\nNach Zahlungseingang liefern wir Ihre bestellten Artikel sofort aus.\n\nBitte überweisen Sie den Gesamtbetrag in Höhe von $rechnungsbetrag $db_adminwaehrung\nauf folgendes Konto:\n\n$bankverbindung\n\nVerwendungszweck: Auftrag $besttime + $db_username\nBetrag: $rechnungsbetrag $db_adminwaehrung\n\nWir haben Ihre Bestellung wie folgt erfasst:\n$bstfuermail\nWarenwert: $gesamtwert $db_adminwaehrung\nVersandkosten: $db_vk $db_adminwaehrung\nRechnungsbetrag: $rechnungsbetrag $db_adminwaehrung";
if ($db_adminmwst!='') { $mailtext1 .= " (Netto: $bstnetto $db_adminwaehrung - Mwst: $bstmwst $db_adminwaehrung)"; }
 $mailtext1 .= "\n-----------------------------------------------------------------------------------------------\n\nLieferanschrift:\n$db_useranrede\n$db_uservorname $db_usernachname\n$db_useranschrift\n$db_userland-$db_userplz $db_userort\n\nÜber den Lieferstatus werden Sie per E-Mail informiert. Sollten Sie Fragen\nzu Ihrer Bestellung haben, halten Sie bitte Ihre Auftragsnummer: $besttime bereit.\n\nMit freundlichen Grüßen\n\n$mailfooter";

mail($db_useremail, $betreff1, $mailtext1, "FROM: $db_adminfirma <$db_adminemail>");

//mail an inhaber
$ip1 = $_SERVER["REMOTE_ADDR"];
$zeit1 = date('H:i', $besttime);
$datum1 = date('d.n.Y', $besttime);
if ($zahlung == '1') { $zahlart = "PayPal"; }
if ($zahlung == '2') { $zahlart = "Ueberweisung/Vorkasse"; }
$betreff2 = "Bestellung";
$mailtext2 = "Bestellung über Ihre Webseite:\n\nBestell-ID: $besttime\n\n $db_adminwebseite\n\n$db_useranrede\n$db_uservorname $db_usernachname\n$db_useranschrift\n$db_userland-$db_userplz $db_userort\n\nTelefon: $db_usertelefon\nE-Mail: $db_useremail\n\nZahlung: $zahlart\n\nBemerkungen: $bemerkungen\n\nBestellung:\n$bstfuermail\nWarenwert: $gesamtwert $db_adminwaehrung\nVersandkosten: $db_vk $db_adminwaehrung\nRechnungsbetrag: $rechnungsbetrag $db_adminwaehrung";
if ($db_adminmwst!='') { $mailtext2 .= " (Netto: $bstnetto $db_adminwaehrung - Mwst: $bstmwst $db_adminwaehrung)"; }
 $mailtext2 .= "\n-----------------------------------------------------------------------------------------------\n\nIP-Adresse: $ip1\nZeitpunkt: $datum1 - $zeit1";

mail($db_adminemail, $betreff2, $mailtext2, "FROM: $db_username <$db_useremail>");

//warenkorb loeschen
$loeschen = "DELETE FROM basket WHERE db_bsess = '$sess'";
$loesch = mysqli_query($verbindung, $loeschen);

//ausgabe
print ("
<tr><td><b>$gruss $db_username,</b><br><br>vielen Dank f&uuml;r Ihre Bestellung. Ihre Zahlungsinformationen haben wir Ihnen soeben per E-Mail gesendet.</td></tr>
<tr><td>&nbsp;</td></tr>");
if ($zahlung == '1') {
print ("<tr><td>Wenn Sie per PayPal bezahlen m&ouml;chten, klicken Sie auf den folgenden Button. Sie werden zum PayPal-Login weitergeleitet.</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_blank'>
<input type='hidden' name='cmd' value='_xclick'>
<input type='hidden' name='business' value='$db_adminpaypal'>
<input type='hidden' name='item_name' value='Online-Bestellung'>
<input type='hidden' name='item_number' value='$besttime'>
<input type='hidden' name='amount' value='$rechnungsbetrag'>
<input type='hidden' name='no_shipping' value='1'>
<input type='hidden' name='return' value='$db_adminwebseite/ppreturn.php?sess=$sess&ts=$ts&userid=$userid'>
<input type='hidden' name='cancel_return' value='$db_adminwebseite/ppno.php?sess=$sess&ts=$ts&userid=$userid'>
<input type='hidden' name='currency_code' value='$db_adminwaehrung'>
<input type='hidden' name='lc' value='DE'>
<input type='hidden' name='bn' value='PP-BuyNowBF'>
<input type='image' src='https://www.paypal.com/de_DE/DE/i/btn/x-click-but6.gif' border='0' name='submit' alt='Zahlen Sie mit PayPal - schnell, kostenlos und sicher!' onFocus='if (this.blur) this.blur()'>
<img alt='' border='0' src='https://www.paypal.com/de_DE/i/scr/pixel.gif' width='1' height='1'>
</form>
</td></tr>
");
}
}



include("include/pages0.php");
include("include/right.php");
include("include/footer.php");
mysqli_close($verbindung);
?>