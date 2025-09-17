<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Language objesini global olarak hazırla
$lang = new Language();

// Dil değişimi kontrolü (tüm sayfalar için ortak)
if (isset($_GET['lang'])) {
    $lang->setLanguage($_GET['lang']);
    header("Location: " . strtok($_SERVER['REQUEST_URI'], '?')); 
    exit;
}