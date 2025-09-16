<?php
//***********************************************************************************//
//****** Oturumu Açık Olan Kullanıcının Session Süresine Göre Oturumu Kapatır *******//
//***********************************************************************************//
session_start();

//****** Kullanıcı Giriş Yapmışsa *******//
if (!isset($_SESSION["UserID"])) {
    header("Location: SignIn.php");
    exit;
}

//****** Session Timeout Kontrolü *******//
if (isset($_SESSION["LastActivity"]) && (time() - $_SESSION["LastActivity"]) > $_SESSION["SessionTimeout"]) {
    session_unset();
    session_destroy();
    header("Location: SignIn.php?timeout=1");
    exit;
}

//****** Aktivite Zamanını Günceller *******//
$_SESSION["LastActivity"] = time();
?>