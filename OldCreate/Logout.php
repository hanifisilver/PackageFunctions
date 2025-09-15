<?php
// logout.php
session_start();

// Tüm session değişkenlerini temizle
$_SESSION = [];

// Eğer cookie kullanılıyorsa onu da geçersiz kıl
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

// Session tamamen kapat
session_destroy();

// Kullanıcıyı login sayfasına yönlendir
header("Location: login.php");
exit;
