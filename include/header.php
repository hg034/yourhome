<?php
$sqlt10 = "SELECT * FROM texte WHERE db_txtid = '10'";
$rest10 = mysqli_query($verbindung, $sqlt10);
while($row = mysqli_fetch_assoc($rest10)) {
$db_txtid10 = $row['db_txtid'];
$db_txtcontent10 = $row['db_txtcontent'];
}
$sqlt11 = "SELECT * FROM texte WHERE db_txtid = '11'";
$rest11 = mysqli_query($verbindung, $sqlt11);
while($row = mysqli_fetch_assoc($rest11)) {
$db_txtid11 = $row['db_txtid'];
$db_txtcontent11 = $row['db_txtcontent'];
}
print ("
<html>
<head>
<title>Onlineshop</title>
<meta name='description' content='$db_txtcontent10'>
<meta name='keywords' content='$db_txtcontent11'>
<meta name='content-Language' content='de'>
<meta http-equiv='AUTHOR' content='Webdesign Dessau'>
<meta name='COPYRIGHT' content='Webdesign Dessau'>
<meta name='PUBLISHER' content='A. Steppich'>
<meta name='ROBOTS' content='INDEX, FOLLOW'>
<meta name='REVISIT-AFTER' content='7 days'>
<meta http-equiv='Pragma' content='no-cache'>
<meta http-equiv='Cache-Control' content='no-cache'>
<link rel='stylesheet' href='style.css' type='text/css'>
</head>
<body background=#fff >
<center>
<table cellpadding=0 cellspacing=0 id='tabletop'>
<tr><td><img src='img/$db_adminheadimg' width='880' border='0'></td></tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 id='tableges'>
<tr><td id='space' height=6>&nbsp;</td></tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 id='tableges'>
<tr>
<td id='tableft' valign=top>
<table border=0 cellpadding=0 cellspacing=0 id='tableleft'>
");

?>