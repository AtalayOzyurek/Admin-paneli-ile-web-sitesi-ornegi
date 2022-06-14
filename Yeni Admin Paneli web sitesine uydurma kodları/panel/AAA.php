<?php
   include("../config.php");   
   
   
     if( !empty($_FILES["file1"]["name"])  ) {
         move_uploaded_file($_FILES["file1"]["tmp_name"], "../img/" . $_FILES["file1"]["name"]);
        
         $resim=$_FILES["file1"]["name"];
         
         
   
         $sorgu = $baglanti->query("INSERT INTO sinav (resim) VALUES('$resim')");
         header("Location:AA.php");

        
     }
     

     $sorgu2 = $baglanti->query("SELECT * FROM sinav ORDER BY id DESC LIMIT 12")->fetchAll(PDO::FETCH_ASSOC);
   
   
   ?>
<!doctype html>
<html lang="en">
<!DOCTYPE html>
<html dir="ltr" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- Favicon icon -->
      
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>

      <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
      <title>Admin Paneli</title>
      <!-- Custom CSS -->
      <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
      <!-- Custom CSS -->
     
   </head>
   <body id="page-top" class="bg-dark">


   <!-- Navigation-->
   <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
         <div class="container px-5">
            <a class="navbar-brand" href="#page-top">Resimler</a>
            <a class="btn btn-dark text-white" href="../index.php">AnaSayfa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item"><a class="nav-link" href="giris.php">Admin Paneli</a></li>
               </ul>
            </div>
         </div>
      </nav>





      <div class="container">
      <div class="row justify-content-center" style="margin-top: 200px;">
         <div class="card w-25">
            <div class="card-header text-center">
               Resim Ekle
            </div>
            <div class="card-body">
               <form action="" method="POST" enctype="multipart/form-data">
                  <div class="row">
                     <div class="form-group mt-3 col-6">
                        <label class="mb-3" for="exampleFormControlFile1">Resim Ekle</label>
                        <input type="file" name="file1" class="form-control-file" id="exampleFormControlFile1">
                     </div>
                  </div>
                  <br>
                  <button class="btn btn-primary mt-2" style="width:50%;" type="submit">Gönder</button>
               </form>
            </div>
         </div>
      </div>
      </div>




<!-- Resimlerin gözüktüğü yer -->

   <div class="lightbox-gallery">
      <div class="container">
         <div class="intro">
            <h2 class="text-center">Yeni Eklenenler</h2>
         </div>
         <div class="row photos">
            <?php foreach($sorgu2 as $person){?>

            <div  class="col-sm-6 col-md-4 col-lg-3 item ">
               <a  href="../img/<?=$person["resim"];?>" data-lightbox="photos">
               <img  class="img-fluid" src="../img/<?=$person["resim"];?>" >
               </a>
            </div>
            
            <?php } ?>
         </div>
      </div>
   </div>







      <!-- 
         <center>
          <div class="col-md-6 d-print-none " style="margin-top:100px;" >
                   <div class="my-2">
                      <form action="" method="POST">
                            
                         <div class="row">
                            <div class="col-6 my-3">
                               <input class="form-control" type="text" id="ad_soyad" name="ad_soyad" placeholder="Ad  giriniz" required>
                            </div>
                            <div class="col-6 my-3">
                               <input class="form-control" type="text" id="text" name="text" placeholder="Soyad giriniz" required>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-6 my-3">
                               <input class="form-control" type="mail" id="mail" name="mail" placeholder="mail Giriniz" required>
                            </div>
                            <div class="col-6 my-3">
                               <input class="form-control" type="number" id="tel" name="tel" placeholder="Telefon numarısı " required>
                            </div>
                         </div>
                         <div class="form-group my-2">
                            <textarea class="form-control" style="resize: none;" id="message" name="mesaj" rows="4"  placeholder="Mesajın nedir?" required></textarea>
                         </div>
                         <a class="btn btn-info mt-2" type="submit">Gönder</a>
                      </form>
                   </div>
                </div>
            </center>
         --> 
      <!-- Optional JavaScript; choose one of the two! -->
      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
         <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
         -->
   </body>
</html>