<?php
include("include/dbconnect.php");
include("include/sess.php");
$header = "Zahlung und Versand";
include("include/header.php");
include("include/left.php");
print ("<tr><td>Momentan akzeptieren wir folgende Zahlungsarten:</td></tr>
<tr><td>&nbsp;</td></tr>");
$sqlt1 = "SELECT * FROM texte WHERE db_txtid = '6'";
$rest1 = mysqli_query($verbindung, $sqlt1);
while($row = mysqli_fetch_assoc($rest1)) {
$db_txtid1 = $row['db_txtid'];
$db_txtcontent1 = $row['db_txtcontent'];
print ("<tr><td>$db_txtcontent1</td></tr>");
}
if ($db_adminvk=='ja') {
print ("<tr><td>&nbsp;</td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td height=20><b>Versandkosten:</b></td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table width=480 border=0 cellpadding=0 cellspacing=0>
<tr height=22><td width=300><b>Lieferung nach</b></td><td width=180 align=right><b>Versandkosten</b></td></tr>
<tr><td id='linebsk' colspan=2><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>");
$sqlvk = "SELECT * FROM laender ORDER by db_laenderid";
$resvk = mysqli_query($verbindung, $sqlvk);
while($row = mysqli_fetch_assoc($resvk)) {
$db_laenderid = $row['db_laenderid'];
$db_laendercode = $row['db_laendercode'];
$db_land = $row['db_land'];
$db_vk = $row['db_vk'];
print ("<tr height=22><td width=300>$db_land</td><td width=180 align=right>$db_vk $db_adminwaehrung</td></tr>
<tr><td id='linebsk' colspan=2><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>");
}
print ("</table>
</td></tr>
");
}

include("include/pages0.php");
include("include/right.php");
include("include/footer.php");
mysqli_close($verbindung);
?>