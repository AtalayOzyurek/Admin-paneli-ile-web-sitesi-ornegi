<?php require_once("interface.php"); 

if ($_GET["islem"] == "resim_ekle")
{
  $baslik = $_POST["baslik"];
  $aciklama = $_POST["aciklama"];
  $resim = upload();

  $sql = "INSERT INTO hizmetler (baslik, aciklama, resim)
  VALUES ('$baslik', '$aciklama', '$resim')";
  $conn->exec($sql);
  header("Location: ?islem=liste");
}
if($_GET["islem"]=="resim_duzenle"){
  $id = $_GET["id"];
  $resim = "SELECT * FROM hizmetler WHERE id=$id";
  $result = $conn->query($resim);
  $row = $result->fetch(PDO::FETCH_ASSOC);
  $baslik = $_POST["baslik"];
  $aciklama = $_POST["aciklama"];



  if (empty($baslik)) {$baslik = $row["baslik"];}
  if (empty($aciklama)) {$aciklama = $row["aciklama"];}

  if(file_exists($_FILES['resim']['tmp_name']) || is_uploaded_file($_FILES['resim']['tmp_name'])) {
    unlink($row['resim']);
    $resim  = upload();
    $edit = "UPDATE hizmetler SET baslik='$baslik', resim='$resim', aciklama='$aciklama' WHERE id=$id";
  } else {
  $edit = "UPDATE hizmetler SET baslik='$baslik', aciklama='$aciklama' WHERE id=$id";
  }

  $conn->exec($edit);
  header("Location: ?islem=liste");
}

if($_GET["islem"]=="sil"){

  $id = $_GET['id'];
  $image="SELECT resim FROM hizmetler WHERE id=$id";
  $result=$conn->query($image);
  $row = $result->fetch(PDO::FETCH_ASSOC);
  unlink($row["resim"]);
  $del ="DELETE FROM hizmetler WHERE id=$id";
  $conn->query($del);
  header("Location: ?islem=liste");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <?=head("Hizmetler")?>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
   <?=navbar()?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
     <?=menu()?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
  

          <?php
					switch(@$_GET["islem"]){
						case "ekle":
				?>

            <div class="content-wrapper">
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Hizmet Ekle</h4>


                      <form action="?islem=resim_ekle" method="POST" enctype="multipart/form-data" class="forms-sample">
                        <div class="form-group">

                          <label>Resim</label>
                          
                          <input type="file" name="resim" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Başlık</label>
                          <input type="text" name="baslik" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Açıklama</label>
                          <textarea type="text" name="aciklama" class="form-control"></textarea>
                        </div>



                        <button type="submit" class="btn btn-primary mr-2">Ekle</button>
                      </form>


                    </div>
                  </div>
                </div>
                <?php break ?>


              </div>
            </div>

            <?php

						case "duzenle":
              $id=$_GET["id"];
              $hizmetler = "SELECT * FROM hizmetler WHERE id=$id"; 
              $result = $conn->query($hizmetler);
              $row = $result->fetch(PDO::FETCH_ASSOC);
        
					?>


            <div class="content-wrapper">
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Hizmet Düzenle</h4>


                      <form action="?islem=resim_duzenle&id=<?=$id?>" method="POST" class="forms-sample"
                      enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="exampleInputUsername1">Resim</label>
                          <br>
                          <img style="width: 25%;height: auto; border:3px solid black; " src="<?=$row["resim"]?>" alt="">
                          <input type="file" name="resim" class="form-control" id="exampleInputUsername1">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Başlık</label>
                          <input type="text" name="baslik" value="<?=htmlspecialchars($row["baslik"])?>" class="form-control" id="exampleInputUsername1">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Açıklama</label>
                          <textarea type="text" name="aciklama" class="form-control"
                            id="exampleInputEmail1"><?=htmlspecialchars($row["aciklama"]);?></textarea>
                        </div>



                        <button type="submit" class="btn btn-primary mr-2">Güncelle</button>
                      </form>


                    </div>
                  </div>
                </div>



              </div>
            </div>

          <?php break; case 'liste': ?>
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Hizmetler</h4>
                  <p class="card-description">
                  <a style="color:white; float: right;" class="btn btn-primary" href="hizmetler.php?islem=ekle"> Hizmet Ekle</a>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Resim
                          </th>
                          <th>
                           Başlık
                          </th>
                          <th>
                          Açıklama
                          </th>
                          <th>
                            İşlem
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach($conn->query("select * from hizmetler") as $row)
                        {

                        
                        ?>
                        <tr>
                          <td class="py-1">
                            <img src="<?=$row["resim"] ?>" alt="image">
                          </td>
                          <td>
                            <?=$row["baslik"] ?>
                          </td>
                          <td>
                            <?=$row["aciklama"]?>
                          </td>
                          <td>
                          <a style="color:white" class="btn btn-info"
                              href="hizmetler.php?islem=duzenle&id=<?=$row["id"]?>">Düzenle</a>
                         <a class="btn btn-danger" href="hizmetler.php?islem=sil&id=<?=$row["id"]?>">Sil</a>

                          
                          </td>
                        
                        </tr>
                      <?php } ?>

                 
                
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
     
      
          </div>
        </div>
              

        <?php
        
        
        break;
            
					}
				?>


       <?=footer()?>
</body>

</html>
