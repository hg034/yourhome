<?php
include("include/dbconnect.php");
include("include/sess.php");
$header = "Allgemeine Gesch&auml;ftsbedingungen";
include("include/header.php");
include("include/left.php");
$sqlt1 = "SELECT * FROM texte WHERE db_txtid = '4'";
$rest1 = mysqli_query($verbindung, $sqlt1);
while($row = mysqli_fetch_assoc($rest1)) {
$db_txtid1 = $row['db_txtid'];
$db_txtcontent1 = $row['db_txtcontent'];
print ("<tr><td>$db_txtcontent1</td></tr>");
}
include("include/pages0.php");
include("include/right.php");
include("include/footer.php");
mysqli_close($verbindung);
?>