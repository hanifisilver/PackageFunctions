<?php
session_start();
?>
<html lang="tr">

<head>
	<?php include 'SiteMasterHeadCSS.php'; ?>
	<title>Giriş Yap | CRMTT</title>
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
							<h1 class="h1">CRMTT TEKNİK TANKER</h1>
							<p class="lead">Devam Etmek İçin Giriş Yapın</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<!-- FORM BAŞLANGICI -->
									<form method="post" action="SignInChecked.php">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email"
												placeholder="Email adresinizi giriniz" required>
										</div>
										<div class="mb-3">
											<label class="form-label">Şifre</label>
											<input class="form-control form-control-lg" type="password" name="password"
												placeholder="Şifrenizi giriniz" required>
											<small>
												<a href="/pages-reset-password">Şifreni mi Unuttun?</a>
											</small>
										</div>
										<div>
											<div class="form-check align-items-center">
												<input id="customControlInline" type="checkbox" class="form-check-input"
													value="1" name="remember_me">
												<label class="form-check-label text-small"
													for="customControlInline">Beni Hatırla</label>
											</div>
										</div>
										<div class="d-grid gap-2 mt-3">
											<button type="submit" class="btn btn-lg btn-primary">
												Giriş Yap
											</button>
										</div>
									</form>
									<!-- FORM BİTİŞİ -->
								</div>
							</div>
						</div>

						<div class="text-center mb-3">
							Hesabın Yok mu? <a href="./SignUp.php">Kayıt Ol</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?php include 'SiteMasterBodyJS.php'; ?>
</body>


</html>