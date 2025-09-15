<?php
// db.php

$host = "localhost";        // genelde localhost
$dbname = "CRMTT";          // phpMyAdmin'de oluşturduğun veritabanı adı
$username = "root";         // varsayılan kullanıcı
$password = "";             // XAMPP/MAMP/WAMP kullanıyorsan şifre genelde boş olur

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // PDO hata yakalama ayarı
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Verileri dizi halinde almayı kolaylaştırır
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Veritabanına bağlanılamadı: " . $e->getMessage());
}