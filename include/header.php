<!doctype html>
<html lang="en">
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
};
?>
<head>
    <script src=\"https://code.jquery.com/jquery-3.2.1.slim.min.js\" integrity=\"sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN\" crossorigin=\"anonymous\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js\" integrity=\"sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q\" crossorigin=\"anonymous\"></script>
    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js\" integrity=\"sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl\" crossorigin=\"anonymous\"></script>
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
<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css\" integrity=\"sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm\" crossorigin=\"anonymous\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
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
<td id='tableft' valign=top> </td>
<table border=0 cellpadding=0 cellspacing=0 id='tableleft'>
</table>
</body>
</html>
