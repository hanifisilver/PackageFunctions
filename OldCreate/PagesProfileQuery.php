<?php
session_start();
require "Connection.php";   // PDO bağlantısı
require_once 'Logger.php';  // Logger fonksiyonu
$userID = $_SESSION['UserID'] ?? null;

if (!$userID) {
    die("Yetkisiz erişim.");
}

$formType = $_POST['formType'] ?? '';

//****** Users Tablosunu Günceller *******//
try {
    if ($formType === 'infoUpdate') {
        $stmt = $pdo->prepare("UPDATE users SET Name=:Name, Surname=:Surname, Gender=:Gender, Mail=:Mail, Tel=:Tel, UpdateDate=NOW() WHERE UserID=:uid");
        $result = $stmt->execute([
            ':Name' => $_POST['firstName'],
            ':Surname' => $_POST['lastName'],
            ':Gender' => $_POST['gender'],
            ':Mail' => $_POST['email'],
            ':Tel' => $_POST['phone'],
            ':uid' => $userID
        ]);

        if ($result) {
            // Başarılı ise
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Kayıt başarıyla güncellendi! ' . htmlspecialchars($_POST['firstName'])
            ];
            header("Location: PagesProfile.php");
            exit;
        } else {
            // Başarısız ise
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Kayıt Güncellenirken Bir Sorun Oluştu.'
            ];
            header("Location: PagesProfile.php");
            exit;
        }
    }

} catch (Exception $ex) {
    logError($pdo, $ex, "Update", "Users", $_SESSION['user_id'] ?? null);
    echo "Bir hata oluştu, log kaydedildi.";
}

//****** Şifreyi Günceller *******//
try {
    if ($formType === 'password2Update') {
        // Şifre güncelle
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];

        if ($password !== $passwordConfirm) {
            header("Location: PagesProfile.php?error=passwordMismatch");
            exit;
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET Password=:pwd, PasswordUpdateDate=NOW() WHERE UserID=:uid");
        $stmt->execute([
            ':pwd' => $hashed,
            ':uid' => $userID
        ]);
        if ($hashed) {
            // Başarılı ise
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Kayıt başarıyla güncellendi! ' . htmlspecialchars($_POST['firstName'])
            ];
            header("Location: PagesProfile.php");
            exit;
        } else {
            // Başarısız ise
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Kayıt Güncellenirken Bir Sorun Oluştu.'
            ];
            header("Location: PagesProfile.php");
            exit;
        }
    }

} catch (Exception $ex) {
    logError($pdo, $ex, "Update", "Users", $_SESSION['user_id'] ?? null);
    echo "Bir hata oluştu, log kaydedildi.";
}

//****** MyComopanyInformations Tablosunu Günceller *******//
try {
    if ($formType === 'companyUpdate') {
        // Kullanıcı bilgilerini güncelle
        $stmt = $pdo->prepare("UPDATE mycompanyinformations SET MyCompanyName=:MyCompanyName, MyCompanyAddress=:MyCompanyAddress, 
        MyCompanyTaxNumber=:MyCompanyTaxNumber, MyCompanyTaxOffice=:MyCompanyTaxOffice, BankName=:BankName,
        IBAN=:IBAN, MyCompanyTel=:MyCompanyTel, MyCompanyWebSite=:MyCompanyWebSite, UpdateDate=NOW()");
        $stmt->execute([
            ':MyCompanyName' => $_POST['MyCompanyName'],
            ':MyCompanyAddress' => $_POST['MyCompanyAddress'],
            ':MyCompanyTaxNumber' => $_POST['MyCompanyTaxNumber'],
            ':MyCompanyTaxOffice' => $_POST['MyCompanyTaxOffice'],
            ':BankName' => $_POST['BankName'],
            ':IBAN' => $_POST['IBAN'],
            ':MyCompanyTel' => $_POST['MyCompanyTel'],
            ':MyCompanyWebSite' => $_POST['MyCompanyWebSite']
        ]);
        if ($stmt) {
            // Başarılı ise
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Kayıt başarıyla güncellendi! ' . htmlspecialchars($_POST['firstName'])
            ];
            header("Location: PagesProfile.php");
            exit;
        } else {
            // Başarısız ise
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Kayıt Güncellenirken Bir Sorun Oluştu.'
            ];
            header("Location: PagesProfile.php");
            exit;
        }
    }

} catch (Exception $ex) {
    logError($pdo, $ex, "Update", "mycompanyinformations", $_SESSION['user_id'] ?? null);
    echo "Bir hata oluştu, log kaydedildi.";
}

//****** OfferPerson Tablosundan Kayıt Ekler *******//
try {
    if ($formType === 'personAdd') {
        $name = trim($_POST['PersonName']);
        $tel = trim($_POST['PersonTel']);
        $title = trim($_POST['PersonTitle']);


        $stmt = $pdo->prepare(" INSERT INTO offerpersons (PersonName, PersonTel, PersonTitle, CreateDate, UpdateDate, IsActive)
                VALUES (:name, :tel, :title, NOW(), NOW(), 1)
            ");
        $stmt->execute([
            ':name' => $name,
            ':tel' => $tel,
            ':title' => $title
        ]);

        if ($stmt) {
            // Başarılı ise
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Kayıt başarıyla güncellendi! ' . htmlspecialchars($_POST['firstName'])
            ];
            header("Location: PagesProfile.php");
            exit;
        } else {
            // Başarısız ise
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Kayıt Güncellenirken Bir Sorun Oluştu.'
            ];
            header("Location: PagesProfile.php");
            exit;
        }
    }
} catch (Exception $ex) {
    logError($pdo, $ex, "INSERT", "offerpersons", $_SESSION['user_id'] ?? null);
    echo "Bir hata oluştu, log kaydedildi.";
}

//****** OfferPerson Tablosundan Kayıt Siler *******//
try {
    if ($formType === 'personDelete') {
        $id = intval($_POST['PersonID']);

        $stmt = $pdo->prepare("DELETE FROM offerpersons WHERE PersonID = :id");
        $stmt->execute([':id' => $id]);

        if ($stmt) {
            // Başarılı ise
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Kayıt başarıyla güncellendi! ' . htmlspecialchars($_POST['firstName'])
            ];
            header("Location: PagesProfile.php");
            exit;
        } else {
            // Başarısız ise
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Kayıt Güncellenirken Bir Sorun Oluştu.'
            ];
            header("Location: PagesProfile.php");
            exit;
        }
    }
} catch (Exception $ex) {
    logError($pdo, $ex, "DELETE", "offerpersons", $_SESSION['user_id'] ?? null);
    echo "Bir hata oluştu, log kaydedildi.";
}

//****** OfferPerson Tablosundaki Kayıdı Günceller *******//
try {
    if ($formType === 'personUpdate') {
        $id = intval($_POST['PersonID']);
        $name = trim($_POST['PersonName']);
        $tel = trim($_POST['PersonTel']);
        $title = trim($_POST['PersonTitle']);


        $stmt = $pdo->prepare("
                UPDATE offerpersons
                SET PersonName = :name,
                    PersonTel  = :tel,
                    PersonTitle= :title,
                    UpdateDate = NOW()
                WHERE PersonID = :id
            ");
        $stmt->execute([
            ':name' => $name,
            ':tel' => $tel,
            ':title' => $title,
            ':id' => $id
        ]);

        if ($stmt) {
            // Başarılı ise
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Kayıt başarıyla güncellendi! ' . htmlspecialchars($_POST['firstName'])
            ];
            header("Location: PagesProfile.php");
            exit;
        } else {
            // Başarısız ise
            $_SESSION['alert'] = [
                'type' => 'error',
                'message' => 'Kayıt Güncellenirken Bir Sorun Oluştu.'
            ];
            header("Location: PagesProfile.php");
            exit;
        }
    }

} catch (Exception $ex) {
    logError($pdo, $ex, "Update", "offerpersons", $_SESSION['user_id'] ?? null);
    echo "Bir hata oluştu, log kaydedildi.";
}