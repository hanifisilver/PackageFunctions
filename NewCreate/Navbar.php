<?php
require 'UserQuery.php';

$lang = new Language();
$user = [
    "UserName" => $_SESSION["UserName"] ?? '',
    "Type" => $_SESSION["Type"] ?? 0
];

// Dil değişimini kontrol et (HTML çıktısından önce)
if (isset($_GET['lang'])) {
    $lang->setLanguage($_GET['lang']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <!-- Kullanıcı Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="" />
                    <span class=""><?= htmlspecialchars($user['UserName']) ?></span>
                    <?php if ($user['Type'] == 1): ?>
                        <span class="badge bg-danger ms-1">Super User</span>
                    <?php endif; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="./PagesProfile.php">
                        <i class="align-middle me-1" data-feather="user"></i> <?= $lang->get('Profile') ?>
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="align-middle me-1" data-feather="pie-chart"></i> <?= $lang->get('PDFContent') ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./UserManual.php">
                        <i class="align-middle me-1" data-feather="help-circle"></i> <?= $lang->get('Help') ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="./SignOut.php"><?= $lang->get('Logout') ?></a>
                </div>
            </li>

            <!-- Dil Dropdown -->
            <li class="nav-item me-3">
                <?php include 'LanguageDropdown.php'; ?>
            </li>

            <!-- Dark/Light Toggle -->
            <li class="nav-item">
                <?php include 'DarkLightMode.php'; ?>
            </li>

        </ul>
    </div>
</nav>