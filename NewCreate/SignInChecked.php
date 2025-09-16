<?php

//**********************************************************//
//****** Kullanıcının Oturum(Login) Açmasını SAağlar *******//
//**********************************************************//
session_start();
require "Connection.php";
require 'Logger.php';

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = trim($_POST["email"]);       // Kullanıcıdan Alınan E-Mail Input Değeri
        $password = trim($_POST["password"]); // Kullanıcıdan Alınan Şifre Input Değeri

        //****** İnput Değerlerinin Boş Olup Olmadığını Kontrol Eder *******//
        if (empty($email) || empty($password)) {
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Email ve şifre alanları boş olamaz.'
            ];
            header("Location: SignIn.php");
            exit;
        }

        //****** Kullanıcıyı E-mail Adresinden Bul *******//
        $stmt = $pdo->prepare("SELECT * FROM users WHERE Mail = :email LIMIT 1");
        $stmt->execute([":email" => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //****** Oturum Açma Başarılı İse Sessions Oluşturur *******//
        if ($user && password_verify($password, $user["Password"])) {
            $_SESSION["UserID"] = $user["UserID"];     // UserId
            $_SESSION["UserName"] = $user["UserName"]; // UserName
            $_SESSION["Type"] = $user["Type"];         // Type = Kulanıcının SüperUser Olup Olmadığını Anlamk İçin
            $_SESSION["LastActivity"] = time();        // Oturum Başlangıç Zamanı
            $_SESSION["SessionTimeout"] = 1800;        // Oturumun Açık Kalma Süresi(saniye)

            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Giriş başarılı! Hoş geldiniz ' . htmlspecialchars($user["Name"])
            ];
            header("Location: ./index.php");
            exit;
        } else {
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Geçersiz email veya şifre.'
            ];
            header("Location: SignIn.php");
            exit;
        }
    }
} catch (Exception $ex) {
    logError($pdo, $ex, "SIGNIN", "users", $_SESSION['UserID'] ?? null);
    $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Bir hata oluştu, log kaydedildi.'
    ];
    header("Location: SignIn.php");
    exit;
}
?>
