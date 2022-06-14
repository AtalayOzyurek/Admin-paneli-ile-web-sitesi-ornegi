<?php
require_once("../system/dbcon.php")

?>


<?php
function head($title){
?>
 
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=$title?></title>
  
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  
  
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="bootstrap.min.css">
  
  <link rel="stylesheet" href="css/style.css">
  
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"/>

<?php }

function navbar()
{
    ?>
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="index.php"><img src="images/logo.svg" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="images/logo-mini.svg" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
         
         
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/faces/face5.jpg" alt="profile"/>
              <span class="nav-profile-name">Louis Barnett</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
<?php }
 
function menu(){
    ?>
   
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Anasayfa</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="slider.php?islem=liste">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Slider</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="hakkimizda.php">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Hakkımızda</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="hizmetler.php?islem=liste">
              <i class="mdi mdi-chart-pie menu-icon"></i>
              <span class="menu-title">Hizmetler</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="referanslar.php?islem=liste">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">Referanslar</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kartlar.php?islem=liste">
              <i class="mdi mdi-card menu-icon"></i>
              <span class="menu-title">Kartlar</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="iletisim.php">
              <i class="mdi mdi-phone menu-icon"></i>
              <span class="menu-title">İletişim</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="form.php?islem=liste">
              <i class="mdi mdi-forum menu-icon"></i>
              <span class="menu-title">Form</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sosyalag.php?islem=liste">
              <i class="mdi mdi-forum menu-icon"></i>
              <span class="menu-title">Sosyalag</span>
            </a>
          </li>
        </ul>
      </nav>
    <?php }?>


    <?php function footer () {

        ?>
            <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard template</a> from Bootstrapdash.com</span>
        </div>
        </footer>
        
      </div>
      
    </div>
    
  </div>
  

  
  <script src="vendors/base/vendor.bundle.base.js"></script>
  
  
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  
  
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  
  
  <script src="js/dashboard.js"></script>
  <script src="js/data-table.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/dataTables.bootstrap4.js"></script>
  

  <script src="js/jquery.cookie.js" type="text/javascript"></script>
        <?php }?>