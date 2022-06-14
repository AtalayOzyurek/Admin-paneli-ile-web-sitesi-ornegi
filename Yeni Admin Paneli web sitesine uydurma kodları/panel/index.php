<?php
   include("../config.php");
   session_start();
     if (isset($_SESSION['oturum'])) {
         
     }else {
         
         header("Location:giris.php");
      }
   
   
   
     // **************************** burası veri cekme **************************
   if (isset($_POST['ustbaslik'], $_POST['altbaslik'], $_POST['butonlink'])) {
   
       $ustbaslik = trim(filter_input(INPUT_POST, 'ustbaslik', FILTER_SANITIZE_STRING));
       $altbaslik = trim(filter_input(INPUT_POST, 'altbaslik', FILTER_SANITIZE_STRING));
       $butonlink = trim(filter_input(INPUT_POST, 'butonlink', FILTER_SANITIZE_EMAIL));
   
       if (empty($ustbaslik) || empty($altbaslik) || empty($butonlink)) {
           die("<p>Lütfen formu eksiksiz doldurun!</p>");
       }
   
      
   
       try {
   
           $baglanti = new PDO("mysql:host=localhost;dbname=panel", "root", "");
           $baglanti->exec("SET NAMES utf8");
           $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
           $sorgu = $baglanti->prepare("INSERT INTO form(ustbaslik, altbaslik, butonlink) VALUES(?, ?, ?)");
           $sorgu->bindParam(1, $ustbaslik, PDO::PARAM_STR);
           $sorgu->bindParam(2, $butonlink, PDO::PARAM_STR);
           $sorgu->bindParam(3, $butonlink, PDO::PARAM_STR);
   
           $sorgu->execute();
           if (isset($_POST['ustbaslik'], $_POST['altbaslik'], $_POST['butonlink'])){
           }
   
       } catch (PDOException $e) {
           die($e->getMessage());
       }
   
       $baglanti = null;
   }
   
   function basarili(){
     echo "<p>Bilgiler başarılı bir şekilde kaydedildi.</p>";
   }
   //*************************************************************************************************
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
               <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
               <a class="navbar-brand" href="index.php">
                  <!-- Logo icon -->
                  <b class=" logo-icon p-l-10">
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
                     <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                     <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="index.php"><i class="fa  m-r-5 m-l-5"></i><?=$_SESSION['kullaniciadi'];?> </a>
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
                  <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="girisalani2.php" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Giriş Alanı ALT</span></a></li>
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
               <h4 class="page-title">Gösterge Paneli</h4>
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
         <div class="card-body border-top">
            <div class="alert alert-success" role="alert">
               <h4 class="alert-heading">Hoşgeldiniz <?=$_SESSION['kullaniciadi'];?></h4>
               <hr>
               <h5 class="alert-heading">Bu panel web siteniz üzerinde değişiklikler yapmanız amacı ile tasaranmıştır.</h5>
            </div>
         </div>
      </div>
      <footer class="footer text-center">
         <!-- ============================================================== -->
         All Rights Res erved by AtaBey. Designed and Developed by <a href="http://atalayozyurek.rf.gd">AtaBey</a>.
      </footer>
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