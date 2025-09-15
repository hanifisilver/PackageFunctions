<?php
// Kullanıcının mevcut bilgilerini veritabanından çek
include 'Connection.php';
$userID = $_SESSION['UserID'] ?? null;
$user = [];

if ($userID) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE UserID = :uid LIMIT 1");
    $stmt->execute([':uid' => $userID]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmtC = $pdo->query("SELECT * FROM mycompanyinformations LIMIT 1");
    $company = $stmtC->fetch(PDO::FETCH_ASSOC);
}
?>
<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="" /> <span
                        class="text-dark"><?= htmlspecialchars($user['Name'] ?? '') ?></php></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="./PagesProfile.php"><i class="align-middle me-1"
                            data-feather="user"></i> Profil</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i>
                        PDF İçerik</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./UserManual.php"><i class="align-middle me-1"
                            data-feather="help-circle"></i> Kullanım Kılavuzu</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./Logout.php">Çıkış Yap</a>
                </div>
            </li>
        </ul>
    </div>
</nav>