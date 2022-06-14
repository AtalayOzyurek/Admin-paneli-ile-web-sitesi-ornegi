<?php 
require_once("../config.php");
$id =$_GET["id"];
$sql = "DELETE FROM iletisim WHERE id={$id}";
$stmt= $baglanti->query($sql);
$stmt->execute([$id]);
  if($sql){
    header('Location:iletisim.php');
  }
  else{
  echo "silinirken bir hatayla karşılaşıldı";
   }


?>