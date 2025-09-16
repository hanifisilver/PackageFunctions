<?php
//*****************************************************//
//****** Kullanıcının Oturumunu(Logout) Kapatır *******//
//*****************************************************//
session_start();

//****** Açık Olan Tüm Session'ları Temizler *******//
$_SESSION = [];

//****** Eğer Cookie Kulanıyorsa geçersiz Kıl *******//
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000, // geçmişe al
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

//****** Session Tamemen Kapat *******//
session_destroy();

//****** Kullanıcıyı GGiriş Sayfasına Yönlendir *******//
header("Location: SignIn.php");
exit;
