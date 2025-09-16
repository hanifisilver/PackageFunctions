<?php
require 'UserQuery.php';
include 'TimeOutChecked.php';
require "GlobalFunctions.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include 'SiteMasterHeadCSS.php'; ?>
	<title>Profil | Paket Fonksiyonlar</title>

</head>

<body>
	<?php showAlert(); ?>
	<div class="wrapper">
		<?php include 'Sidebar.php'; ?>

		<div class="main">
			<?php include 'Navbar.php'; ?>

			<main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-md-4 col-xl-3">
							<div class="card mb-3">
								<div class="card-header">
									<h5 class="card-title mb-0">Profil</h5>
								</div>
								<div class="card-body">
									<div class="card-body text-center">
										<img src="img/photos/logo1.png" alt="Christina Mason"
											class="img-fluid rounded-circle mb-2" width="128" height="128" />
										<h5 class="card-title mb-0"><?= htmlspecialchars($user['Name'] ?? '') ?>
											<?= htmlspecialchars($user['Surname'] ?? '') ?>
										</h5>

									</div>
									<hr class="my-0" />
									<!-- 1️⃣ Kullanıcı Bilgileri Güncelleme Formu -->
									<form method="POST" action="PagesProfileQuery.php">
										<input type="hidden" name="formType" value="infoUpdate">
										<div class="mb-2">
											<label for="firstName" class="form-label">Ad</label>
											<input type="text" class="form-control" name="firstName" id="firstName"
												value="<?= htmlspecialchars($user['Name'] ?? '') ?>" required>
										</div>
										<div class="mb-2">
											<label for="lastName" class="form-label">Soyad</label>
											<input type="text" class="form-control" name="lastName" id="lastName"
												value="<?= htmlspecialchars($user['Surname'] ?? '') ?>" required>
										</div>
										<div class="mb-2">
											<label for="gender" class="form-label">Cinsiyet</label>
											<select name="gender" id="gender" class="form-select" required>
												<option value="Erkek" <?= ($user['Gender'] ?? '') == 'Erkek' ? 'selected' : '' ?>>Erkek</option>
												<option value="Kadın" <?= ($user['Gender'] ?? '') == 'Kadın' ? 'selected' : '' ?>>Kadın</option>
											</select>
										</div>
										<div class="mb-2">
											<label for="email" class="form-label">E-Mail</label>
											<input type="email" class="form-control" name="email" id="email"
												value="<?= htmlspecialchars($user['Mail'] ?? '') ?>" required>
										</div>
										<div class="mb-2">
											<label for="phone" class="form-label">Telefon</label>
											<input type="text" class="form-control" name="phone" id="phone"
												value="<?= htmlspecialchars($user['Tel'] ?? '') ?>">
										</div>
										<button type="submit" class="btn btn-primary mt-2 mb-3">Güncelle</button>
									</form>

									<hr class="my-0" />

									<!-- 2️⃣ Şifre Güncelleme Formu -->
									<form method="POST" action="PagesProfileQuery.php">
										<input type="hidden" name="formType" value="passwordUpdate">
										<div class="mb-2">
											<label for="password" class="form-label">Yeni Şifre</label>
											<input type="password" class="form-control" name="password" id="password"
												required>
										</div>
										<div class="mb-2">
											<label for="passwordConfirm" class="form-label">Yeni Şifre (Tekrar)</label>
											<input type="password" class="form-control" name="passwordConfirm"
												id="passwordConfirm" required>
										</div>
										<button type="submit" class="btn btn-primary mt-2">Güncelle</button>
									</form>

								</div>
							</div>
						</div>
						<?php if (isSuperUser()): ?>
							<div class="col-md-8 col-xl-9">
								<div class="card mb-3">
									<div class="card-header">
										<h5 class="card-title mb-0">Şirket Bilgileri Güncelleme</h5>
									</div>
									<div class="card-body">
										<form action="PagesProfileQuery.php" method="post">
											<input type="hidden" name="formType" value="companyUpdate">

											<div class="mb-3">
												<label class="form-label">Şirket Adı</label>
												<input type="text" name="MyCompanyName" class="form-control"
													value="<?php echo htmlspecialchars($company['MyCompanyName'] ?? ''); ?>">
											</div>

											<div class="mb-3">
												<label class="form-label">Adres</label>
												<input type="text" name="MyCompanyAddress" class="form-control"
													value="<?php echo htmlspecialchars($company['MyCompanyAddress'] ?? ''); ?>">
											</div>

											<div class="mb-3">
												<label class="form-label">Vergi Numarası</label>
												<input type="text" name="MyCompanyTaxNumber" class="form-control"
													value="<?php echo htmlspecialchars($company['MyCompanyTaxNumber'] ?? ''); ?>">
											</div>

											<div class="mb-3">
												<label class="form-label">Vergi Dairesi</label>
												<input type="text" name="MyCompanyTaxOffice" class="form-control"
													value="<?php echo htmlspecialchars($company['MyCompanyTaxOffice'] ?? ''); ?>">
											</div>

											<div class="mb-3">
												<label class="form-label">Banka Adı</label>
												<input type="text" name="BankName" class="form-control"
													value="<?php echo htmlspecialchars($company['BankName'] ?? ''); ?>">
											</div>

											<div class="mb-3">
												<label class="form-label">IBAN</label>
												<input type="text" name="IBAN" class="form-control"
													value="<?php echo htmlspecialchars($company['IBAN'] ?? ''); ?>">
											</div>

											<div class="mb-3">
												<label class="form-label">Telefon</label>
												<input type="text" name="MyCompanyTel" class="form-control"
													value="<?php echo htmlspecialchars($company['MyCompanyTel'] ?? ''); ?>">
											</div>

											<div class="mb-3">
												<label class="form-label">Web Sitesi</label>
												<input type="text" name="MyCompanyWebSite" class="form-control"
													value="<?php echo htmlspecialchars($company['MyCompanyWebSite'] ?? ''); ?>">
											</div>

											<button type="submit" class="btn btn-primary">Güncelle</button>
										</form>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>

				</div>
			</main>

			<?php include 'Footer.php'; ?>
		</div>
	</div>

	<?php include 'SiteMasterBodyJS.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>