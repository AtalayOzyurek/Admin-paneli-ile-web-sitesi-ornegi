<?php 
require_once("../config.php");
$id =$_GET["id"];
$sql = "DELETE FROM kayan_resim WHERE id={$id}";
$stmt= $baglanti->query($sql);
$stmt->execute([$id]);
  if($sql){
    header('Location:card.php');
  }
  else{
  echo "silinirken bir hatayla karşılaşıldı";
   }


?>