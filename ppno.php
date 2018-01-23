<?php
include("include/dbconnect.php");
include("include/sess.php");
$header = "Ihre PayPal-Zahlung";
include("include/header.php");
include("include/left.php");
$userid=$_GET['userid'];
print ("
<tr><td>Bei der PayPal-Zahlung ist ein Fehler aufgetreten. Bitte zahlen Sie den Rechnungsbetrag manuell auf unsere PayPal-Adresse $db_adminpaypal ein oder &uuml;berweisen Sie den Betrag auf die Bankverbindung, die Ihnen per E-Mail mitgeteilt wurde.</td></tr>
");
include("include/pages0.php");
include("include/right.php");
include("include/footer.php");
mysqli_close($verbindung);
?>