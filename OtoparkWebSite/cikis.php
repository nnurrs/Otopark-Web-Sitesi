<?php 

include("dbConnect.php");
session_start();

if(isset($_POST["cikis"]) && !isset($_SESSION['cikis_yapildi'])) { 
    //form dan cikis değeri geldi mi ve cikis_yapildi değişkeni tanımlanmamışsa
    $_SESSION['cikis_yapildi'] = true; //çıkış yapıldı

    $cnumber = $_POST["MNo"];


    // Kullanıcıyı sorgulayarak doğrulama yapıldı //form dan gelen  bilgiler doğru mu yani böyle bir müşteri var mı
    $sorgu = "SELECT * FROM musteriler WHERE cnumber = '$cnumber'";
    $sonuc = mysqli_query($baglanti, $sorgu);

    if (mysqli_num_rows($sonuc) > 0) {
      // Kullanıcıya ait bir çıkış kaydı var mı kontrol edildi
      $cikisKontrol = "SELECT * FROM cikis WHERE cnumber = '$cnumber'";
      $cikisSonuc = mysqli_query($baglanti, $cikisKontrol);

      if (mysqli_num_rows($cikisSonuc) == 0){
      // Çıkış zamanını veritabanına kaydet
       $kaydet = "INSERT INTO cikis (cnumber, cotime) VALUES ('$cnumber', CURRENT_TIMESTAMP)";
       $sonuc = mysqli_query($baglanti, $kaydet);

      //giris zamanı aldık
      $girisSorgu = "SELECT citime FROM giris WHERE cnumber = '$cnumber'";
      $girisCalistir = mysqli_query($baglanti, $girisSorgu);
      $girisBilgi = mysqli_fetch_assoc($girisCalistir); //sorgudan dönen bilgileri dizi olarak alır
      $girisZamani = $girisBilgi['citime'];
      //cikis zamanı aldık
      $cikisSorgu = "SELECT cotime FROM cikis WHERE cnumber = '$cnumber'";
      $cikisCalistir = mysqli_query($baglanti, $cikisSorgu);
      $cikisBilgi = mysqli_fetch_assoc($cikisCalistir);
      $cikisZamani = $cikisBilgi['cotime'];


      $tarih1 = new DateTime($girisZamani);
      $tarih2 = new DateTime($cikisZamani); //tarih ve saat bilgilerini içeren yeni nesneler oluşturulur

      $fark = $tarih1->diff($tarih2); //datetime nesnleri arasındaki farkı hesaplamak için diff kullanılır
      $dakikaFarki = $fark->days * 24 * 60 + $fark->h * 60 + $fark->i; //fark dk cinsiye dönştürüldü
      // dakika başı ücret üzerinden borç hesaplandı (1 TL/dakika)
      $borc = $dakikaFarki * 1;

      //borc u veri tabanına yazdırma

      $borcEkle= "UPDATE cikis SET borc = '$borc' where cnumber='$cnumber'";
      $borcSonuc=mysqli_query($baglanti,$borcEkle);

      echo '<div class="alert alert-info" role="alert">';
      echo "Borcunuz: " . $borc. " TL. <br> Lütfen girişten ödemenizi yapınız!";
      echo '</div>';

      echo '<div class="alert alert-success" role="alert">';
      echo "Başarı ile otoparktan çıkış yapıldı. <br>Otoparkımıza yine bekleriz. Güle Güle!";
      echo '</div>';

      }
      else
      {
        echo '<div class="alert alert-danger" role="alert">';
        echo "Girilen bilgilere sahip olan araç zaten otoparktan çıkış yapmış. Lütfen tekrar deneyin.";
        echo '</div>';
      }
      
    }
    else
    {
      echo '<div class="alert alert-danger" role="alert">';
      echo "Hatalı giriş yaptınız. Lütfen bilgilerinizi kontrol edin.";
      echo '</div>';
    }
        
  mysqli_close($baglanti);
    
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Çıkış Sayfası</title>
    <link rel="stylesheet" type="text/css" href="cikis.css" />
    <link rel="stylesheet" type="text/css" href="anaSayfa.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  </head>
  <body>

  <nav class="navbar ">
      <div class="body">
        <div  style="position: sticky; top: 30; background-color: #ccc; left: 0; right: 0; width:680% ;height: 80px; display: flex; justify-content: flex-start; align-items: center;"> 
          <br>
          <ul class="menu" style="margin-top:20px"> 
          <li><a href="anaSayfa.php">
          <img src="home.png" alt="saydam Fotoğrafı" style="width: 50px; height: 40px; margin-right: 5px;"> 
          Ana Sayfa</a></li>

          <li><a  href="giris.php">
          <img src="giris.png" alt="saydam Fotoğrafı" style="width: 50px; height: 40px; margin-right: 5px;"> 
          Giriş Yap</a></li>

          <li><a href="kayit.php">
          <img src="kayit.png" alt="saydam Fotoğrafı" style="width: 50px; height: 40px; margin-right: 5px;">   
          Kayıt Ol</a></li>
          <li><a class="aktifc" href="cikis.php">
          <img src="cikis.png" alt="saydam Fotoğrafı" style="width: 50px; height: 40px; margin-right: 5px;"> 
          Otoparktan Çıkış Yap</a></li>

        </ul>
        </div>
      </div>
      </nav>


    <div>
        <div class="bilgi" id="bilgi">Otoparktan Çıkış Ekranına Hoş geldiniz!</div>

        <form action="cikis.php" method="POST">
          <header class="head-form">
            <h2>Çıkış Yap</h2>
            <p>Otoparktan çıkış yapmak için bilgilerinizi girin.</p>
          </header>
          <br />

          <div>

            <!--   mno Input-->
            <input
              class="form-input"
              id="MNo"
              type="text"
              name="MNo"
              placeholder="Müşteri Numarası"
              required
            />

            <br />
            <br />
            
            <!-- button LogIn -->
            <button
              class="log-in"
              type="submit"
              value="logIn"
              name="cikis"            >
              Çıkış Yap
            </button>

            <br> <br>
            <!-- Temizle butonu -->
            <button
             class="log-in"
             type="button"
             onclick="clearForm()">
             Temizle
           </button>
          </div>
        </div>

        </form>
        <script>
    function clearForm() {
      // Formu temizleyen fonksiyon
      document.getElementById("MNo").value = ""; // Müşteri numarası alanını temizler
    }
  </script>
  </body>
</html>


<?php

$_SESSION=array(); //session içi boşalttık
session_destroy(); //oturumu tamamen sonlandırdık
?>