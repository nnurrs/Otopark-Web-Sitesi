<?php 
include("dbConnect.php");
session_start();

echo '
<nav class="navbar ">
    <div class="body">
      <div  style="position: sticky; top: 30; background-color: #ccc; left: 0; right: 0; width:680% ;height: 80px; display: flex; justify-content: flex-start; align-items: center;"> 
        <br>

        <ul class="menu" style="margin-top:20px"> 
          <li><a href="anaSayfa.php">
          <img src="home.png" alt="saydam Fotoğrafı" style="width: 50px; height: 40px; margin-right: 5px;"> 
          Ana Sayfa</a></li>

          <li><a class="aktifk"  href="giris.php">
          <img src="giris.png" alt="saydam Fotoğrafı" style="width: 50px; height: 40px; margin-right: 5px;"> 
          Giriş Yap</a></li>

          <li><a href="kayit.php">
          <img src="kayit.png" alt="saydam Fotoğrafı" style="width: 50px; height: 40px; margin-right: 5px;">   
          Kayıt Ol</a></li>
          <li><a href="cikis.php">
          <img src="cikis.png" alt="saydam Fotoğrafı" style="width: 50px; height: 40px; margin-right: 5px;"> 
          Otoparktan Çıkış Yap</a></li>

        </ul>
      </div>
    </div>
    </nav>
';

if(isset($_SESSION['cnumber'])) // müşteri no veri tabanında varsa 
{
  $cnumber = $_SESSION['cnumber'];
  $musteriSorgusu = "SELECT name, surname FROM musteriler WHERE cnumber = '$cnumber'";
  $musteriSonuc = mysqli_query($baglanti, $musteriSorgusu);
  
  if ($musteriSonuc && mysqli_num_rows($musteriSonuc) > 0) {
      $musteriBilgisi = mysqli_fetch_assoc($musteriSonuc);
      echo '<div class="alert alert-success" role="alert">';
      echo "Hoş geldin!  " . $musteriBilgisi['name']." ".$musteriBilgisi['surname'];
      echo '</div>';
  }

    // Giriş zamanını almak için SELECT sorgusu
    $cnumber = $_SESSION['cnumber']; // Müşteri numarasını aldık
    $girisZamaniSorgu = "SELECT citime FROM giris WHERE cnumber = '$cnumber'";
    $girisZamaniSonuc = mysqli_query($baglanti, $girisZamaniSorgu);

    if ($girisZamaniSonuc && mysqli_num_rows($girisZamaniSonuc) > 0) {
      //sorgu çalıştıysa ve en az bir sonuç döndüyse
        $girisZamaniSatir = mysqli_fetch_assoc($girisZamaniSonuc);
        $girisZamani = $girisZamaniSatir['citime'];

        echo '<div class="alert alert-info" role="alert">';
        echo "Otoparka giriş zamanınız: " . $girisZamani ;
        echo '</div>';
    } else {
        echo "Giriş zamanı alınamadı";
    }

    if (isset($_POST['islem']) && $_POST['islem'] === 'yorumlar') {
        // Yorumları gösterme işlemi burada yapılacak
        //islem değişkeni değeri yorumlar ise
        $yorumlarSorgu = "SELECT yorum,cnumber FROM yorumlar";
        $yorumlarSonuc = mysqli_query($baglanti, $yorumlarSorgu);

        if ($yorumlarSonuc && mysqli_num_rows($yorumlarSonuc) > 0) {
            echo '<div class="yorumlar">';
            echo '<div class="alert alert-dark" role="alert" style="font-size:22px"> <b><u>Otoparkımızı kullanan müşterilerimizin yorumları:</b></u> </div>';

            while ($row = mysqli_fetch_assoc($yorumlarSonuc)) {
              //her döngüde bir yprum satırı alınır
              $cnumber = $row['cnumber'];

        $musteriSorgusu = "SELECT name, surname FROM musteriler WHERE cnumber = '$cnumber'";
        $musteriSonuc = mysqli_query($baglanti, $musteriSorgusu);
        $musteriBilgisi = mysqli_fetch_assoc($musteriSonuc);

        echo '<div class="alert alert-info" role="alert">';
        echo "<p> <b>Ad:</b> " . $musteriBilgisi['name'] . "<b> Soyad: </b>" . $musteriBilgisi['surname'] ."<br>". "<b> Yorum: </b>" . $row['yorum'] . "</p>";
        echo '</div>';
              
            }
            echo '</div>';
        } else {
            echo "Henüz yorum yok.";
        }
    }

    if (isset($_POST['islem']) && $_POST['islem'] === 'cikis') {
        header("Location: cikis.php"); // Çıkış sayfasına yönlendirme
        exit();
    }

} else {
    echo '<div class="alert alert-danger" role="alert">';
    echo "Bu sayfayı görüntüleme yetkiniz yoktur. <br> Yorumları görebilmek için lütfen kayıt olup ardından giriş yapınız!";
    echo '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yorumlar</title>
    <link rel="stylesheet" type="text/css" href="anaSayfa.css" />
    <link rel="stylesheet" type="text/css" href="yorumlar.css" />


</head>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<script>
  function yorumYap()
  {
    window.location.href="yorumYap.php";
  }
</script>

    <button
    class="log-in"
    type="submit"
    onclick="yorumYap()"> 
    Yorum yapmak için tıklayınız.
    </button>
  <form action="yorumlar.php" method="POST" >

    <h2 class="h2renk" >Yorum yapmak <br>istemiyor musunuz?</h2><br><br>

    <div class="form-check" style="color:white;">
    <input type="radio" class="form-check-input"  name="islem" value="yorumlar" />
    <label class="form-check-label" for="yorum">Yorumları Göster</label>
    </div>
    <br><br>

    <div class="form-check " style="color:white;">
    <input type="radio" class="form-check-input"  name="islem" value="cikis" />
    <label class="form-check-label" for="cikis">Çıkış yap</label>

    </div>
    
    <br> <br> <br>
    <button type="submit" class="secButon" >Seç</button>

  </form>
</body>
</html>
