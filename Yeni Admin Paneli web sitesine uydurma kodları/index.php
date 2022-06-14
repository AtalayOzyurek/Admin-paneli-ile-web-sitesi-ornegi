<?php
   include("config.php");
   
   $sorgu = $baglanti->prepare("SELECT * FROM girisalani Where id=1");
   $sorgu->execute();
   $sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor
   
   
   $sorgu2 = $baglanti->query("SELECT * FROM girisalani2")->fetchAll(PDO::FETCH_ASSOC);
   
   
   
   if($_POST){
       $ad_soyad=$_POST["ad_soyad"];
       $mail=$_POST["mail"];
       $aciklama=$_POST["aciklama"];
       if(!empty($ad_soyad) &&!empty($mail) &&!empty($aciklama) ){
         $sorgu2 = $baglanti->query("INSERT INTO iletisim (ad_soyad, mail, aciklama) VALUES('$ad_soyad','$mail','$aciklama')");
         
         header("Location:index.php");
     }
       else{
           echo "girmiyor";
       }
       
   }
   
   
   
   
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
            <a class="btn btn-dark text-white mx-3 " href="index2.php">slider</a>
            <a class="btn btn-dark text-white mx-3" href="cars.php">Arabalar</a>
            <a class="btn btn-dark text-white" href="panel/AAA.php">Form</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item"><a class="nav-link" href="panel/giris.php">Admin Paneli</a></li>
               </ul>
            </div>
         </div>
      </nav>
      <!-- Header-->
      <header class="masthead text-center text-white">
         <div class="masthead-content">
            <div class="container px-5">
               <h1 class="masthead-heading mb-0"><?=$sonuc["ustbaslik"];?></h1>
               <h2 class="masthead-subheading mb-0"><?=$sonuc["altbaslik"];?></h2>
               <a class="btn btn-primary btn-xl rounded-pill mt-5" href="<?=$sonuc["butonlink"];?>" target="_plank">sadsadadsa</a>
            </div>
         </div>
         <div class="bg-circle-1 bg-circle"></div>
         <div class="bg-circle-2 bg-circle"></div>
         <div class="bg-circle-3 bg-circle"></div>
         <div class="bg-circle-4 bg-circle"></div>
      </header>
      <!-- Content section 1-->
      <?php 
         foreach($sorgu2 as $person2)
         {
             ?>
      <section>
         <div class="container px-5">
            <div class="row gx-5 align-items-center">
               <div class="col-lg-6">
                  <div class="p-5"><img class="img-fluid rounded-circle" src="img/<?=$person2["resim"];?>" alt="..." /></div>
               </div>
               <div class="col-lg-6">
                  <div class="p-5">
                     <h2 class="display-4"><?=$person2["yazi1"]?></h2>
                     <p><?=$person2["yazi2"];?></p>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php
         }
         ?>
      <hr>
      <div class="contant-section px-3 px-lg-4 pb-4"  id="iletişim">
         <h2 class=" text mb-3">İletişim Formu </h2>
         <div class="row justify-content-center">
            <div class="col-md-6 d-print-none" >
               <div class="my-2">
                  <form action="" method="POST">
                     <!-- kendi mail i yazıcaksın ileride   -->
                     <div class="row">
                        <div class="col-6">
                           <input class="form-control" type="text" id="ad_soyad" name="ad_soyad" placeholder="Ad-Soyad" required>
                        </div>
                        <div class="col-6">
                           <input class="form-control" type="email" id="mail" name="mail" placeholder="E-mail adresiniz" required>
                        </div>
                     </div>
                     <div class="form-group my-2">
                        <textarea class="form-control" style="resize: none;" id="message" name="aciklama" rows="4"  placeholder="Mesajın nedir?" required></textarea>
                     </div>
                     <button class="btn btn-info mt-2" type="submit">Gönder</button>
                  </form>
               </div>
            </div>
            <div class="col-3">
               <div class="mt-2">
                  <h3 class="h6">Adres</h3>
                  <div class="pb-2 text-secondary">
                     Samsun/Atakum
                  </div>
                  <h3 class="h6">Telefon</h3>
                  <div class="pb-2 text-secondary">
                     0543 611 06 99
                  </div>
                  <h3 class="h6">E-mail</h3>
                  <div class="pb-2 text-secondary">
                     <a class="text-decoration-none text-secondary" href="mailto:atalayfurkan55@gmail.com"> 
                     atalayfurkan55@gmail.com
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
      <div class="row justify-content-center">
         <div class="col">
            <center>
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2998.050522929984!2d36.3338691152863!3d41.28600487927359!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x408877ca1f9e2c55%3A0xf05b034e1f8e2716!2zS0FZUkFTT0ZUIFlBWklMSU0gVkUgQsSwTMSwxZ7EsE0gVEVLTk9MT0rEsExFUsSwIExURC7FnlTEsC4!5e0!3m2!1str!2str!4v1628855926784!5m2!1str!2str" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </center>
         </div>
      </div>
      <hr>
      <!-- Footer-->
      <footer class="py-5 bg-black">
         <div class="container px-5">
            <p class="m-0 text-center text-white small">Copyright &copy; Your Website 2021</p>
         </div>
      </footer>
      <!-- Bootstrap core JS-->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
      <!-- Core theme JS-->
      <script src="js/scripts.js"></script>
   </body>
</html>