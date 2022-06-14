<?php
$mysqlsunucu = "localhost";
$mysqlkullanici = "root";
$mysqlsifre = "";

try {
    $baglanti = new PDO("mysql:host=$mysqlsunucu;dbname=panel;charset=utf8", $mysqlkullanici, $mysqlsifre);
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
    echo "Bağlantı hatası: " . $e->getMessage();
    }


function upload(){
    $target_dir = "images/uploads/";
    $file_name = $_FILES["resim"]["name"];
    $imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));