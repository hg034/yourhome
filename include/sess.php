<?php
if (empty($_GET['kat'])) { $kat=0; } else { $kat = $_GET['kat']; }

//alte eintraege loeschen
$aktts = time();
$diff = $aktts - 7200;
$loeschen = "DELETE FROM login WHERE db_logts < '$diff'";
$loesch = mysqli_query($verbindung, $loeschen);

//auslesen
if (empty($_GET['sess'])) {
$ts = time();
$sess = md5($ts);
$ip = $_SERVER["REMOTE_ADDR"];
$user = "0";
$eintragen = "INSERT INTO `login` (`db_logid`, `db_logts`, `db_logsess`, `db_logip`, `db_loguser`, `db_logusername`) VALUES ('', '$ts', '$sess', '$ip', '$user', '0')";
$eintrag = mysqli_query($verbindung, $eintragen);
}

else {
$sess = $_GET['sess'];
$ts = $_GET['ts'];
}

?>