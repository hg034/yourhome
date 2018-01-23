<?php
include("include/dbconnect.php");
include("include/sess.php");
$header = "Ihre PayPal-Zahlung";
include("include/header.php");
include("include/left.php");
$userid=$_GET['userid'];
print ("
<tr><td>Vielen Dank f&uuml;r Ihren Auftrag. Sobald Ihre Zahlung von PayPal best&auml;tigt wurde, wird Ihre Bestellung ausgeliefert.</td></tr>
");
include("include/pages0.php");
include("include/right.php");
include("include/footer.php");
mysqli_close($verbindung);
?>