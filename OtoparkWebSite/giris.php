<?php 
include("dbConnect.php");



 //ilk önce kaydet butonuna basıldı mı bakcaz

 if(isset($_POST["giris"])) //butona basıldıysa kaydetsin
 {

  $cnumber=$_POST["MNo"];

      // Çıkış tablosunda kaydı kontrol et
      $cikisSorgu = "SELECT * FROM cikis WHERE cnumber='$cnumber'";
      $cikisCalistir = mysqli_query($baglanti, $cikisSorgu);
      $cikisSayisi = mysqli_num_rows($cikisCalistir);

      if($cikisSayisi >0)
      {
        echo '<div class="alert alert-danger" role="alert">
        Bu müşteri çıkış yapmış! Giriş yapabilmek için yeni bir kayıt oluşturmalısınız.
        </div>';
      }
      else
      {
        $secim="SELECT * FROM giris where cnumber='$cnumber'";
        $calistir=mysqli_query($baglanti,$secim);
    
        $kayitSayisi=mysqli_num_rows($calistir); //ya 0 ya 1 dir (1 se kayıt var 0 sa yok kayıt demek)
    
        if($kayitSayisi>0)
        {
            $ilgilikayit=mysqli_fetch_assoc($calistir); //sorgudan dönen veriler alınır
            session_start(); //oturumu açtık 
    
            $_SESSION["cnumber"]=$ilgilikayit["cnumber"];
            //oturum değişkenleri veri tabanından gelen bilgileri saklar
    
            header("location:yorumlar.php");
            
        }
        else
        {
          echo '<div class="alert alert-danger" role="alert">
          Müşteri kaydı bulunamadı! <br> Bu sayfaya erişebilmek için önce otoparka kayıt olmanız gerekmektedir!
          </div>';
        }
      }


    mysqli_close($baglanti);

 }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" type="text/css" href="giris.css" />
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

          <li><a class="aktifb"  href="giris.php">
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

    <div>
        
        <div class="bilgi" id="bilgi">Giriş Ekranına Hoş geldiniz!</div>
        <form action="giris.php" method="POST" >

          <header>
            <h2>Giriş Yap</h2>
            <p>Giriş yapmak için bilgilerinizi girin.</p>
          </header>
          <br />

          <div >

            <!--   müşteri no Input-->
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
              name="giris"
            >
              Giriş Yap
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
        
    </div>
    <script>
    function clearForm() {
      // Formu temizleyen fonksiyon
      document.getElementById("MNo").value = ""; // Müşteri numarası alanını temizler
    }
  </script>
  </body>
</html>
