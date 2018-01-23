<?php
//admindaten aus db
$sqladm = "SELECT * FROM admin WHERE db_adminid = '1'";
$resadm = mysqli_query($verbindung, $sqladm);
while($row = mysqli_fetch_assoc($resadm)) {
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
}

$mwst = $db_adminmwst."%";

?>