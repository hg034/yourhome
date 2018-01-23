<?php
////////////////////////////////////////////////////////////
//// Hier die Zugangsdaten zu Ihrer Datenbank eingeben /////
////////////////////////////////////////////////////////////

$server = "localhost"; // Ihr Server (meist localhost)
$user = "jb189"; // Ihr Account
$pass = "uYainae9ze"; // Ihr Passwort
$datenbank = "u-jb189"; // Name bzw. Kennung Ihrer Datenbank

////////////////////////////////////////////////////////////
///// ab hier nichts mehr aendern //////////////////////////
////////////////////////////////////////////////////////////
$verbindung = mysqli_connect($server,$user,$pass) or die ("Keine Verbindung möglich. Prüfen Sie die Zugangsdaten oder wenden Sie sich an den Administrator.");

mysqli_select_db($verbindung, $datenbank) or die(mysqli_error($verbindung));
$sql = "SELECT * FROM admin WHERE db_adminid = '1'";
$res = mysqli_query($verbindung, $sql);
while($row = mysqli_fetch_assoc($res)) {
$db_adminid = $row['db_adminid'];
$db_adminfirma = $row['db_adminfirma'];
$db_adminnachname = $row['db_adminnachname'];
$db_adminvorname = $row['db_adminvorname'];
$db_adminanschrift = $row['db_adminanschrift'];
$db_adminplz = $row['db_adminplz'];
$db_adminort = $row['db_adminort'];
$db_admintelefon = $row['db_admintelefon'];
$db_admintelefax = $row['db_admintelefax'];
$db_adminemail = $row['db_adminemail'];
$db_adminwebseite = $row['db_adminwebseite'];
$db_adminmwst = $row['db_adminmwst'];
$db_adminvk = $row['db_adminvk'];
$db_adminwaehrung = $row['db_adminwaehrung'];
$db_adminstnr = $row['db_adminstnr'];
$db_adminustid = $row['db_adminustid'];
$db_adminfinamt = $row['db_adminfinamt'];
$db_adminhandelsreg = $row['db_adminhandelsreg'];
$db_adminktoinh = $row['db_adminktoinh'];
$db_adminktonr = $row['db_adminktonr'];
$db_adminblz = $row['db_adminblz'];
$db_adminbank = $row['db_adminbank'];
$db_adminiban = $row['db_adminiban'];
$db_adminbic = $row['db_adminbic'];
$db_adminpaypal = $row['db_adminpaypal'];
$db_adminheadimg = $row['db_adminheadimg'];
$db_topid1 = $row['db_topid1'];
$db_topid2 = $row['db_topid2'];
}
$mwst = $db_adminmwst."%";
$mailfooter = "Mit freundlichen Grüßen\n\n$db_adminfirma\n$db_adminvorname $db_adminnachname\n$db_adminanschrift\n$db_adminplz $db_adminort\nTelefon: $db_admintelefon Telefax: $db_admintelefax\nE-Mail: $db_adminemail\nWebsite: $db_adminwebseite";
if ($db_adminstnr!='') {$mailfooter .= "\nSteuernummer: ".$db_adminstnr;}
if ($db_adminustid!='') {$mailfooter .= "\nUst-IdNr:".$db_adminustid;}
if ($db_adminhandelsreg!='') {$mailfooter .= "\nHandelsregistereintrag:".$db_adminhandelsreg." ";}
if ($db_adminfinamt!='') {$mailfooter .= "Finanzamt:".$db_adminfinamt;}
$bankverbindung = "Kontoinhaber: $db_adminktoinh\nKontonummer: $db_adminktonr\nBankleitzahl: $db_adminblz\nBank: $db_adminbank\n\nIBAN: $db_adminiban\nBIC-/SWIFT-Code: $db_adminbic";
?>