<?php
include 'TimeOutChecked.php';
require "GlobalFunctions.php";
require "UserQuery.php";
require 'Language.php';
require 'init.php';

// Kullanıcı bilgisi
$user = [
	"UserName" => $_SESSION["UserName"] ?? 'Misafir',
	"Type" => $_SESSION["Type"] ?? 0  // 1 = Super User
];



?>
<!DOCTYPE html>
<html>

<head>
	<?php if (!empty($_SESSION['just_logged_in'])): ?>
		<script>
			window.onload = function () {
				location.reload();
			};
		</script>
		<?php unset($_SESSION['just_logged_in']); ?>
	<?php endif; ?>
	<?php include 'SiteMasterHeadCSS.php'; ?>
	<title><?= $lang->get('Homepage') ?></title>
	<style>
		.card.disabled {
			opacity: 0.5;
			pointer-events: none;
		}
	</style>
</head>

<body>
	<?php showAlert(); ?>

	<div class="wrapper">
		<?php include 'Sidebar.php'; ?>

		<div class="main">
			<?php include 'Navbar.php'; ?>

			<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

        <!-- 1. Satır: Basit İstatistik Kartları -->
        <div class="row">
            <!-- Sales -->
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Sales</h5>
                            </div>
                            <div class="col-auto">
                                <i class="align-middle text-primary" data-feather="truck"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">2.382</h1>
                        <span class="text-danger">-3.65%</span> <span class="text-muted">Since last week</span>
                    </div>
                </div>
            </div>

            <!-- Visitors -->
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Visitors</h5>
                            </div>
                            <div class="col-auto">
                                <i class="align-middle text-primary" data-feather="users"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">14.212</h1>
                        <span class="text-success">5.25%</span> <span class="text-muted">Since last week</span>
                    </div>
                </div>
            </div>

            <!-- Earnings (SuperUser Only) -->
            <div class="col-sm-6 col-xl-3">
                <div class="card <?= !isSuperUser() ? 'disabled' : '' ?>" title="<?= !isSuperUser() ? 'Süper User olmanız gerekir' : '' ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Earnings</h5>
                            </div>
                            <div class="col-auto">
                                <i class="align-middle text-primary" data-feather="dollar-sign"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">$21.300</h1>
                        <span class="text-success">6.65%</span> <span class="text-muted">Since last week</span>
                    </div>
                </div>
            </div>

            <!-- Orders (SuperUser Only) -->
            <div class="col-sm-6 col-xl-3">
                <div class="card <?= !isSuperUser() ? 'disabled' : '' ?>" title="<?= !isSuperUser() ? 'Süper User olmanız gerekir' : '' ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Orders</h5>
                            </div>
                            <div class="col-auto">
                                <i class="align-middle text-primary" data-feather="shopping-cart"></i>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">64</h1>
                        <span class="text-danger">-2.25%</span> <span class="text-muted">Since last week</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Satır: Grafik -->
        <div class="row mt-4">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recent Movement</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="chartjs-dashboard-line"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Satır: Tablolar / Harita / Takvim -->
        <div class="row mt-4">
            <div class="col-md-6 col-xxl-3">
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0">Browser Usage</h5></div>
                    <div class="card-body">
                        <canvas id="chartjs-dashboard-pie"></canvas>
                        <table class="table mt-2">
                            <tbody>
                                <tr><td>Chrome</td><td class="text-end">4306</td></tr>
                                <tr><td>Firefox</td><td class="text-end">3801</td></tr>
                                <tr><td>IE</td><td class="text-end">1689</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xxl-6">
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0">Real-Time</h5></div>
                    <div class="card-body" style="height:350px;">
                        <div id="world_map"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xxl-3">
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0">Calendar</h5></div>
                    <div class="card-body">
                        <div id="datetimepicker-dashboard"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Satır: Project Listesi ve Monthly Sales -->
        <div class="row mt-4">
            <div class="col-lg-8 col-xxl-9">
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0">Latest Projects</h5></div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Assignee</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Project Apollo</td>
                                <td>01/01/2023</td>
                                <td>31/06/2023</td>
                                <td><span class="badge bg-success">Done</span></td>
                                <td>Vanessa Tucker</td>
                            </tr>
                            <!-- Diğer projeler -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4 col-xxl-3">
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0">Monthly Sales</h5></div>
                    <div class="card-body">
                        <canvas id="chartjs-dashboard-bar"></canvas>
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

</body>

</html>