<?php
include("../config.php");   
session_start();        // admin panelinde giriş yapmadan girmemek için yazılan kod  
  if (isset($_SESSION['oturum'])) {         // BUNA COK GEREK YOK 
      
  }else {
      header("Location:giris.php");
   }


   $sorgu = $baglanti->prepare("SELECT * FROM cars Where id=:id");
   $sorgu->execute(['id' => (int)$_GET["id"]]);
   $sonuc = $sorgu->fetch();//sorgu çalıştırılıp veriler alınıyor
   
          if ($_POST) { // Post olup olmadığını kontrol ediyoruz.
                  $baslik = $_POST['baslik']; // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
                  $aciklama = $_POST['aciklama'];
                  $link = $_POST['link'];
                  $hata = '';
   
   
                  if ($_FILES["resim"]["name"] != "") {
                   $resim = strtolower($_FILES['resim']['name']);
                   if (file_exists('img/' . $resim)) {
                       $hata = "$resim diye bir dosya var";
                   } else {
                       $boyut = $_FILES['resim']['size'];
                       if ($boyut > (1920 * 1080 * 20)) {
                           $hata = 'Dosya boyutu 20MB den büyük olamaz.';
                       } else {
                           $dosya_tipi = $_FILES['resim']['type'];
                           $dosya_uzanti = explode('.', $resim);
                           $dosya_uzanti = $dosya_uzanti[count($dosya_uzanti) - 1];
   
                          
                       }
                   }
               } else {
                   //Eğer kullanıcı fotoğraf seçmedi ise veri tabanındaki resimi değiştirmiyoruz
                   $resim = $sonuc["resim"];
               }
   
               if ($baslik <> "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
                   //Değişecek veriler
                   $satir = [
                    'id' => $_GET['id'],
                    'resim' => $resim,
                    'baslik' => $baslik,
                    'aciklama' => $aciklama,
                    'link' => $link,
                  
                ];
                   // Veri güncelleme sorgumuzu yazıyoruz.
                $sql = "UPDATE cars SET resim=:resim, baslik=:baslik, aciklama=:aciklama, link=:link WHERE id=:id;";             
                $durum = $baglanti->prepare($sql)->execute($satir);
   
                if ($durum)
                {
                   header("Location:cars.php");  
               } else {
                       echo 'Düzenleme hatası oluştu: '; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
                   }
               } else {
                   echo 'Hata oluştu: ' . $hata; // dosya hatası ve form elemanlarının boş olma durumunua göre hata döndürüyoruz.
               }
               if ($hata != "") {
           echo '<script>swal("Hata","' . $hata . '","error");</script>';
       }
           }












?>

  




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
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Admin Paneli</title>
    <!-- Custom CSS -->
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">

</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper">

        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">

                            <p>Yöneticİ Paneli</p>
                           
                        </b>

                    </a>

                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>

                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>

                    </ul>

                    <ul class="navbar-nav float-right">

                        <li class="nav-item dropdown">
                            
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><resim src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="index.php"><i class="fa fa-power-off m-r-5 m-l-5"></i><?=$_SESSION['kullaniciadi'];?> </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="cikis.php"><i class="fa fa-power-off m-r-5 m-l-5"></i> Çıkış Yap</a>
                                
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Gösterge Paneli</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="personel.php" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Personel</span></a></li>                               
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="girisalani.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Giriş Alanı</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="girisalani2duzenle.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Giriş Alanı ALT</span></a></li>   
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="iletisim.php" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">İletişim Formu</span></a></li>                                                                    
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="card.php" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Kartlar vs slider</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="cars.php" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Arabalar Bilgi</span></a></li>                                                                                                                             
                                                                    
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages/index.html" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Örnek Daha fazla...</span></a></li>                                                             

                        <!--                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="grid.html" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Full Width</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Forms </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="form-basic.html" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Form Basic </span></a></li>
                                <li class="sidebar-item"><a href="form-wizard.html" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Form Wizard </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Buttons</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Icons </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="icon-material.html" class="sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> Material Icons </span></a></li>
                                <li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><i class="mdi mdi-emoticon-cool"></i><span class="hide-menu"> Font Awesome Icons </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-elements.html" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Elements</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Addons </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="index2.html" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"> Dashboard-2 </span></a></li>
                                <li class="sidebar-item"><a href="pages-gallery.html" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> Gallery </span></a></li>
                                <li class="sidebar-item"><a href="pages-calendar.html" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>
                                <li class="sidebar-item"><a href="pages-invoice.html" class="sidebar-link"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu"> Invoice </span></a></li>
                                <li class="sidebar-item"><a href="pages-chat.html" class="sidebar-link"><i class="mdi mdi-message-outline"></i><span class="hide-menu"> Chat Option </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Authentication </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="authentication-login.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Login </span></a></li>
                                <li class="sidebar-item"><a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Register </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Errors </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 403 </span></a></li>
                                <li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 404 </span></a></li>
                                <li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 405 </span></a></li>
                                <li class="sidebar-item"><a href="error-500.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 500 </span></a></li>
                            </ul>
                        </li> -->
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

<div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Giriş Alanı 2</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <!-- ============================== Gösterge Paneli Yani ================================ --> 
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-7 d-print-none "  >
                <h3>İletişim</h3>
                <div class=" bg-success" style="width:auto%;"> 
                </div>
                <div class="my-4">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                            <label for="exampleFormControlInput1">Yazı Başlığı</label>
                                <input class="form-control" cols="40" rows="5" value="<?=$sonuc["baslik"];?>" type="text" name="baslik" placeholder="" required>
                            </div>
                            <div class="col-6">
                            <label for="exampleFormControlInput1">Yazi acıklamsaı</label>
                                <input class="form-control" type="text"  value="<?=$sonuc["aciklama"];?>" name="aciklama" placeholder="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group mt-3 col-6">
                            <label for="exampleFormControlFile1">Resim Ekle</label>
                            <img class=" m-5" src="../img/<?=$sonuc["resim"];?>" style="width:40%">
                            <input type="file" class="form-control-file" name="resim">
                        </div>
                        <div class="col-6">
                            <label for="exampleFormControlInput1">Link Yazınız</label>
                            <input class="form-control" cols="40" rows="5" value="<?=$sonuc["link"];?>" type="text" name="link" placeholder="" required>
                        </div>
                </div>
                    
                    <button class="btn btn-primary mt-2" type="submit">Güncelle </button>
                    <a class="btn btn-danger mt-2" href="cars.php"> Geri</a>

                </form>
            </div>
        </div>
    </div>
 
</div>


                     

               
           
    
            
    

                
            


        

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="assets/libs/flot/excanvas.js"></script>
    <script src="assets/libs/flot/jquery.flot.js"></script>
    <script src="assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="assets/libs/flot/jquery.flot.time.js"></script>
    <script src="assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="dist/js/pages/chart/chart-page-init.js"></script>

</body>

</html>