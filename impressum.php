<?php
include("include/dbconnect.php");
include("include/sess.php");
$header = "Impressum";
include("include/header.php");
include("include/left.php");
$sqlt1 = "SELECT * FROM texte WHERE db_txtid = '1'";
$rest1 = mysqli_query($verbindung, $sqlt1);
while($row = mysqli_fetch_assoc($rest1)) {
$db_txtid1 = $row['db_txtid'];
$db_txtcontent1 = $row['db_txtcontent'];
print ("<tr><td>$db_txtcontent1</td></tr>");
}
print ("
<tr><td>&nbsp;</td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td height=20><b>Disclaimer/Haftungsausschluss:</b></td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td>&nbsp;</td></tr>");
$sqlt2 = "SELECT * FROM texte WHERE db_txtid = '2'";
$rest2 = mysqli_query($verbindung, $sqlt2);
while($row = mysqli_fetch_assoc($rest2)) {
$db_txtid2 = $row['db_txtid'];
$db_txtcontent2 = $row['db_txtcontent'];
print ("<tr><td>$db_txtcontent2</td></tr>");
}
print ("<tr><td>&nbsp;</td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td height=20><b>Copyright:</b></td></tr>
<tr><td id='linebsk'><img src='img/clearpix.gif' width='1' height='1' border='0'></td></tr>
<tr><td>&nbsp;</td></tr>
");
$sqlt3 = "SELECT * FROM texte WHERE db_txtid = '3'";
$rest3 = mysqli_query($verbindung, $sqlt3);
while($row = mysqli_fetch_assoc($rest3)) {
$db_txtid3 = $row['db_txtid'];
$db_txtcontent3 = $row['db_txtcontent'];
print ("<tr><td>$db_txtcontent3</td></tr>");
}


include("include/pages0.php");
include("include/right.php");
include("include/footer.php");
mysqli_close($verbindung);
?>