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

print ("
<div id='footer'>
    <div class='container'>
        <div class='row'>
            <br>
            <br>
            <br>
              <div class='col-md-4'>
                <center>
                  <img src='img/versand.png' class='img-circle' alt='versand icon'>
                  <br>
                  <h4 class='footertext'><a href='zahlung.php?sess=$sess&ts=$ts'  onFocus='if (this.blur) this.blur()'class='h4'>Zahlung und Versand</a></h4>
              </div>
              <div class='col-md-4'>
                <center>
                  <img src='img/kontakt.png' class='img-circle' alt='...''>
                  <br>
                  <h4 class='footertext'><a href='kontakt.php?sess=$sess&ts=$ts&action=1' onFocus='if (this.blur) this.blur()' class='h4'>Kontakt</a></h4>
              </div>

              <div class='col-md-4'>
                <center>
                  <img src='img/instagram.png' class='img-circle' alt='...''>
                  <br>
                  <h4 class='footertext'><a href='https://www.instagram.com/your_homeliving/' target='_blank' class='h4'>Instagram</h4>
                  <br>
              </div>
            </div>

            <div class='row'>
            <h5 class='footertext'><a href='widerrufsrecht.php?sess=$sess&ts=$ts'  onFocus='if (this.blur) this.blur()'class='h5'>Widerrufsrecht |</a>
            <a href='agb.php?sess=$sess&ts=$ts'  onFocus='if (this.blur) this.blur()'class='h5'>AGB  |</a>
            <a href='impressum.php?sess=$sess&ts=$ts' onFocus='if (this.blur) this.blur()'class='h5'>Impressum </a></5>
            </div>
<br>
            <div class='row'>
           <h6 class='footertext'>© 2018 yourhome - Alle Rechte vorbehalten!</center></h6>
        </div>
    </div>
</div>
");




?>