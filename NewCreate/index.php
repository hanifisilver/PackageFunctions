<?php
include 'TimeOutChecked.php';

?>
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

			

			<?php include 'Footer.php'; ?>
		</div>
	</div>
	<?php include 'SiteMasterBodyJS.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>