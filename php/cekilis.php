
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Çekiliş sonuçlarını bu sayfadan görüntüleyebiliriz." />
        <meta name="author" content="ayberk yavas"/>
        <title>Sonuçlar - IEU</title>
        <link rel="icon" type="image/x-icon" href="../img/header/favicon.png">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/panel.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
          <!--================ Loader Başlangıç =================-->

            <div id="loader">
            </div>
            <style>
            #loader{
                position: fixed;
                width: 100%;
                height: 100vh;
                background: #212529 url("../img/loader/loadingscreen.gif") no-repeat center;
                background-size: 300px;
                z-index: 999 !important;
                overflow: visible;
            }
            </style>
            <script>
            var preloader = document.getElementById('loader');
            function preLoaderHandler(){
                preloader.style.display = 'none';
            }


            var loader;

            function loadNow(opacity) {
                if (opacity <= 0) {
                    displayContent();
                } else {
                    loader.style.opacity = opacity;
                    window.setTimeout(function() {
                        loadNow(opacity - 0.05);
                    }, 30);
                }
            }

            function displayContent() {
                loader.style.display = 'none';
                document.getElementById('content').style.display = 'block';
            }

            document.addEventListener("DOMContentLoaded", function() {
                loader = document.getElementById('loader');
                loadNow(25);
            });

            </script>
            <!--================ Loader Bitiş =================-->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <div id="pcbox" class="navbar-brand ps-3">
            <img src="../img/logo/pcLogo2.png">
            </div>
            
            <style>
                #pcbox > img{
                    width: 100%;
                    height: 100%;
                    
                }
            </style>
            <!-- Sidebar Toggle-->
            
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Ayarlar</a></li>
                        <li><a class="dropdown-item" href="#!">Kayıtlar</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Çıkış Yap</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <br><br><br>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Gameathon</h1>
                        <br>
                        <div class="card mb-4">
                            <div class="card-body">
                                Verileri Göster: Tüm kayıtları gösterir, Verileri Gizle: kayıtları gizler. Sayı Gir: girdiğiniz değer kadar random kayıt çeker.
                                <a target="_blank" href="https://www.ayberkyavas.com">Developed by YAVAS</a>.
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body" id="buttons">
                            Yeniden mi denemek istiyorsun ? <a href="panel.php">Çekiliş Ekranına Dön.</a>
                        </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Çekiliş Sonuçları
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Ad</th>
                                            <th>Soyad</th>
                                            <th>Telefon</th>
                                            <th>Email</th>
                                            <th>TC Kimlik</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Ad</th>
                                            <th>Soyad</th>
                                            <th>Telefon</th>
                                            <th>Email</th>
                                            <th>TC Kimlik</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    if (isset($_POST['cekilis'])) {
                                    include 'baglan.php';
                                    
                                    $limit = $_POST['cekilis']; // inputtan girilen sayıyı al
                                    if($limit <= 0){
                                        echo '<style>#loader{display:none;}</style>';
                                        echo '<h3 style="color:red;">' . 'Hata Mesajı !' . '</h3>';
                                        echo '<h4>Lütfen geçerli bir veri giriniz.</h4>';
                                        echo '<style>' . 'tr{display:none;}' . '</style>';                        
                                        die();
                                    }
                                    echo '<h4>' . 'Tebrikler!' . '</h4>';
                                    echo '<h6>'. 'Aşağıdaki '. $limit . ' kişi kazandı 🎉' . '</h6>';
                                    echo '<br>';
                                    

                                    // MySQL veritabanından verileri rastgele olarak çekme
                                    $sql = "SELECT * FROM basvurular ORDER BY RAND() LIMIT $limit";
                                    $result = $mysqli->query($sql);
                                    
                                    // Verileri tablo içine yerleştirme
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id"] . "</td>";
                                            echo "<td>" . $row["ad"] . "</td>";
                                            echo "<td>" . $row["soyad"] . "</td>";
                                            echo "<td>KVKK Koruması</td>";
                                            echo "<td>KVKK Koruması</td>";
                                            echo "<td>KVKK Koruması</td>";
                                            echo "</tr>";

                                            // KAZANANI TABLODAN SİLME
                                            $id = $row["id"];
                                            $ad = $row["ad"];
                                            $soyad = $row["soyad"];
                                            $telefon = $row["telefon"];
                                            $eposta = $row["email"];
                                            $tc = $row["tcno"];

                                            // KAZANANLAR LİSTESİNE EKLEME
                                            $sql = "INSERT INTO kazananlar (ad, soyad, telefon, email, tcno) VALUES ('$ad', '$soyad', '$telefon', '$eposta', '$tc')";
                                            // Sorguyu çalıştır ve başarılı olup olmadığını kontrol et
                                            if ($mysqli->query($sql) === TRUE) {
                                                echo "<h6>Kazananlar Listesine Başarıyla Kaydedildi.<h6>";
                                                echo "<style>h5{color:green;}</style>";
                                            } else {
                                                echo "Veri eklenirken hata oluştu: " . $mysqli->error;
                                            }

                                            $deleteSql = "DELETE FROM basvurular WHERE id = $id";
                                            $deleteResult = $mysqli->query($deleteSql);
                                            if (!$deleteResult) {
                                                echo "Veri silme hatası: " . $mysqli->error;
                                            }
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>Veri bulunamadı.</td></tr>";
                                    }
                                    
                                    // MySQL bağlantısını kapatma
                                    $mysqli->close();
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; IEU Başvuru</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>
