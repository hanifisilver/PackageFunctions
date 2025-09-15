<?php
require "Connection.php";
require_once 'Logger.php';
session_start();

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        if (empty($email) || empty($password)) {
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Email ve şifre alanları boş olamaz.'
            ];
            header("Location: login.php");
            exit;
        }

        // Kullanıcıyı email ile bul
        $stmt = $pdo->prepare("SELECT * FROM users WHERE Mail = :email LIMIT 1");
        $stmt->execute([":email" => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["Password"])) {
            // Login başarılı → session oluştur
            $_SESSION["UserID"] = $user["UserID"];
            $_SESSION["UserName"] = $user["UserName"];
            $_SESSION["LastActivity"] = time(); // oturum başlangıç zamanı
            $_SESSION["SessionTimeout"] = 1800; // 30 dakika (saniye cinsinden)

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
            header("Location: login.php");
            exit;
        }
    }
} catch (Exception $ex) {
    logError($pdo, $ex, "LOGIN", "users", $_SESSION['UserID'] ?? null);
    $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Bir hata oluştu, log kaydedildi.'
    ];
    header("Location: login.php");
    exit;
}
?>
