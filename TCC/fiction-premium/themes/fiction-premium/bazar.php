<?php

session_start();
require_once "conexaobd.php";


if (empty($_GET["categ"]) == true){
  $sqlBazar = mysqli_query($conn, "SELECT * FROM tbroupa WHERE bazar = 'S'");
}
else{
  $categ = $_GET["categ"];
  $sqlBazar = mysqli_query($conn, "SELECT * FROM tbroupa where id_categ = '".$categ."' and bazar = 'S'");
}

//Categorias
$sqlCateg = mysqli_query($conn, "SELECT * FROM tbcategoria, tbroupa where tbcategoria.id_categ = tbroupa.id_categ and tbroupa.bazar = 'S' GROUP BY nome_categ");



if(isset($_SESSION["erro"])){
    $erro = $_SESSION["erro"];

}
else{
    $erro = 0;
    
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Moda e Magia | Bazar</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <!-- ThemeFisher Icon -->
    <link rel="stylesheet" href="plugins/themefisher-fonts/themefisher-fonts.css">
    <!-- Light Box -->
    <link rel="stylesheet" href="plugins/magnific-popup/magnific-popup.css">
    <!-- animation css -->
    <link rel="stylesheet" href="plugins/animate/animate.css">
    <!-- slick slider -->
    <link rel="stylesheet" href="plugins/slick/slick.css">

    <!-- Revolution Slider -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Link do icone -->
    <link rel="icon" href="images/icones/icone_mm_black_recortado.png" />

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map_canvas {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
    </style>
    <script src="plugins/modernizr.min.js"></script>
  </head>
  <body>
    <!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

  <!-- Loader to display before content Load-->
  <div class="loading">

    <!-- <img src="img/loader.gif" alt=""> -->

    <div class="windows8 loading-position">
      <div class="wBall" id="wBall_1">
        <div class="wInnerBall"></div>
      </div>
      <div class="wBall" id="wBall_2">
        <div class="wInnerBall"></div>
      </div>
      <div class="wBall" id="wBall_3">
        <div class="wInnerBall"></div>
      </div>
      <div class="wBall" id="wBall_4">
        <div class="wInnerBall"></div>
      </div>
      <div class="wBall" id="wBall_5">
        <div class="wInnerBall"></div>
      </div>
    </div>
  </div> 


  <nav class="navbar navbar-fixed-top navigation" >
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="index.php">
          <h3>Moda & Magia</h3>
        </a>
      </div>
      <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav navbar-right menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="closet.php">Closet Virtual</a></li>
          <li><a href="blog.php">Blog</a></li>
          <li><a href="bazar.php">Bazar</a></li>
          <li><a href="contact.php">Contato</a></li>
          <li><a href="perfil.php" >Perfil</a></li>
          <?php 
            if($_SESSION["logado"] == true){
              ?>
              <li><a href="sair.php" >Sair</a></li>
              <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Portfolio header-section 
  =========================-->
  <header class="hero-area th-fullpage" data-parallax="scroll" data-image-src="images/slider/bg-bazar.jpeg">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1></h1>
        </div>
      </div>
    </div>
  </header>

 <!-- Portfolio Sections 
 =========================-->
 <section class="portfolio">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="title text-center">
          <h2>Nossas Roupas</h2>
        </div>
        <div class="protfolio-mixitup-btn text-center">
          <a class="filter btn btn-default btn-main" href="bazar.php">Todas as Roupas</a>
          <?php while($rsCateg = mysqli_fetch_array($sqlCateg)){ ?>
          <a class="filter btn btn-default btn-main" href="bazar.php?categ=<?php echo $rsCateg["id_categ"] ?>"><?php echo $rsCateg["nome_categ"] ?></a>
          <?php } ?>
        </div>
        <div id="Container" class="filtr-container row">

          <?php while ($rsBazar = mysqli_fetch_array($sqlBazar)){
              //Seleção de Imagens
              $sqlImg = mysqli_query($conn,"SELECT TO_BASE64(img_roupa) FROM tbroupa WHERE id_roupa = '".$rsBazar["id_roupa"]."'");
              $rsImg = mysqli_fetch_array($sqlImg); 
            ?>

            <div class="filtr-item col-md-4 col-sm-6 col-xs-12" data-category="">
              <div class="portfolio-list">
                <a href="roupaBazar.php?idroupa=<?php echo $rsBazar["id_roupa"] ?>">
                  <div class="th-mouse-portfolio-card">
                    <div class="thumbnail portfolio-thumbnail">
                      <img src="data:image/jpg;base64,<?php echo $rsImg["TO_BASE64(img_roupa)"] ?>" alt="Portfolio">
                      <div class="caption portfolio-caption">
                        <h3 class="portfolio-title"><?php echo $rsBazar["nome_roupa"] ?></h3>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="footer">
  <div class="container">
      <div class="row">
          <div class="text-center">
              <div class="col-md-12">
                  <div class="copyright">
                      <p>&copy; 2019-2021 Todos os direitos reservados. <br></p>
                  </div>
              </div>
          </div>
      </div>
    </div>
</footer>


    <script src="plugins/jquery.min.js"></script>

    <script src="plugins/bootstrap/bootstrap.min.js"></script>
    <!-- slick slider -->
    <script src="plugins/slick/slick.min.js"></script>
    <!-- filter -->
    <script src="plugins/filterizr/jquery.filterizr.min.js"></script>
    <!-- Lightbox -->
    <script src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <!-- Parallax -->
    <script src="plugins/parallax.min.js"></script>
    <!-- Video -->
    <script src="plugins/jquery.vide.js"></script>
    <!-- google map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu5nZKbeK-WHQ70oqOWo-_4VmwOwKP9YQ"></script>
    <script src="plugins/google-map/gmap.js"></script>

    <script src="js/script.js"></script>
    </body>

    </html>
