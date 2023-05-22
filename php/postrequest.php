<?php        
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    @include 'baglan.php';

    // Formdan veri almaca
    $ad = $_POST['name'];
    $soyad = $_POST['lname'];
    $telefon = $_POST['phone'];
    $eposta = $_POST['email'];
    $tc = $_POST['tckimlikno'];

    if(($ad !== null) && ($soyad !== null) && ($telefon !== null) && ($eposta !== null) && ($tc !== null)){
    // Veri ekleme sorgusu
    $sql = "INSERT INTO basvurular (ad, soyad, telefon, email, tcno) VALUES ('$ad', '$soyad', '$telefon', '$eposta', '$tc')";

    // Sorguyu çalıştır ve başarılı olup olmadığını kontrol et
    if ($mysqli->query($sql) === TRUE) {
        echo "<h5>Veri başarıyla eklendi<h5>";
        echo "<style>h5{color:green;}</style>";
        header("Location: ../success.html");
    } else {
        echo "Veri eklenirken hata oluştu: " . $mysqli->error;
    }

    $mysqli->close();

        }else{
            header("Location: ../basvuru.html");
            sleep(3);
            echo "<script>alert('Hata');</script>";
        }

   }
?>