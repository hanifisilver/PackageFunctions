<?php
// Oturum Açmış Kullnıcının Bilgilerini Getirir

include 'Connection.php';

$userID = $_SESSION['UserID'] ?? null;
$user = [];

if ($userID) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE UserID = :uid LIMIT 1");
    $stmt->execute([':uid' => $userID]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>