<?php
include 'TimeOutChecked.php';
require_once "GlobalFunctions.php";

?>
<!DOCTYPE html>
<html lang="tr">

<head>
	<?php include 'SiteMasterHeadCSS.php'; ?>
	<title>Anasayfa | CRM - Teknik Tanker</title>
</head>

<body>
	<?php showAlert(); ?>
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