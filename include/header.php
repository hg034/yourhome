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


</head>
<body background=#fff >



<!DOCTYPE html>

<html lang='en'>
    <head>
    <meta charset='utf-8'> 
  <meta name='viewport' content='width=device-width, initial-scale=1'>  
  <meta name='author' content='sumit kumar'> 
  <title>Trial</title> 
  <link href='css/bootstrap.css' rel='stylesheet' type='text/css'>
  <link href='css/font-awesome.css' rel='stylesheet' type='text/css'>
  <link href='css/style.css' rel='stylesheet' type='text/css'>
  <script src='https://use.fontawesome.com/07b0ce5d10.js'></script>
    </head>

<body>
    

    
    
<!--====================== NAVBAR MENU START===================-->
    
  
<nav class='menu'>
  <div class='container'>
    <div class='navbar-header'>
      <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>                        
      </button>
      <a class='navbar-brand' href='#'><img src='https://lh3.googleusercontent.com/-N4NB2F966TU/WM7V1KYusRI/AAAAAAAADtA/fPvGVNzOkCo7ZMqLI6pPITE9ZF7NONmawCJoC/w185-h40-p-rw/logo.png'></a>
    </div>
    <div class='collapse navbar-collapse' id='myNavbar'>
      <ul class='nav navbar-nav navbar-left'>
        <li><a href='index.php?sess=$sess&ts=$ts'  onFocus='if (this.blur) this.blur()'class='h4'>Startseite</a></li>
        
        <li class='dropdown'>
          <a class='dropdown-toggle' data-toggle='dropdown' href='#'> Artikel <span class='caret'></span></a>
          <ul class='dropdown-menu'>
            <li><a href='#'>Page 1-1</a></li>
            <li><a href='#'>Page 1-2</a></li>
            <li><a href='#'>Page 1-3</a></li>
          </ul>
        </li>
        

        


        <li><a href='#'>services</a></li>
        <li><a href='#'>gallery</a></li>
        <li><a href='#'>blog</a></li>
        <li><a href='#'>contact us</a></li>
      </ul>
      <form class='navbar-form navbar-right'>
      <div class='input-group'>        
        <div class='input-group-btn'>
          <button class='btn btn-default-1' type='submit'>
            <i class='glyphicon glyphicon-search'></i>
          </button>
        </div>
    <input type='text' class='form-control' placeholder='Search'>
      </div>
          
        <span class='cart-heart  hidden-sm hidden-xs'> 
            <a href='#'><i class='fa fa-user' aria-hidden='true'></i></a>
            <a href='#'><i class='fa fa-cart-plus' aria-hidden='true'></i></a>
        </span> 
        <span class='cart-heart  hidden-md hidden-lg'>          
            <a href='#'><i class='fa fa-heart' aria-hidden='true'></i></a>
            <a href='#'><i class='fa fa-cart-plus' aria-hidden='true'></i></a>
            <a href='#'><i class='fa fa-user' aria-hidden='true'></i></a>
            <a href='#'><i class='fa fa-globe' aria-hidden='true'></i></a>
            <a href='#'><i class='fa fa-usd' aria-hidden='true'></i></a>
        </span>   
    </form>
        
    </div>
  </div>
</nav>




<!--=================CAROUSELE START====================-->
  
    <div id='myCarousel' class='carousel slide' data-ride='carousel'>
  <!-- Indicators -->
  <ol class='carousel-indicators'>
    <li data-target='#myCarousel' data-slide-to='0' class='active'></li>
    <li data-target='#myCarousel' data-slide-to='1'></li>
    
  </ol>

  <!-- Wrapper for slides -->
  <div class='carousel-inner' role='listbox'>
    <div class='item active'>
       <img src='/home/hg034/public_html/yourhome/img/Inspiration.jpg' width='1400px' height='500px'>
      <div class='carousel-caption hidden-xs'>
        <h3>Create your Home</h3>
        <p>New Trends<br> 2018.</p>
          <button class='btn btn-default'>Angebote</button>
      </div>
    </div>

    <div class='item'>
        <img src='/home/hg034/public_html/yourhome/img/Inspiration.jpg' width='1400px' height='500px'>
      <div class='carousel-caption hidden-xs'>
        <h3>Create your Home</h3>
        <p>New Trends<br> 2018.</p>
        <button class='btn btn-default'>T</button>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class='left carousel-control' href='#myCarousel' role='button' data-slide='prev'>
    <span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
    <span class='sr-only'>Previous</span>
  </a>
  <a class='right carousel-control' href='#myCarousel' role='button' data-slide='next'>
    <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
    <span class='sr-only'>Next</span>
  </a>
</div>
    

        
    
<script src='js/jquery-3.1.1.js'></script>
<script src='js/bootstrap.js'></script>
</body>
</html>

<table border=0 cellpadding=0 cellspacing=0 id='tableges'>
<tr><td id='space' height=6>&nbsp;</td></tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 id='tableges'>
<tr>
<td id='tableft' valign=top>
<table border=0 cellpadding=0 cellspacing=0 id='tableleft'>
</body>

");

?>