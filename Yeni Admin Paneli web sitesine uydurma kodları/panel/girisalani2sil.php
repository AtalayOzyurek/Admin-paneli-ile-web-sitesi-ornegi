<?php 
require_once("../config.php");
$id =$_GET["id"];
$sql = "DELETE FROM girisalani2 WHERE id=$id";
$stmt= $baglanti->query($sql);
$stmt->execute([$id]);
  if($sql){
    header('Location:girisalani2.php');
  }
  else{
  echo "silinirken bir hatayla karşılaşıldı";
   }


?>