<?php 
require_once("../config.php");

$id =$_GET["id"];
$sql = "DELETE FROM cars WHERE id=$id";
$stmt= $baglanti->query($sql);
$stmt->execute([$id]);
  if($sql){
    header('Location:cars.php');
  }
  else{
  echo "silinirken bir hatayla karşılaşıldı";
   }


?>