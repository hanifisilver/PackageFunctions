<html lang="tr">

<head>
    <?php include 'SiteMasterHeadCSS.php'; ?>
    <title>Kayıt Ol | CRMTT</title>


</head>

<body>
    <main class="d-flex w-100 h-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h1">BAŞLAYALIM</h1>
                            <p class="lead">
                                CRMTT En İyi Kullanıcı Deneyimi.
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-3">
                                    <form action="RegisterAddToSql.php" method="post">
                                        <div class="mb-3">
                                            <label class="form-label">Kullanıcı Adı</label>
                                            <input class="form-control form-control-lg" type="text" name="username"
                                                placeholder="Kullanıcı Adı">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="email" name="email"
                                                placeholder="Enter your email">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Şifre</label>
                                            <input class="form-control form-control-lg" type="password" name="password"
                                                placeholder="Enter password">
                                        </div>
                                        <div class="d-grid gap-2 mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Kayıt Ol</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mb-3">
                            Already have account? <a href="./Login.php">Giriş Yap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'SiteMasterBodyJS.php'; ?>
</body>

</html>