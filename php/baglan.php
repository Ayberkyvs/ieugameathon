<?php
            error_reporting(0);
            $HOST='burayahostservisi';
            $USERNAME='burayakullanıcıadi';
            $PASSWORD='burayasifregelecek';
            $DATABASE='databaseismi';

            //GITHUB PUBLIC OLARAK YUKLENECEGI İÇİN GİZLENMİŞTİR
        
            $mysqli = mysqli_init();
            $mysqli->ssl_set(NULL, NULL, NULL, NULL, NULL);
            $mysqli->real_connect($HOST, $USERNAME, $PASSWORD, $DATABASE, 3306, null, MYSQLI_CLIENT_SSL);
        
            // Hata kontrolü yapın
            if ($mysqli->connect_error) {
                die("Bağlantı hatası: " . $mysqli->connect_error);
            }
?>