<?php
$bmengeges = 0;
$bgesamt1 = 0;
$sqlbas3 = "SELECT * FROM basket WHERE db_bsess = '$sess' AND db_bmenge != '0'";
$resbas3 = mysqli_query($verbindung, $sqlbas3);
$zbas3 = mysqli_num_rows($resbas3);
if ($zbas3 != '0') {
    $sqlbas4 = "SELECT * FROM basket WHERE db_bsess = '$sess' AND db_bmenge != '0'";
    $resbas4 = mysqli_query($verbindung, $sqlbas4);
    while($row = mysqli_fetch_assoc($resbas4)) {
        $db_bid = $row['db_bid'];
        $db_bsess = $row['db_bsess'];
        $db_bartid = $row['db_bartid'];
        $db_bartikel = $row['db_bartikel'];
        $db_bopt1 = $row['db_bopt1'];
        $db_bopt2 = $row['db_bopt2'];
        $db_bpreis = $row['db_bpreis'];
        $db_bmenge = $row['db_bmenge'];
        $bmengeges = $bmengeges + $db_bmenge;

        $bgesamt1 = (($db_bmenge * $db_bpreis)+$bgesamt1);
    }
}
$bgesamt1 = sprintf("%01.2f", $bgesamt1);
print ("
<tr><td id='navhead1' class='lead'>Warenkorb</td></tr>
<tr><td id='space' height=10>&nbsp;</td></tr>
<tr><td>
<table id='tableright1' align=center border=0 cellpadding=0 cellspacing=0>
<tr height=20><td width=75 class='lead'>Artikel</td><td width=75 align=right class='lead'>$bmengeges</td></tr>
<tr height=20><td width=75 class='lead'>$db_adminwaehrung</td><td width=75 align=right class='lead'>$bgesamt1</td></tr>
<tr><td id='space' height=3>&nbsp;</td></tr>
<tr><td colspan=2><a href='warenkorb.php?sess=$sess&ts=$ts&kat=0&artikel=0&next=0&page=0&back=index&action=view'><img src='img/bt_basket1.png' width='150' height='22' border='0'></a></td></tr>
</table>
</td></tr>
<tr><td id='space' height=10>&nbsp;</td></tr>
<tr><td id='navhead2' class='lead'>Shopinformationen</td></tr>
<tr><td id='space' height=10>&nbsp;</td></tr>
<tr><td id='navi1'><a href='index.php?sess=$sess&ts=$ts'  onFocus='if (this.blur) this.blur()'class='lead'>Startseite</a></td></tr>
<tr><td id='navi1'><a href='zahlung.php?sess=$sess&ts=$ts'  onFocus='if (this.blur) this.blur()'class='lead'>Zahlung und Versand</a></td></tr>
<tr><td id='navi1'><a href='widerrufsrecht.php?sess=$sess&ts=$ts'  onFocus='if (this.blur) this.blur()'class='lead'>Widerrufsrecht</a></td></tr>
<tr><td id='navi1'><a href='agb.php?sess=$sess&ts=$ts'  onFocus='if (this.blur) this.blur()'class='lead'>AGB</a></td></tr>
<tr><td id='navi1'><a href='impressum.php?sess=$sess&ts=$ts' onFocus='if (this.blur) this.blur()'class='lead'>Impressum</a></td></tr>
<tr><td id='navi1a'><a href='kontakt.php?sess=$sess&ts=$ts&action=1' onFocus='if (this.blur) this.blur()' class='lead'>Kontakt</a></td></tr>
<tr><td id='space' height=10>&nbsp;</td></tr>");

$sql = "SELECT * FROM topartikel";
$res = mysqli_query($verbindung, $sql);
$z = mysqli_num_rows($res);
if ($z!=0) {
    print ("<tr><td id='navhead2' class='lead'>Top-Artikel</td></tr>
<tr><td id='space' height=15>&nbsp;</td></tr>");
    $sql = "SELECT * FROM topartikel ORDER by db_topid DESC limit 0,$db_topid1";
    $res = mysqli_query($verbindung, $sql);
    while($row = mysqli_fetch_assoc($res)) {
        $db_topid = $row['db_topid'];
        $db_topart = $row['db_topart'];
        $db_toptitel = $row['db_toptitel'];
        $db_toppreis = $row['db_toppreis'];
        $db_topimg = $row['db_topimg'];
        $db_topimgw = $row['db_topimgw'];
        $db_topimgh = $row['db_topimgh'];

        if ($db_topimg != '') { $image= "artikel/".$db_topimg;
            if ($db_topimgw>=$db_topimgh) {
                $breite = "100";    $brprozent = ((100 * $breite) / $db_topimgw);
                $hoehe = (($db_topimgh * $brprozent) / 100);    $hoehe = (ceil ($hoehe));
            }
            else {    $hoehe = "67";    $brprozent = ((100 * $hoehe) / $db_topimgh);
                $breite = (($db_topimgw * $brprozent) / 100);    $breite = (ceil ($breite));
            }
        }
        else {
            $image = "img/nopic3.png"; $breite = "100"; $hoehe = "67";
        }
        $len = strlen($db_toptitel);
        if ($len>17) {
            $db_toptitel = substr($db_toptitel, 0, 17); $db_toptitel .= "...";
        }

        print ("<tr><td align=center><a href='details.php?kat=0&sess=$sess&ts=$ts&next=0&page=0&back=index&artikel=$db_topart' onFocus='if (this.blur) this.blur()'><img src='$image' width='$breite' height='$hoehe' style='border:1px solid #cccccc;'><br>$db_toptitel</a></td></tr><tr><td id='space' height=15>&nbsp;</td></tr>");
    }
}
?>