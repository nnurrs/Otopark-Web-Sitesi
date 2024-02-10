<?php
include("dbConnect.php");
session_start();

// Veritabanından ilk 3 yorumu çekme
$yorumlarSorgu = "SELECT * FROM yorumlar LIMIT 3";
$yorumlarSonuc = mysqli_query($baglanti, $yorumlarSorgu);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ana Sayfa</title>
   
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="anaSayfa.css" />
    <style>

      body {
      margin: 0;
      padding: 0;
      font-size: 14px;
      display: flex;
      flex-direction: column; /*flex ile beraber ögeleri hizalamak için kullanılır */
      background-image: linear-gradient(to right, rgb(114, 114, 114) 30%, #6a55a3 70%); /* geçişli mavi gri */

  
    }
    .menu {
      background-color: #f1f1f1;
    }
    .content {
      display: flex;
      flex: 1;
      margin-top: 80px;  
    }
    .sidebar {
      flex: 0 0 50%; /* carousel boşlukları için*/ 
      background-color: #ddd;
      margin-bottom: 20%;
    }
    .main {
      flex: 1; 
      overflow: hidden; /* İçeriğin taşmasını engeller */
    }
    .carousel-container {
      height: 100%; /* Carousel'ın container'ını doldurmasını sağlar */
      display: flex;
      align-items: center;
      justify-content: center;
    }
      
    </style>
    <script>
    function goToCard3() {
      document.getElementById('card3').scrollIntoView({behavior: 'smooth', block: 'start'});
      //behavior:smooth->kaydırma efekti ile card ekrana gelsin //block:start->card ın üst kısmı ile sayfanı üst kısmı hizalansın 
      document.getElementById('card3').style.display='block';
    }
    </script>
    <style>
  .dropdown-menu {
    max-width: 800px; /* Dropdown menüsünün maksimum genişliği */
  }
</style>
  </head>
  <body >
    
  <div style="top: 0; left: 0; right: 0; background-color:#342c5b;color: #ccc; height: 80px; display: flex; justify-content: space-between; align-items: center;">
  <div style="display: flex; align-items: center;"> <!-- Logo ve Metin -->
    <img src="logo.png" alt="Foto" style="width: 100px; height: 70px; margin-right: 50px; margin-left:40px">
    <div style="text-align: center; font-size:20px; font-family: Gotham;   letter-spacing: 0.05em;">GÜVEN OTOPARK'A HOŞ GELDİNİZ</div>
  </div>

  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" style="width:330px; height: 60px; font-size: 15px; background-color:white; color: black; margin-right:49px;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
  <img src="home.png" alt="Kayıt Fotoğrafı" style="width: 50px; height: 40px; margin-right: 5px;"> 
  ANA SAYFA
  </button>
  <ul class="dropdown-menu" >
    <li><a class="dropdown-item" href="kayit.php" style="font-size: 15px;">
    <img src="kayit.png" alt="Kayıt Fotoğrafı" style="width: 50px; height: 50px; margin-right: 5px;">
    KAYIT OL</a></li>
    <br><br>
    <li><a class="dropdown-item" href="giris.php" style="font-size: 15px;">
    <img src="giris.png" alt="Kayıt Fotoğrafı" style="width: 50px; height: 50px; margin-right: 5px;">
    GİRİŞ YAP</a></li>
    <br><br>
    <li><a class="dropdown-item" href="cikis.php" style="font-size: 15px;">
    <img src="cikis.png" alt="Kayıt Fotoğrafı" style="width: 50px; height: 50px; margin-right: 5px;">
    ÇIKIŞ YAP</a></li>
  </ul>
</div>
</div>

<div class="content">
  <div class="sidebar" style="margin-top:1%">

  <div class="main">
  <div class="carousel-container">  
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" style="height: 70%;">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="otopark.png" class="d-block w-100" style="width: 30%; height: 40%;" alt="...">
      </div>
      <div class="carousel-item">
        <img src="otopark2.jpg" class="d-block w-100" style="width: 30%; height: 40%;" alt="...">
      </div>
      <div class="carousel-item">
        <img src="otopark3.jpg" class="d-block w-100" style="width: 30%; height: 40%;" alt="...">
      </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div> <!-- slide ın divi-->
</div> <!--cont div-->


</div> <!-- main div-->

</div> <!--sidebar div-->
<div class="card-container text center" style="margin-left: 20px; margin-top:-3%">
        <!-- 1. card icerigi-->

    <div class="card mx-auto" style="width: 60rem; height: 270px;  " id="card1">
    <img src="cardaraba.jpg" class="card-img-top" style="width: 15%; height: auto;" alt="...">
    <div class="card-body">
        <h5 class="card-title" style="font-size:20px">Güvenin adresi: Güven Otopark!</h5>
        <p class="card-text">Siz müşterilerimizin memnuniyeti bizler için önceliklidir. 1980 yılından bu yana siz müşterilerimizin bize güvenerek bıraktığı emanetler olan araçlarınızı dikkatle koruyoruz. 
        <br>İşte size otoparkımızı kullanan bazı müşterilerimizin yorumları! Daha fazlasını görmek için kayıt olup ardından giriş yapabilirsiniz!</p>

        <button onclick="goToCard3()" class="btn btn-primary" style="background-color:#925d9a;">Müşteri yorumlarını görmek için tıklayın</button>

    </div>
    
    </div>
    <!--card div-->
<br><br>
        <!-- 2. card icerigi-->
    <div class="card mx-auto" style="width: 60rem; height:290px;">
    <img src="cardaraba2.jpg" class="card-img-top" style="width: 15%; height: auto;" alt="...">
    <div class="card-body">
        <h5 class="card-title"  style="font-size:20px">Hakkımızda daha fazlası!</h5>
        <p class="card-text">Otoparkımız, 24 saat boyunca güvenlik kamerası sistemi ile korunmakta olan kapalı bir otoparktır. Ayrıca otoparkımızda çalışan görevli arkadaşlarımızın gözleri sürekli araçlarınızın üzerinde! 
            Yani merak etmeyin, araçlarınız güvenin adresi olan Güven Otopark'ta güvenle sizleri bekliyor!<br>
             Siz de aracınızı güvenli bir yere bırakmak isterseniz tam da doğru adrestesiniz! Hemen kayıt olun ve aracınızı güvende tutmanın farkını bizimle yaşayın! </p>
        <a href="kayit.php" class="btn btn-primary" style="background-color:#925d9a;">Hemen şimdi kayıt olun!</a>
    </div>
    
    </div><!--card div-->
</div>

</div><!-- content div-->
        <!-- 3. card icerigi-->
        <div class="card mx-auto custom-card " style="width: 100rem; height:400px; margin-top:1px; margin-bottom: 100px; display:none" id="card3">
    <img src="cardaraba3.jpg" class="card-img-top" style="width: 15%; height: auto;" alt="...">
    <div class="card-body">
    <?php
          if ($yorumlarSonuc && mysqli_num_rows($yorumlarSonuc) > 0) {
            while ($row = mysqli_fetch_assoc($yorumlarSonuc)) {
              // Müşteri adını ve soyadını almak için müşteri tablosundan sorgu yapalım
              $cnumber = $row['cnumber'];
              $musteriSorgusu = "SELECT name, surname FROM musteriler WHERE cnumber = '$cnumber'";
              $musteriSonuc = mysqli_query($baglanti, $musteriSorgusu);
              $musteriBilgisi = mysqli_fetch_assoc($musteriSonuc);

              $ad = $musteriBilgisi['name'];
              $soyad = $musteriBilgisi['surname'];
              $adKisaltma = $ad[0] . str_repeat('*', strlen($ad) - 1);
              $soyadKisaltma = $soyad[0] . str_repeat('*', strlen($soyad) - 1);

              // Adı ve soyadı ekrana yazdıralım
              echo '<h5 class="card-title" style="font-size:20px">' . $adKisaltma . ' ' . $soyadKisaltma . '</h5>';
              echo '<p class="card-text">' . $row['yorum'] . '</p>';
            }
          } else {
            echo '<p class="card-text">Henüz yorum bulunmamaktadır.</p>';
          }
        ?>

        <a href="kayit.php" class="btn btn-primary" style="background-color:#925d9a;">Daha fazla yorum görüntülemek için, kayıt olup ardından giriş yapabilirsiniz!</a>
    </div>

    </div><!--card div-->


    <div style="position: fixed; bottom: 0; left: 0; right: 0; background-color:#342c5b;color: #ccc; height: 50px; display: flex; justify-content: center; align-items: center;">
      <span style="text-align: center;">İLETİŞİM <BR>TELEFON:0500 000 00 00 - MAIL: guvenotopark@gmail.com - ADRES: Selçuklu/Konya</BR></span>
    </div>
    
    <!--menü oluşturma bitiş-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    
  </body>
</html>
