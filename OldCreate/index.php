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
<?php include 'DashboardQuery.php'; ?>
<!DOCTYPE html>
<html lang="tr">

<head>
	<?php include 'SiteMasterHeadCSS.php'; ?>
	<title>Anasayfa | CRM - Teknik Tanker</title>
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
				<div class="container-fluid py-4">

					<!-- İstatistik Kartları -->
					<div class="row g-4">
						<div class="col-md-3 col-sm-6">
							<div class="card bg-primary text-white shadow-sm rounded-3">
								<div class="card-body text-white">
									<h6 class="card-title  text-white">Toplam Teklif</h6>
									<h2 class="fw-bold text-white"><?= $totalOffers ?></h2>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="card bg-success text-white shadow-sm rounded-3">
								<div class="card-body text-white">
									<h6 class="card-title text-white">Bu Ay Teklifler</h6>
									<h2 class="fw-bold text-white"><?= $monthlyOffers ?></h2>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="card bg-dark text-white shadow-sm rounded-3">
								<div class="card-body">
									<h6 class="card-title text-white">Toplam Müşteri</h6>
									<h2 class="fw-bold text-white"><?= $totalCustomers ?></h2>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="card bg-warning text-white shadow-sm rounded-3">
								<div class="card-body">
									<h6 class="card-title text-white">Son Teklif</h6>
									<h2 class="fw-bold text-white"><?= $lastOffer['InvoiceNumber'] ?? '-' ?></h2>
									<small><?= $lastOffer ? date("d.m.Y", strtotime($lastOffer['CreateDate'])) : '-' ?></small>
								</div>
							</div>
						</div>
					</div>

					<!-- Son 10 Teklif -->
					<div class="row mt-4">
						<div class="col-lg-8">
							<div class="card shadow-sm rounded-3">
								<div class="card-header bg-light">
									<h5>Son 10 Teklif</h5>
								</div>
								<div class="card-body table-responsive">
									<table class="table table-sm align-middle">
										<thead class="table-dark text-white">
											<tr>
												<th>#</th>
												<th>Firma</th>
												<th>Ürün</th>
												<th>Tarih</th>
												<th>Durum</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($lastOffers as $offer): ?>
												<tr>
													<td><?= $offer['InvoiceNumber'] ?></td>
													<td><?= $offer['CompanyName'] ?></td>
													<td><?= $offer['OfferType'] ?></td>
													<td><?= date("d.m.Y", strtotime($offer['CreateDate'])) ?></td>
													<td>
														<?php if ($offer['Status'] === 'Onaylandı'): ?>
															<span class="badge bg-success">Onaylandı</span>
														<?php elseif ($offer['Status'] === 'Beklemede'): ?>
															<span class="badge bg-warning">Beklemede</span>
														<?php else: ?>
															<span class="badge bg-danger">Reddedildi</span>
														<?php endif; ?>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<!-- En Çok Teklif Verilen Şirketler -->
						<div class="col-lg-4 mt-4 mt-lg-0">
							<div class="card shadow-sm rounded-3">
								<div class="card-header bg-light">
									<h5>Top 10 Şirket</h5>
								</div>
								<div class="card-body">
									<ul class="list-group list-group-flush">
										<?php foreach ($topCompanies as $company): ?>
											<li class="list-group-item d-flex justify-content-between align-items-center">
												<?= $company['CompanyName'] ?>
												<span
													class="badge bg-primary rounded-pill"><?= $company['OfferCount'] ?></span>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<!-- Grafik ve Döviz -->
					<div class="row mt-4">
						<div class="col-lg-8">
							<div class="card shadow-sm rounded-3">
								<div class="card-header bg-light">
									<h5>Aylara Göre Teklif Sayısı</h5>
								</div>
								<div class="card-body">
									<canvas id="offersChart" height="100"></canvas>
								</div>
							</div>
						</div>
						<div class="col-lg-4 mt-4 mt-lg-0">
							<div class="card shadow-sm rounded-3">
								<div class="card-header bg-light">
									<h5>Döviz Kurları</h5>
								</div>
								<div class="card-body">
									<ul class="list-group list-group-flush">
										<li class="list-group-item d-flex justify-content-between align-items-center">
											USD / TRY <span
												class="badge bg-primary fs-6"><?= number_format($usd, 2) ?></span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											EUR / TRY <span
												class="badge bg-success fs-6"><?= number_format($eur, 2) ?></span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											GBP / TRY <span
												class="badge bg-dark fs-6"><?= number_format($gbp, 2) ?></span>
										</li>
										<li class="list-group-item d-flex justify-content-between align-items-center">
											CHF / TRY <span
												class="badge bg-warning text-dark fs-6"><?= number_format($chf, 2) ?></span>
										</li>
									</ul>
									<small class="text-muted d-block mt-2">Merkez Bankası verileri</small>
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
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
		const ctx = document.getElementById('offersChart');
		new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara'],
				datasets: [{
					label: 'Teklif Sayısı',
					data: <?= json_encode($chartData) ?>,
					backgroundColor: '#0d6efd'
				}]
			},
			options: {
				responsive: true,
				plugins: { legend: { display: false } },
				scales: { y: { beginAtZero: true } }
			}
		});
	</script>
</body>

</html>