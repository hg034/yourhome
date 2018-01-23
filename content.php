<?php
$next=$_GET['next']; $page=$_GET['page'];
$prosite = 4;
include("include/dbconnect.php");
include("include/sess.php");
$sqlk2 = "SELECT * FROM kategorien WHERE db_katid = '$kat'";
$resk2 = mysqli_query($verbindung, $sqlk2);
while($row = mysqli_fetch_assoc($resk2)) {
$db_katid = $row['db_katid'];
$db_kategorie = $row['db_kategorie'];
}
$header = "Kategorie: ".$db_kategorie;
include("include/header.php");
include("include/left.php");
$sqla0 = "SELECT * FROM shopartikel WHERE db_artkat = '$kat'";
$resa0 = mysqli_query($verbindung, $sqla0);
$za0 = mysqli_num_rows($resa0);
$contseiten = $za0 / $prosite;
$contseiten1 = (ceil ($contseiten));
if ($za0!='0') {
$sqla1 = "SELECT * FROM shopartikel WHERE db_artkat = '$kat' ORDER by db_artid DESC limit $next, $prosite";
$resa1 = mysqli_query($verbindung, $sqla1);
while($row = mysqli_fetch_assoc($resa1)) {
$db_artid = $row['db_artid'];
$db_artkat = $row['db_artkat'];
$db_artts = $row['db_artts'];
$db_arttitel = $row['db_arttitel'];
$db_artpreis = $row['db_artpreis'];
$db_artimg = $row['db_artimg'];
$db_artimgw = $row['db_artimgw'];
$db_artimgh = $row['db_artimgh'];
$db_artdescr = $row['db_artdescr'];
if ($db_artimg != '') { $image= "artikel/".$db_artimg;
if ($db_artimgw>=$db_artimgh) {
    $breite = "140";    $brprozent = ((100 * $breite) / $db_artimgw);
    $hoehe = (($db_artimgh * $brprozent) / 100);    $hoehe = (ceil ($hoehe));
}
else {    $hoehe = "93";    $brprozent = ((100 * $hoehe) / $db_artimgh);
    $breite = (($db_artimgw * $brprozent) / 100);    $breite = (ceil ($breite));
}
}
else {
$image = "img/nopic1.png"; $breite = "140"; $hoehe = "93";
}
print ("
<tr><td id='tabartikel' valign=top>
<table id='tablecontent' border=0 cellpadding=0 cellspacing=0>
<tr><td id='space' height=5>&nbsp;</td></tr>
<tr>
<td width=156 align=center><a href='details.php?kat=$kat&sess=$sess&ts=$ts&next=$next&page=$page&back=content&artikel=$db_artid' onFocus='if (this.blur) this.blur()'><img src='$image' width='$breite' height='$hoehe' style='border:1px solid #CCCCCC;'></a></td>
<td width=324 align=center valign=top>
<table width=324 border=0 cellpadding=0 cellspacing=0>
<tr><td height=15><a href='details.php?kat=$kat&sess=$sess&ts=$ts&next=$next&page=$page&back=content&artikel=$db_artid' onFocus='if (this.blur) this.blur()'><b>$db_arttitel</b></a></td></tr>
<tr><td id='space' height=10>&nbsp;</td></tr>
<tr><td height=15>Preis: <b>$db_artpreis $db_adminwaehrung</b></td></tr>
<tr><td height=10 class='tdklein'>(");
if ($db_adminmwst!='') { print ("inkl. $mwst Mehrwertsteuer - "); }
if ($db_adminvk=='ja') { print ("zzgl. Versandkosten"); }
else { print ("keine Versandkosten"); }
print (")</td></tr>
<tr><td id='space' height=10>&nbsp;</td></tr>
<tr><td height=33 valign=bottom>
<table width=324 border=0 cellpadding=0 cellspacing=0>
<tr><td width=162><a href='warenkorb.php?sess=$sess&ts=$ts&kat=$kat&artikel=$db_artid&next=$next&page=$page&back=content&action=hinzu'><b>in den Warenkorb</b></a></td><td width=162><a href='details.php?kat=$kat&sess=$sess&ts=$ts&next=$next&page=$page&back=content&artikel=$db_artid'><b>Details</b></a></td></tr>
</table>
</td></tr>
</table>
</td>
</tr>
<tr><td id='space' height=5>&nbsp;</td></tr>
</table>
</td></tr>
<tr><td id='space' height=5>&nbsp;</td></tr>
<tr><td background='img/line_bsk1.png'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td id='space' height=5>&nbsp;</td></tr>
");
}
include("include/pages.php");
}
else {
print ("<tr><td>In dieser Kategorie sind noch keine Artikel vorhanden!</td></tr>");
include("include/pages0.php");
}
include("include/right.php");
include("include/footer.php");
mysqli_close($verbindung);
?>