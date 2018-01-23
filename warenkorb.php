<?php
$next=$_GET['next']; $page=$_GET['page']; $action=$_GET['action'];
$artikel=$_GET['artikel']; $back=$_GET['back'];
$gesamtwert=0;
include("include/dbconnect.php");
include("include/sess.php");
$backlink=$back.".php?kat=$kat&sess=$sess&ts=$ts&next=$next&page=$page";
$header = "Ihr Warenkorb";
include("include/header.php");
include("include/left.php");
//hinzu
if ($action=='hinzu') {
$artikel = $_GET['artikel'];
$sql = "SELECT * FROM shopartikel WHERE db_artid = '$artikel'";
$res = mysqli_query($verbindung, $sql);
while($row = mysqli_fetch_assoc($res)) {
$db_artid = $row['db_artid'];
$db_arttitel = $row['db_arttitel'];
$db_artpreis = $row['db_artpreis'];
}
$eintragen = "INSERT INTO `basket` (`db_bid`, `db_bsess`, `db_buser`, `db_bartid`, `db_bartikel`, `db_bopt1`, `db_bopt2`, `db_bpreis`, `db_bmenge`) VALUES ('', '$sess', '', '$db_artid', '$db_arttitel', '0', '0', '$db_artpreis', '1')";
$eintrag = mysqli_query($verbindung, $eintragen);
}
//minus
if ($action=='minus') {
$artikel=$_GET['artikel'];
$wert=$_GET["wert"];
$mengeneu = $wert - 1;
if ($mengeneu == '0') {
$loeschen = "DELETE FROM basket WHERE db_bid = '$artikel'";
$loesch = mysqli_query($verbindung, $loeschen);
}
else {
$aendern = "UPDATE basket SET db_bmenge = '$mengeneu' WHERE db_bid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
}
}
//plus
if ($action=='plus') {
$artikel=$_GET['artikel'];
$wert=$_GET["wert"];
$mengeneu = $wert + 1;
$aendern = "UPDATE basket SET db_bmenge = '$mengeneu' WHERE db_bid = '$artikel'";
$upd = mysqli_query($verbindung, $aendern);
}
//loeschen
if ($action=='del') {
$artikel=$_GET['artikel'];
$loeschen = "DELETE FROM basket WHERE db_bid = '$artikel'";
$loesch = mysqli_query($verbindung, $loeschen);
}
////////////////////////////////////////////////////////////////
$sqlbas1 = "SELECT * FROM basket WHERE db_bsess = '$sess' AND db_bmenge != '0'";
$resbas1 = mysqli_query($verbindung, $sqlbas1);
$zbas1 = mysqli_num_rows($resbas1);
if ($zbas1 != '0') {
print ("
<tr><td>
<table id='tablecontent' border=0 cellpadding=0 cellspacing=0>
<tr height=18>
<td width=16>&nbsp;</td>
<td width=30 align=center>&nbsp;</td>
<td width=16>&nbsp;</td>
<td width=10>&nbsp;</td>
<td width=243>&nbsp;</td>
<td width=70 align=right><b>Preis</b></td>
<td width=70 align=right><b>Gesamt</b></td>
<td width=5 align=right>&nbsp;</td>
<td width=20 align=right>&nbsp;</td>
</tr>
<tr><td colspan=9 id='space' height=5>&nbsp;</td></tr>
<tr><td id='linebsk' colspan=9><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td colspan=9 id='space' height=5>&nbsp;</td></tr>");

$sqlbas2 = "SELECT * FROM basket WHERE db_bsess = '$sess' AND db_bmenge != '0' ORDER by db_bid";
$resbas2 = mysqli_query($verbindung, $sqlbas2);
while($row = mysqli_fetch_assoc($resbas2)) {
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
<tr height=16>
<td valign=top><a href='warenkorb.php?sess=$sess&ts=$ts&kat=$kat&artikel=$db_bid&next=$next&page=$page&back=content&action=minus&wert=$db_bmenge' onFocus='if (this.blur) this.blur()'><img src='img/bt_minus1.png' width='16' height='16' border='0'></a></td>
<td valign=top width=30><input type='text' name='menge' style='width:30px;' class='tfbsk1' value='$db_bmenge' readonly></td>
<td valign=top><a href='warenkorb.php?sess=$sess&ts=$ts&kat=$kat&artikel=$db_bid&next=$next&page=$page&back=content&action=plus&wert=$db_bmenge' onFocus='if (this.blur) this.blur()'><img src='img/bt_plus1.png' width='16' height='16' border='0'></a></td>
<td>&nbsp;</td>
<td valign=top>$db_bartikel</td>
<td align=right valign=top>$db_bpreis</td>
<td align=right valign=top>$db_bgesamt1</td>
<td align=right valign=top>&nbsp;</td>
<td align=right valign=top><a href='warenkorb.php?sess=$sess&ts=$ts&kat=$kat&artikel=$db_bid&next=$next&page=$page&back=content&action=del' onFocus='if (this.blur) this.blur()'><img src='img/trash1.gif' width='15' height='16' border='0'></a></td>
</tr>
<tr><td colspan=9 id='space' height=5>&nbsp;</td></tr>");
$gesamtwert = $gesamtwert + $db_bgesamt1;
$gesamtwert = sprintf("%01.2f", $gesamtwert);
$rechnungsbetrag = $gesamtwert;
}
print ("

<tr><td background='img/line_bsk1.png' colspan=9><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>

<tr height=30><td colspan=6><b>Gesamtbetrag in $db_adminwaehrung:</b> </td><td align=right><b>$rechnungsbetrag</b></td><td align=center colspan=2>&nbsp;</td></tr>
<tr><td background='img/line_bsk1.png' colspan=9><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td colspan=9><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td background='img/line_bsk1.png' colspan=9><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td height=10 colspan=9 class='tdklein'>(");
if ($db_adminmwst!='') { print ("inkl. $mwst Mehrwertsteuer - "); }
if ($db_adminvk=='ja') { print ("zzgl. Versandkosten"); }
else { print ("keine Versandkosten"); }
print (")</td></tr>
<tr><td colspan=9>&nbsp;</td></tr>");
if ($db_adminvk=='ja') { print ("<tr><td colspan=9>Die <a href='zahlung.php?sess=$sess&ts=$ts' onFocus='if (this.blur) this.blur()'>Versandkosten</a> werden angezeigt wenn Sie <a href='kasse.php?sess=$sess&ts=$ts&action=1'>zur Kasse</a> gehen, da diese je nach Land unterschiedlich sind.</td></tr>"); }
print ("</table>
</td></tr>
");
}
else {
print ("<tr><td>Ihr Warenkorb enth&auml;lt noch keine Artikel!</td></tr>");
}
print ("
</table>
</td></tr>
<tr><td height=20 align=center>");
if ($zbas1 != '0') {
print ("<a href='$backlink'>weiter einkaufen</a> &nbsp;&nbsp;&nbsp;<a href='kasse.php?sess=$sess&ts=$ts&action=1'>zur Kasse</a>");
}
else {print ("&nbsp;");}
print ("</td></tr>
<tr><td id='space' height=5>&nbsp;</td></tr>
</table>
</td>
<td width=10 id='space'>&nbsp;</td>
<td id='tabright' valign=top>
<table border=0 cellpadding=0 cellspacing=0 id='tableright'>
");
include("include/right.php");
include("include/footer.php");
mysqli_close($verbindung);
?>