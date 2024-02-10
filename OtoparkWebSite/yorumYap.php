<?php
session_start();
include("dbConnect.php");

if(isset($_SESSION['cnumber'])) { //oturumda cnumber değişkeni varsa
    if ($_SERVER["REQUEST_METHOD"] == "POST") { //kullanıcı form gönderdiyse
 
        $yorum = $_POST['yorum']; //form dan verileri al
        $cnumber = $_SESSION['cnumber']; //oturumdan cnumber'ı al
        
        // Kullanıcıyı sorgulayarak doğrulama yapıldı //form dan gelen  bilgiler doğru mu yani böyle bir müşteri var mı
        $sorgu = "SELECT * FROM musteriler WHERE cnumber = '$cnumber'";
        $sonuc = mysqli_query($baglanti, $sorgu);

        if(mysqli_num_rows($sonuc) > 0)
        {
            $yorumEkleSorgu = "INSERT INTO yorumlar (cnumber, yorum) VALUES ('$cnumber', '$yorum')";
            $yorumEkleSonuc = mysqli_query($baglanti, $yorumEkleSorgu);
    
            if ($yorumEkleSonuc) {
                echo '<div class="alert alert-success" role="alert">';
                echo "Yorumunuz başarıyla alındı! Teşekkür ederiz! <br> Kendi yorumunuzu ve daha fazla yorum görmek için aşağıda bulunan butonu kullanbilirsiniz.";
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">';
                echo "Yorum eklenirken bir hata oluştu.";
                echo '</div>';
            }
        }
        else
        {
            echo '<div class="alert alert-danger" role="alert">';
            echo "Hatalı bilgi girişi yaptınız. Lütfen bilgilerinizi kontrol edin.";
            echo '</div>';
        }
        }


    }
else {
    echo '<div class="alert alert-danger" role="alert">';
    echo "Bu sayfayı görüntüleme yetkiniz yoktur. <br> Yorum yapabilmek için lütfen giriş yapınız!";
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


    <form action="yorumYap.php" method="POST">
        <div>
            <header >
                <h2>Yorum Yap</h2>
            </header>
            <br />
            <div >

                <br>
                <textarea
                    class="form-input"
                    id="yorum"
                    name="yorum"
                    placeholder="Yorumunuz:"
                    required
                ></textarea>
                
                <br />
                <br>
                <button
                    class="log-in"
                    type="submit"
                    id="yorumyap"
                    value="yorumyap"
                    name="islem"
                >
                    Yorum yap
                </button>
                <br>
<br>
                <button
                    class="log-in"
                    type="submit"
                    id="yorumgoster"
                    value="yorumgoster"
                    name="yorumgoster"
                    onclick="yorumlaraGit()"
                >
                    Yorumları Göster
                </button>

            <br><br>
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
      document.getElementById("yorum").value = ""; 

    }

    function yorumlaraGit(){
        window.location.href = "yorumlar.php"; // yorumlar.php sayfasına yönlendirme

    }
  </script>
</body>
</html>
