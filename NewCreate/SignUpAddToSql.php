<?php
session_start();
require "Connection.php";      // PDO bağlantısı
require "GlobalFunctions.php";  
require 'Logger.php';          // Loglama fonksiyonu

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $Name = trim($_POST["Name"]);
        $Surname = trim($_POST["Surname"]);
        $Mail = trim($_POST["Email"]);
        $Password = trim($_POST["Password"]);
        $PasswordAgain = trim($_POST["PasswordAgain"]);
        $UserName = ENFormatText($Name . $Surname, $pdo);

        $Type = 1;
        $Status = 1;
        $Gender = null;
        $Tel = null;
        $Forgotpassword = null;
        $PasswordUpdateDate = null;
        $CreateDateString = (new DateTime('now', new DateTimeZone('Europe/Istanbul')))->format('Y-m-d H:i:s');
        $UpdateDate = null;
        $HashValue = bin2hex(random_bytes(16));
        $IsActive = true;

        // Basit validasyon
        if (empty($Mail) || empty($Password) || empty($PasswordAgain)) {
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Lütfen Tüm Alanları Doldurun...'
            ];

        }

        if ($Password !== $PasswordAgain) {
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Lütfen Aynı Şifreyi Girdiğinizden Emin Olun...'
            ];
            exit;
        }

        // Şifreyi güvenli saklamak için hashle
        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(" INSERT INTO users (Type, Statüs, UserName, Name, Surname, Gender, Mail, Tel, Password, Forgotpassword, PasswordUpdateDate, CreateDate, UpdateDate, HashValue, IsActive) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $Type,
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
            $HashValue,
            $IsActive
        ]);

        // Başarılıysa SignIn sayfasına yönlendir
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Kayıt olma işlemleri başarıyla tamamladı.'
        ];
        header("Location: SignIn.php");
        exit;
    } else {
        $_SESSION['alert'] = [
            'type' => 'error',
            'message' => 'Kayıt olma işlemleri sırasında bri hata oluştu. Lütfen tekrar deneyin..'
        ];
    }
} catch (Exception $ex) {
    logError($pdo, $ex, "SIGNUP", "users", $_SESSION['user_id'] ?? null);
    header("Location: SignUp.php");
}