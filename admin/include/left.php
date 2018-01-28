<?php
print ("<html>
<head>
	<link rel='stylesheet' type='text/css' >
</head>
");
print ("
<tr><td id='navhead1' class='lead'>Kategorien</td></tr>
<tr><td id='space' height=10>&nbsp;</td></tr>
");
$sqlk0 = "SELECT * FROM kategorien";
$resk0 = mysqli_query($verbindung, $sqlk0);
$k0 = mysqli_num_rows($resk0);
$x=1;
$sqlk1 = "SELECT * FROM kategorien";
$resk1 = mysqli_query($verbindung, $sqlk1);
while($row = mysqli_fetch_assoc($resk1)) {
    $db_katid = $row['db_katid'];
    $db_kategorie = $row['db_kategorie'];
    if ($x!=$k0) { $tabid="navi1"; } else { $tabid="navi1a"; }
    print ("<tr><td id='$tabid'><a href='content.php?kat=$db_katid&sess=$sess&ts=$ts&next=0&page=1' class='lead'>$db_kategorie</a></td></tr>");
    $x++;
}
print ("
<tr><td id='space' height=10>&nbsp;</td></tr>
<tr><td id='navhead2' class='lead'>Wir akzeptieren</td></tr>
<tr><td id='space' height=10>&nbsp;</td></tr>
<tr><td align=center height=70>
<!-- PayPal Logo --><a href='https://www.paypal.com/de/cgi-bin/webscr?cmd=xpt/cps/popup/OLCWhatIsPayPal-outside' target='_blank' onFocus='if (this.blur) this.blur()'><img src='https://www.paypal.com/de_DE/DE/i/logo/lockbox_150x50.gif' width=150 height=50 border='0' alt='PayPal-Bezahlmethoden-Logo'></a><!-- PayPal Logo -->
</td></tr>
</table>
</td>
<td width=10 id='space'>&nbsp;</td>
<td id='tabmiddle' valign=top>
<table border=0 cellpadding=0 cellspacing=0 id='tablemiddle'>
<tr><td id='conthead1'>$header</td></tr>
<tr><td id='space' height=10>&nbsp;</td></tr>
<tr><td valign=top id='tabcontent1'>
<table align=center border=0 cellpadding=0 cellspacing=0 id='tablecontent'>
");
?>