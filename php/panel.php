<?php
    session_start();
    $username = $_SESSION["username"];
    // 'loggedin' oturum değişkenini kontrol et
    if ($_SESSION["loggedin"] !== true) {
        // 'loggedin' false ise admin.php sayfasına yönlendir
        header('Location: admin.php');
        exit();
    }
    session_abort();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Yönetim için admin panelidir. Database verilerini görüntüleyebiliriz." />
        <meta name="author" content="ayberk yavas"/>
        <title>Tablolar - IEU Yönetim Paneli</title>
        <link rel="icon" type="image/x-icon" href="../img/header/favicon.png">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/panel.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <div id="pcbox" class="navbar-brand ps-3">
            <img src="../img/logo/pcLogo2.png">
            </div>
            
            <style>
                #pcbox > img{
                    width: 100%;
                    height: 100%;
                    margin-left: -10px;
                }
            </style>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
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
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Tablolar</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                İstatistik
                            </a>
                            <a class="nav-link" href="panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Başvuranlar
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Hoşgeldiniz:</div>
                        <?php echo $username?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Gameathon</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Verileri Göster: Tüm kayıtları gösterir, Verileri Gizle: kayıtları gizler. Sayı Gir: girdiğiniz değer kadar random kayıt çeker.
                                <a target="_blank" href="https://www.ayberkyavas.com">Developed by YAVAS</a>.
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body" id="buttons">
                            <form method="POST">
                                <select class="veriButton" id="showContactInfo" name="showContactInfo" required>
                                    <option value="true">Evet</option>
                                    <option value="false">Hayır</option>
                                </select>
                                <input class="veriButton" type="submit" name="veri_cek" value="Verileri Göster" style="border:1; background-color:#008800; color:white; padding: 5px;">
                                <input class="veriButton" type="submit" value="Verileri Gizle" style="border:1; background-color:#a20000; color:white; padding: 5px;" action="panel.php">
                            </form>
                            <form method="POST" action="cekilis.php">
                            <input class="veriButton" type="number" placeholder="Sayı Gir" value="Random" name="cekilis" 
                                style="border:1; background-color:white; color:black; padding: 5px;">
                            </form>
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var selectElement = document.getElementById('showContactInfo');
                                var selectedValue = '<?php echo isset($_POST['showContactInfo']) ? $_POST['showContactInfo'] : 'true'; ?>';
                                selectElement.value = selectedValue;
                            });
                            document.addEventListener('DOMContentLoaded', function() {
                            var selectElement = document.getElementById('showContactInfo');

                            function updateSelectClass() {
                                var selectedValue = selectElement.value;
                                if (selectedValue === 'true') {
                                    selectElement.classList.remove('red-border');
                                    selectElement.classList.add('green-border');
                                } else {
                                    selectElement.classList.remove('green-border');
                                    selectElement.classList.add('red-border');
                                }
                            }

                            // İlk yüklemede sınıfı güncelle
                            updateSelectClass();

                            // Seçenek değiştiğinde sınıfı güncelle
                            selectElement.addEventListener('change', updateSelectClass);

                            });
                            </script>
                            <style>
                                #buttons{
                                    display:flex;
                                    justify-content: space-between;
                                }
                                form{
                                    width: auto;
                                    height:auto;
                                    float:left;
                                }
                                .veriButton{
                                    max-width:100px;
                                    border-radius:5px;
                                }
                                .veriButton[type="submit"]{
                                    font-size:14px;
                                }
                                .veriButton[type="number"]{
                                    font-size:14px;
                                }
                                .veriButton::placeholder{
                                    color:black;
                                    font-size:14px;
                                }
                                select{
                                    font-size:14px;
                                    height:100%;
                                }
                                .green-border {
                                    border: 2px solid green;
                                }

                                .red-border {
                                    border: 2px solid red;
                                }
                            </style>
                        </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                IEU Gameathon
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
                                    if (isset($_POST['veri_cek'])) {
                                        include 'baglan.php';
                                         // MySQL veritabanından verileri çekme
                                        $sql = "SELECT * FROM basvurular";
                                        $result = $mysqli->query($sql);
                                        if (isset($_POST['showContactInfo']) && $_POST['showContactInfo'] == 'false') {
                                        // Verileri tablo içine yerleştirme
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["id"] . "</td>";
                                                echo "<td>" . $row["ad"] . "</td>";
                                                echo "<td>" . $row["soyad"] . "</td>";
                                                echo "<td>" . $row["telefon"] . "</td>";
                                                echo "<td>" . $row["email"] . "</td>";
                                                echo "<td>" . $row["tcno"] . "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>Veri bulunamadı.</td></tr>";
                                        }
                                    }else
                                    {
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["id"] . "</td>";
                                                echo "<td>" . $row["ad"] . "</td>";
                                                echo "<td>" . $row["soyad"] . "</td>";
                                                echo "<td>KVKK Koruması </td>";
                                                echo "<td>KVKK Koruması</td>";
                                                echo "<td>KVKK Koruması</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4'>Veri bulunamadı.</td></tr>";
                                        }
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
                            <div class="text-muted">Copyright &copy; İzmir Ekonomi Üniversitesi</div>
                            <div>
                                <a href="#">Gizlilik</a>
                                &middot;
                                <a href="#">Kullanım Şartları</a>
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
