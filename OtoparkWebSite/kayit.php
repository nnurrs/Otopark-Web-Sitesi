<?php 
include("dbConnect.php");


//kaydetme işlemleri
//ilk önce kaydet butonuna basıldı mı bakcaz
//isset burda form un kaydet isimli bir input u var mı bakar
//butona basıldıysa $_POST["kaydet"] kısmı tanımlı olur ve isset true döner
if(isset($_POST["kaydet"])) //butona basıldıysa kaydetsin
{

  $Name=$_POST["ad"];
  $Surname=$_POST["soyad"];
  $Phone=$_POST["tel"];
  $plate=$_POST["plaka"];
  $parkAlan=$_POST["parkAlan"]; //değişkenler formdaki name leri yardımı ile alınıp tutuluyor


  $ekle="INSERT INTO musteriler (name,surname,phone,lplate,parkAlan) VALUES ('$Name','$Surname','$Phone','$plate','$parkAlan')";
  //ilk parantezler tablodaki sütun isimleri 2. parantez içindekiler yukarda tutulan değişkenlerden gelir
  $calistirekle = mysqli_query($baglanti, $ekle); 


  if($calistirekle) 
  {
    echo '<div class="alert alert-success" role="alert">
    Kayıt işlemi başarılı! Güven Otopark a hoş geldiniz!
    </div>';

    //son eklenen cnumber ı alalım
    $cnumbersorgu= "SELECT LAST_INSERT_ID() as cnumber";
    $sonuc=mysqli_query($baglanti,$cnumbersorgu);

    //cnumber ı alalım
    if($sonuc && mysqli_num_rows($sonuc) > 0) //$sorgu değişkeni boş değilse ve içinde en az 1 satır varsa
    {
      $satir=mysqli_fetch_assoc($sonuc); //veriyi kullanabilmek için bu fonk. u kullandık.
      $cnumber = $satir['cnumber']; //satir in içindeki diziden cnumber sütununu alır ve atar

      echo '<div class="alert alert-warning" role="alert">';
      echo "Müşteri numaranız: " . $cnumber; // $cnumber değerini ekrana yazdırdık
      echo '</div>';

      $ekleG ="INSERT INTO giris (cnumber,name, surname,phone) VALUES ('$cnumber','$Name','$Surname','$Phone')";
      $calistirekleG= mysqli_query($baglanti,$ekleG);


     if(!$calistirekleG)
      {
        echo "giriş tablosuna yazarken bir sorun oluştu!";
      }
    
    }
    else
    {
      echo "Müşteri numarası alınırken bir hata oluştu!";
    }
        // JavaScript ile bekletme ve yönlendirme işlemleri
        echo '<script>
        setTimeout(function() {
            window.location.href = "anaSayfa.php"; 
        }, 4000); 
    </script>';

    mysqli_close($baglanti);
  }
  else
  {
    echo '<div class="alert alert-danger" role="alert">
    Kayıt işlemi başarısız! <br> Dolu bir park alanı girmeye çalışıyor olabilirsiniz, lütfen kontrol edip tekrar deneyiniz.
    </div>';
  }

  mysqli_close($baglanti);

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kayıt Sayfası</title>

    <link rel="stylesheet" type="text/css" href="kayit.css" />
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

          <li><a class="aktifk"  href="kayit.php">
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
      <div>
      <div class="bilgi" id="bilgi">Kayıt Ekranına Hoş geldiniz!</div>

      <form action="kayit.php" method="POST">
       
          <header>
            <h2>Kayıt Ol</h2>
            <p>Kayıt olmak için bilgilerinizi girin.</p>
          </header>
          <br />
          <div>

            <!--   isim Input-->
            <input
              class="form-input"
              id="name"
              type="text"
              name="ad"
              placeholder="Ad"
              required
            />

            <br />
            <!-- soyisim input-->
            <input
              class="form-input"
              id="surname"
              type="text"
              name="soyad"
              placeholder="Soyad"
              required
            />

            <br />

            <!-- telefon no input-->
            <input
              class="form-input"
              id="phone"
              type="text "
              name="tel"
              placeholder="Telefon"
              required  
              
            />
            <!--required->input boş gönderilemesin-->
            
            <br />

            <!-- plaka input-->
            <input
              class="form-input"
              id="lplate"
              type="text"
              name="plaka"
              placeholder="Plaka"
              required
            />
            <br>
            <br>
            <!-- park alanı input-->
            <select class="form-select" aria-label="Default select example" id="parkAlan"name="parkAlan" placeholder="Park Alanı">
  <option selected>Park Alanı Seçiniz: </option>
  <option value="A1">A1</option>
  <option value="A2">A2</option>
  <option value="A3">A3</option>
  <option value="A4">A4</option>
  <option value="A5">A5</option>
  <option value="A6">A6</option>
  <option value="A7">A7</option>
  <option value="A8">A8</option>
  <option value="A9">A9</option>
  <option value="B1">B1</option>
  <option value="B2">B2</option>
  <option value="B3">B3</option>
  <option value="B4">B4</option>
  <option value="B5">B5</option>
  <option value="B6">B6</option>
  <option value="B7">B7</option>
  <option value="B8">B8</option>
  <option value="B9">B9</option>
  <option value="C1">C1</option>
  <option value="C2">C2</option>
  <option value="C3">C3</option>
  <option value="C4">C4</option>
  <option value="C5">C5</option>
  <option value="C6">C6</option>
  <option value="C7">C7</option>
  <option value="C8">C8</option>
  <option value="C9">C9</option>
  <option value="D1">D1</option>
  <option value="D2">D2</option>
  <option value="D3">D3</option>
  <option value="D4">D4</option>
  <option value="D5">D5</option>
  <option value="D6">D6</option>
  <option value="D7">D7</option>
  <option value="D8">D8</option>
  <option value="D9">D9</option>
  
  
</select>
            <br>
            <br />
            <!-- kaydet butonu -->
            <button
              class="log-in"
              type="submit"
              value="register"
              name="kaydet"
            >
              Kayıt Ol
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

        
      </form>

      </div>
    </div>
    <script>
    function clearForm() {
      // Formu temizleyen fonksiyon
      document.getElementById("name").value = ""; 
      document.getElementById("surname").value = ""; 
      document.getElementById("phone").value = ""; 
      document.getElementById("lplate").value = ""; 
      document.getElementById("parkAlan").value = "Park Alanı Seçiniz:";

    }
  </script>
  </body>
</html>

