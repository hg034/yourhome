<?php

print ("
</table>
</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 id='tableges'>
<tr><td id='space' height=6>&nbsp;</td></tr>
</table>
<table cellpadding=0 cellspacing=0 id='tablebott'>
<tr><td align=center>");
$sqlt9 = "SELECT * FROM texte WHERE db_txtid = '9'";
$rest9 = mysqli_query($verbindung, $sqlt9);
while($row = mysqli_fetch_assoc($rest9)) {
$db_txtid9 = $row['db_txtid'];
$db_txtcontent9 = $row['db_txtcontent'];
print ("$db_txtcontent9");
}
print ("</td></tr>
</table>
</center>
</body>
</html>
");

?>