<?php
print ("
</table>
</td></tr>
<tr><td height=20 align=center>
<table id='tablecontent' border=0 cellpadding=0 cellspacing=0>
<tr>
<td id='pages1' width=30>");
if ($page != '1') {
$b = $page - 1; $n = $next - $prosite;
print ("<a href='content.php?sess=$sess&ts=$ts&kat=$kat&next=$n&page=$b'><img src='img/bt_back.png' width='15' height='15' border='0'></a>");}
else {print ("<img src='img/bt_back1.png' width='15' height='15' border='0'>");}
print ("</td>
<td id='pages2' width=420 align=center>");
$p = 1; $newstart = 0;
for ($a = 1; $a <= $contseiten1; $a++) {
if ($contseiten1 >= '$p') {
print ("<a href='content.php?sess=$sess&ts=$ts&kat=$kat&next=$newstart&page=$p'");
if ($p == $page) { print (" class='aaktiv'>[$p]"); }
else { print (" class='ainaktiv'>[$p]"); }
if ($p < $contseiten1) { print ("&nbsp;"); }
}
$p++;
$newstart = $newstart + $prosite;
}
print ("</td>
<td id='pages3' width=30 align=right>");
if ($page != $contseiten1) {
$b1 = $page + 1; $n1 = $next + $prosite;
print ("<a href='content.php?sess=$sess&ts=$ts&kat=$kat&next=$n1&page=$b1'><img src='img/bt_next.png' width='15' height='15' border='0'></a>");}
else {print ("<img src='img/bt_next1.png' width='15' height='15' border='0'>");}
print ("</td>
</tr>
</table>
</td></tr>


<tr><td id='space' height=5>&nbsp;</td></tr>
</table>
</td>
<td width=10 id='space'>&nbsp;</td>
<td id='tabright' valign=top>
<table border=0 cellpadding=0 cellspacing=0 id='tableright'>
");

?>