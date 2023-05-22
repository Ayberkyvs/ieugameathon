<?php
            if(isset($_POST['girisYap'])){
            session_start();
            include 'baglan.php';
            // Formdan gelen kullanıcı adı ve şifre bilgileri
            $username = $_POST['username'];
            $password = $_POST['password'];
            // Veritabanında kullanıcının olup olmadığını kontrol etmek için sorgu yaz
            $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
            $result = $mysqli->query($sql);

            if ($result->num_rows == 1) {
              
                // Kullanıcının giriş yapması başarılı, session'a kaydet
                $_SESSION["loggedin"] = true;
                $_SESSION['username'] = $username;
                
                // Yönlendirme yapabilirsiniz
                header('Location: panel.php');
                exit();
            } else {
                // Kullanıcı adı veya şifre hatalı
                $_SESSION["loggedin"] = false;
                echo '<div style="display: flex; justify-content: center; text-align: center; align-items: center; 
                color: white; background-color: black;"><h2 style="font-size: 14px;">Kullanıcı ve şifreyi kontrol edin.</h2></div>';
            }

            // Veritabanı bağlantısını kapat
            $_SESSION["loggedin"] = false;
            $mysqli->close();
          }
            ?>
            

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi | IEU Basvuru</title>
    <meta name="description" content="İzmir Ekonomi Üniversitesi etkinlik başvuru sayfası yönetim panelidir.">
    <meta name="keywords" content="izmir,ekonomi,basvuru,gamejam,üniversite,ieu">
    <link rel="icon" type="image/x-icon" href="../img/header/favicon.png">  
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
            crossorigin="anonymous"/>  
</head>
<body>
    <section class="vh-100" style="background: url(../img/svg/loginscreen.jpg) no-repeat center">
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5" style="align-items: center; display: flex; justify-content: center;">
              <img src="../img/svg/loginavatar.png" style="max-width: 80%; max-height: 80%;"
                class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- Email input -->
                <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3">Kullanıcı Adı</label>
                  <input type="text" id="form3Example3" class="form-control form-control-lg"
                    placeholder="Kullanıcı Adınızı Giriniz." name="username" required/>
                </div>
      
                <!-- Password input -->
                <div class="form-outline mb-3">
                <label class="form-label" for="form3Example4">Şifre</label>
                  <input type="password" id="form3Example4" class="form-control form-control-lg"
                    placeholder="Şifre Giriniz" name="password" required/>
                </div>
      
                <div class="d-flex justify-content-between align-items-center">
                  <!-- Checkbox -->
                  <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                    <label class="form-check-label" for="form2Example3">
                      Beni Hatırla
                    </label>
                  </div>
                  <a href="#!" class="text-body">Şifremi Unuttum</a>
                </div>
      
                <div class="text-center text-lg-start mt-4 pt-2">
                  <input name="girisYap" class="btn btn-primary btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem; border:1px solid #f76700 !important; 
                    background-color:#f76700 !important;" type="submit" value="Giriş Yap"></input>
                  <p style="color: white !important;" class="small fw-bold mt-2 pt-1 mb-0">Hesabınız yok mu ? <a href="https://www.ayberkyavas.com" target="_blank"
                      class="link-danger" style="color: white !important;">Kaydol</a></p>
                </div>
      
              </form>
            </div>
          </div>
        </div>
        <div
          class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary"
          style="background-color:#f76700 !important;">
          
          <!-- Copyright -->
          <div class="text-white mb-3 mb-md-0">
            Copyright © 2023. All rights reserved.
          </div>
          <!-- Copyright -->
          <!-- Right -->
          <div>
            <a href="#!" class="text-white me-4">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#!" class="text-white me-4">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#!" class="text-white me-4">
              <i class="fab fa-google"></i>
            </a>
            <a href="#!" class="text-white">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
          <!-- Right -->
        </div>
      </section>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>

<style>
.divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}
body{
    margin: 0px;
}
label{
  color: white !important;
}
</style>
