<?php
$mysqlsunucu = "localhost";
$mysqlkullanici = "root";
$mysqlsifre = "";
$veritabaniadi = "php";

try {
    $conn = new PDO("mysql:host=$mysqlsunucu;dbname={$veritabaniadi};charset=utf8", $mysqlkullanici, $mysqlsifre);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Bağlantı hatası: " . $e->getMessage();
    }

function upload(){
    $target_dir = "images/uploads/";
    $file_name = $_FILES["resim"]["name"];
    $imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    
    $target_file = $target_dir . md5(basename($file_name).rand(0, getrandmax())).'.'.$imageFileType;
    $uploadOk = 1;
    
    
    // Check if image file is a actual image or fake image
    
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["resim"]["tmp_name"]);
        if($check !== false) {
        $uploadOk = 1;
        } else {
        $uploadOk = 0;
        }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Üzgünüm Dosya Zaten Var..";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["resim"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["resim"]["name"])). " has been uploaded.";
        } else {
        echo "Sorry, there was an error uploading your file.";
        }
    }
    
    return $target_file;
}
?>