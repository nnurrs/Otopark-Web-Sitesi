<?php
$hostName = "localhost";
$userName = "root";
$password = "123456789";
$dbName = "otopark";


$baglanti =mysqli_connect($hostName,$userName,$password,$dbName);
mysqli_set_charset($baglanti, "UTF8");

if(!$baglanti)
{
    echo "Veri tabanına bağlanırken bir hata oluştu!";
}

?>