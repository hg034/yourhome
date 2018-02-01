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


 <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

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

 <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'> 
<link rel='stylesheet' type='text/css' href='style.css' >
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css'>
<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>

<!--Navigationsmenü-->

</head>
<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' />

 <nav class='navbar menubar navbar-fixed-top'>
  <div class='container'>
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class='navbar-header'>
              <button type='button' data-target='#navbarCollapse' data-toggle='collapse' class='navbar-toggle'>
                  <span class='sr-only'></span>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
              </button>
              <a href='#' class='navbar-brand logo'><h4>My Logo Here</h4></a>
          </div>
   

          <ul class='nav navbar-nav navbar-right rightmenu'>
              <li><a href='warenkorb.php?sess=$sess&ts=$ts&kat=0&artikel=0&next=0&page=0&back=index&action=view'><span><i class='fa fa-shopping-cart'></i></span></a></li>
              
              <li class='dropdown'>
                <a href='#' class='dropdown-toggle' type='button' data-toggle='dropdown'><span><i class='fa fa-user'></i></span></a>
                <ul class='dropdown-menu'>
                  <li><a href='#'>Login</a></li>
                  <li><a href='#'>Register</a></li>
                </ul>
              </li> 
          </ul>

          <div id='navbarCollapse' class='collapse navbar-collapse'>
              <ul class='nav navbar-nav navbar-right'>
                  <li class='active'><a href='index.php?sess=$sess&ts=$ts'  onFocus='if (this.blur) this.blur()'>Startseite</a></li>
                  <li class='dropdown'>
                  <a id='dLabel' data-toggle='dropdown' href='#'>Shop</a>
                  <ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
                 <li><a href='https://mars.iuk.hdm-stuttgart.de/~hg034/yourhome/content.php?kat=1&next=0&page=1'>Sofas</a></li>
                 <li><a href='https://mars.iuk.hdm-stuttgart.de/~hg034/yourhome/content.php?kat=2&next=0&page=1'>Couchtische</a></li>
                <li><a href='https://mars.iuk.hdm-stuttgart.de/~hg034/yourhome/content.php?kat=3&next=0&page=1'>Lampen</a></li>                            
                <li><a href='https://mars.iuk.hdm-stuttgart.de/~hg034/yourhome/content.php?kat=4&next=0&page=1'>Stühle</a></li>   
                <li><a href='https://mars.iuk.hdm-stuttgart.de/~hg034/yourhome/content.php?kat=5&next=0&page=1'>Dekoration</a></li>  
                  </ul>
                  </li>
                  
          </div>
  </div><!-- end of container -->    
</nav>        
<!--Ende Navigationsmenü-->

<!--Karussell-->

<section class='sliderpanel'>
<header id='myCarousel' class='carousel slide myslider' data-interval='3000' data-ride='carousel'>

<script>
$('#myCarousel').carousel({interval:3000})
</script>

    <!-- Carousel indicators -->
    <ol class='carousel-indicators'>
        <li data-target='#myCarousel' data-slide-to='0' class='active'></li>
        <li data-target='#myCarousel' data-slide-to='1'></li>
    </ol>   
    <!-- Carousel items -->
    <div class='carousel-inner'>
        <div class='item active' style='background-image: url(https://mars.iuk.hdm-stuttgart.de/~hg034/yourhome/img/banner2.jpg);'></div>
        <div class='item' style='background-image: url(https://mars.iuk.hdm-stuttgart.de/~hg034/yourhome/img/banner1.jpg);'></div>
    </div>
    <!-- Carousel nav -->
    <a class='carousel-control left' data-slide='prev' href=#myCarousel>‹</a>
    <a class='carousel-control right' data-slide='next' href='#myCarousel'>›</a>
</header>
</section><
</div>

</body>
</html>

");

?>?>