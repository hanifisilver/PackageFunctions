<?php
// Kullanıcının mevcut bilgilerini veritabanından çek
include 'Connection.php';
include 'TimeOutChecked.php';
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
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords"
		content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-profile.html" />

	<title>CRMTT - Profil</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
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

							<div class="card mt-3">
								<div class="card-header">
									<h5 class="card-title mb-0">Teklif Verecek Kişiler</h5>
								</div>
								<div class="card-body">
									<!-- Listeleme -->
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>Ad Soyad</th>
												<th>Telefon</th>
												<th>Ünvan</th>
												<th>İşlemler</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$stmtP = $pdo->prepare("SELECT * FROM offerpersons WHERE IsActive = 1");
											$stmtP->execute();
											$persons = $stmtP->fetchAll(PDO::FETCH_ASSOC);

											foreach ($persons as $p): ?>
												<tr>
													<td><?= htmlspecialchars($p['PersonName']) ?></td>
													<td><?= htmlspecialchars($p['PersonTel']) ?></td>
													<td><?= htmlspecialchars($p['PersonTitle']) ?></td>
													<td>
														<!-- Düzenleme (JS ile forma dolduracak) -->
														<button type="button" class="btn btn-sm btn-warning" onclick="fillForm(<?= $p['PersonID'] ?>,
																'<?= htmlspecialchars($p['PersonName'], ENT_QUOTES) ?>',
																'<?= htmlspecialchars($p['PersonTel'], ENT_QUOTES) ?>',
																'<?= htmlspecialchars($p['PersonTitle'], ENT_QUOTES) ?>')">
															Düzenle
														</button>

														<!-- Silme -->
														<form method="post" action="PagesProfileQuery.php" class="d-inline"
															onsubmit="return confirm('Bu kişiyi silmek istediğinize emin misiniz?');">
															<input type="hidden" name="formType" value="personDelete">
															<input type="hidden" name="PersonID"
																value="<?= $p['PersonID'] ?>">
															<button type="submit" class="btn btn-sm btn-danger">Sil</button>
														</form>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>

									<!-- Kişi Formu -->
									<hr>
									<h6 id="formTitle">Yeni Kişi Ekle</h6>
									<form method="post" action="PagesProfileQuery.php" id="personForm">
										<input type="hidden" name="formType" id="formType" value="personAdd">
										<input type="hidden" name="PersonID" id="PersonID">
										<div class="row mb-2">
											<div class="col-md-4">
												<input type="text" name="PersonName" id="PersonName"
													class="form-control" placeholder="Ad Soyad" required>
											</div>
											<div class="col-md-4">
												<input type="text" name="PersonTel" id="PersonTel" class="form-control"
													placeholder="Telefon">
											</div>
											<div class="col-md-4">
												<input type="text" name="PersonTitle" id="PersonTitle"
													class="form-control" placeholder="Ünvan">
											</div>
										</div>
										<button type="submit" class="btn btn-primary" id="submitBtn">Ekle</button>
										<button type="button" class="btn btn-secondary d-none" id="cancelBtn"
											onclick="resetForm()">İptal</button>
									</form>
								</div>
							</div>

						</div>
					</div>

				</div>
			</main>

			<?php include 'Footer.php'; ?>
		</div>
	</div>

	<?php include 'SiteMasterBodyJS.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		// Formu doldur
		function fillForm(id, name, tel, title) {
			document.getElementById('formTitle').innerText = "Kişi Güncelle";
			document.getElementById('formType').value = "personUpdate";
			document.getElementById('PersonID').value = id;
			document.getElementById('PersonName').value = name;
			document.getElementById('PersonTel').value = tel;
			document.getElementById('PersonTitle').value = title;
			document.getElementById('submitBtn').innerText = "Güncelle";
			document.getElementById('cancelBtn').classList.remove("d-none");
		}

		// Formu sıfırla
		function resetForm() {
			document.getElementById('formTitle').innerText = "Yeni Kişi Ekle";
			document.getElementById('formType').value = "personAdd";
			document.getElementById('PersonID').value = "";
			document.getElementById('PersonName').value = "";
			document.getElementById('PersonTel').value = "";
			document.getElementById('PersonTitle').value = "";
			document.getElementById('submitBtn').innerText = "Ekle";
			document.getElementById('cancelBtn').classList.add("d-none");
		}
	</script>

</body>

</html>