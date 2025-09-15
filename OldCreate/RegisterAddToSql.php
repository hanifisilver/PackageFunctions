<?php
require "Connection.php";   // PDO bağlantısı
require_once 'Logger.php';  // Loglama fonksiyonu

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $UserName = trim($_POST["username"]);
        $Mail = trim($_POST["email"]);
        $Password = trim($_POST["password"]);

        $Status = 1;
        $Name = null;
        $Surname = null;
        $Gender = null;
        $Tel = null;
        $Forgotpassword = null;
        $PasswordUpdateDate = null;
        $CreateDateString = (new DateTime('now', new DateTimeZone('Europe/Istanbul')))->format('Y-m-d H:i:s');
        $UpdateDate = null;
        $IsActive = true;

        // Basit validasyon
        if (empty($UserName) || empty($Mail) || empty($Password)) {
            die("Lütfen tüm alanları doldurun.");
        }

        // Şifreyi güvenli saklamak için hashle
        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(" INSERT INTO users (Statüs, UserName, Name, Surname, Gender, Mail, Tel, Password, Forgotpassword, PasswordUpdateDate, CreateDate, UpdateDate, IsActive) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $Status,
            $UserName,
            $Name,
            $Surname,
            $Gender,
            $Mail,
            $Tel,
            $hashedPassword,
            $Forgotpassword,
            $PasswordUpdateDate,
            $CreateDateString,
            $UpdateDate,
            $IsActive
        ]);

        // Başarılıysa Login sayfasına yönlendir
        header("Location: Login.php");
        exit;
    }
} catch (Exception $ex) {
    logError($pdo, $ex, "INSERT", "users", $_SESSION['user_id'] ?? null);
    echo "Bir hata oluştu, log kaydedildi.";
}