<?php
   include("config.php");
   
   $sorgu = $baglanti->prepare("SELECT * FROM girisalani Where id=1");
   $sorgu->execute();
   $sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor
   
   
   $sorgu2 = $baglanti->query("SELECT * FROM kayan_resim LIMIT 4")->fetchAll(PDO::FETCH_ASSOC);
    

   
   
   
   
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>One Page Wonder - Start Bootstrap Template</title>
      <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
      <!-- Font Awesome icons (free version)-->
      <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
      <!-- Google fonts-->
      <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
      <!-- Core theme CSS (includes Bootstrap)-->
      <link href="css/styles.css" rel="stylesheet" />
   </head>
   <body id="page-top">
      <!-- Navigation-->
      <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
         <div class="container px-5">
            <a class="navbar-brand" href="#page-top">Start Bootstrap</a>
            <a class="btn btn-dark text-white" href="index.php">AnaSayfa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item"><a class="nav-link" href="panel/giris.php">Admin Paneli</a></li>
               </ul>
            </div>
         </div>
      </nav>
      <!-- Header-->

      <!-- Content section 1-->
      <hr>
      <div class="container">
         <div class="row justify-content-around " style="margin-top: 100px">
            <?php 
               foreach($sorgu2 as $person2)
               {
               ?>
            <div class="card" style="width: 18rem;">
               <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                     <div class="carousel-item active">
                        <img src="img/<?=$person2["resim1"]?>" class="d-block w-100" alt="...">
                     </div>
                     <div class="carousel-item">
                        <img src="img/<?=$person2["resim2"]?>" class="d-block w-100" alt="...">
                     </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                     <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                     <span class="carousel-control-next-icon" aria-hidden="true"></span>
                     <span class="visually-hidden">Next</span>
                  </button>
               </div>
            </div>
            <?php
               }
               ?>
         </div>
      </div>
      <!-- Bootstrap core JS-->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Core theme JS-->
      <script src="js/scripts.js"></script>
   </body>
</html>