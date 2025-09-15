<?php
session_start();
?>
<html lang="tr">
<head>
    <?php include 'SiteMasterHeadCSS.php'; ?>
    <title>Kayıt Ol | CRMTT</title>
</head>

<body>
    <?php if (isset($_SESSION['alert'])): ?>
        <div id="customAlert" class="alert-box <?= $_SESSION['alert']['type']; ?>">
            <span class="alert-close">&times;</span>
            <?php
            if (is_array($_SESSION['alert']['message'])) {
                echo "<ul>";
                foreach ($_SESSION['alert']['message'] as $msg) {
                    echo "<li>{$msg}</li>";
                }
                echo "</ul>";
            } else {
                echo $_SESSION['alert']['message'];
            }
            ?>
        </div>
        <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>
    <main class="d-flex w-100 h-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h1">BAŞLAYALIM</h1>
                            <p class="lead">
                                En İyi Kullanıcı Deneyimi.
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-3">
                                    <form action="SignUpAddToSql.php" method="post">
                                        <div class="mb-3">
                                            <label class="form-label">İsim</label>
                                            <input class="form-control form-control-lg" type="text" name="Name"
                                                placeholder="İsminizi Giriniz">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Soyisim</label>
                                            <input class="form-control form-control-lg" type="text" name="Surname"
                                                placeholder="Soyisiminizi Giriniz">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="email" name="Email"
                                                placeholder="E-Mail Adresinizi Giriniz">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Şifre</label>
                                            <input class="form-control form-control-lg" type="password" name="Password"
                                                placeholder="Şifrenizi Giriniz">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Şifre Tekrar</label>
                                            <input class="form-control form-control-lg" type="password"
                                                name="PasswordAgain" placeholder="Şifrenizi Tekrar Giriniz">
                                        </div>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Kayıt Ol</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mb-3">
                            Already have account? <a href="./SignIn.php">Giriş Yap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'SiteMasterBodyJS.php'; ?>
</body>

</html>