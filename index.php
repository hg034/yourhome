<?php
include("include/dbconnect.php");
include("include/sess.php");
$sqlt1 = "SELECT * FROM texte WHERE db_txtid = '7'";
$rest1 = mysqli_query($verbindung, $sqlt1);
while($row = mysqli_fetch_assoc($rest1)) {
$db_txtid1 = $row['db_txtid'];
$db_txtcontent1 = $row['db_txtcontent'];
}
$header = $db_txtcontent1;
include("include/header.php");
include("include/left.php");
$sqlt8 = "SELECT * FROM texte WHERE db_txtid = '8'";
$rest8 = mysqli_query($verbindung, $sqlt8);
while($row = mysqli_fetch_assoc($rest8)) {
$db_txtid8 = $row['db_txtid'];
$db_txtcontent8 = $row['db_txtcontent'];
print ("<tr><td>$db_txtcontent8</td></tr>");
}
print ("
<tr><td>&nbsp;</td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td height=20><b>Die neusten Artikel:</b></td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=480 border=0 cellpadding=0 cellspacing=0>
<tr>");
$x=1;
$sqla1 = "SELECT * FROM shopartikel ORDER by db_artid DESC limit 0, 3";
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
$len = strlen($db_arttitel);
if ($len>17) {
$db_arttitel = substr($db_arttitel, 0, 17);
$db_arttitel .= "...";
 }
print ("<td width=150 id='toptab'>
<table width=150 border=0 cellpadding=0 cellspacing=0>
<tr><td align=center height=105><a href='details.php?kat=$db_artkat&sess=$sess&ts=$ts&next=0&page=0&back=index&artikel=$db_artid' onFocus='if (this.blur) this.blur()'><img src='$image' width='$breite' height='$hoehe' style='border:1px solid #cccccc;'></a></td></tr>
<tr><td align=center height=20><a href='details.php?kat=$db_artkat&sess=$sess&ts=$ts&next=0&page=0&back=index&artikel=$db_artid' onFocus='if (this.blur) this.blur()'>$db_arttitel</a></td></tr><tr><td height=15 align=center><b>$db_adminwaehrung $db_artpreis</b></td></tr>
</table>
</td>");
if ($x!='3') {
print ("<td width=15 id='space'>&nbsp;</td>");
}
$x++;
}
print ("</tr>
</table>
</td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=480 border=0 cellpadding=0 cellspacing=0>
<tr>");
$x=1;
$sqla1 = "SELECT * FROM shopartikel ORDER by db_artid DESC limit 3, 3";
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
$len = strlen($db_arttitel);
if ($len>17) {
$db_arttitel = substr($db_arttitel, 0, 17);
$db_arttitel .= "...";
 }
print ("<td width=150 id='toptab'>
<table width=150 border=0 cellpadding=0 cellspacing=0>
<tr><td align=center height=105><a href='details.php?kat=$db_artkat&sess=$sess&ts=$ts&next=0&page=0&back=index&artikel=$db_artid' onFocus='if (this.blur) this.blur()'><img src='$image' width='$breite' height='$hoehe' style='border:1px solid #cccccc;'></a></td></tr>
<tr><td align=center height=20><a href='details.php?kat=$db_artkat&sess=$sess&ts=$ts&next=0&page=0&back=index&artikel=$db_artid' onFocus='if (this.blur) this.blur()'>$db_arttitel</a></td></tr><tr><td height=15 align=center><b>$db_adminwaehrung $db_artpreis</b></td></tr>
</table>
</td>");
if ($x!='3') {
print ("<td width=15 id='space'>&nbsp;</td>");
}
$x++;
}
print ("</tr>
</table>
</td></tr>
");

include("include/pages0.php");
include("include/right.php");
include("include/footer.php");
mysqli_close($verbindung);
?>