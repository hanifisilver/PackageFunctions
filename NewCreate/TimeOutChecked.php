<?php
session_start();

// Kullanıcı giriş yapmamışsa
if (!isset($_SESSION["UserID"])) {
    header("Location: SignIn.php");
    exit;
}

// Session timeout kontrol
if (isset($_SESSION["LastActivity"]) && (time() - $_SESSION["LastActivity"]) > $_SESSION["SessionTimeout"]) {
    session_unset();
    session_destroy();
    header("Location: SignIn.php?timeout=1");
    exit;
}

// Aktivite zamanını güncelle
$_SESSION["LastActivity"] = time();
?>