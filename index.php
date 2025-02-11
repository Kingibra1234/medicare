<?php
	// Grabbing session variables, initializing $_SESSION
	session_start();

	// Redirect to overview if user navigates to '/'
	$prefix = '/medicare/';
	if ($_SERVER['REQUEST_URI'] === $prefix . 'index.php' || $_SERVER['REQUEST_URI'] === $prefix) {
		header('Location: login.php');
		exit;
	}

	// Function to check the relative path type to use
	function relativePath() {
		return count(explode('/', $_SERVER['PHP_SELF'])) === 4 ? '.' : '..';
	}

	function generatePageHead($pageTitle) {

		// Initialize path of urls
		$path = relativePath();

		// Check if user posted a logout request
		if (isset($_POST['logout']) || !$_SESSION['isLoggedIn']) {

			// Unset and destroy the session 
			session_unset();
			session_destroy();

			// Redirect to login page
			header("Location: $path/../login.php");
			exit;

		}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?= $path ?>/../css/utils.css">
		<link rel="stylesheet" href="<?= $path ?>/styles/header.css">
		<link rel="stylesheet" href="<?= $path ?>/styles/sidebar.css">
		<title>Medicare - <?= $pageTitle ?> </title>
	</head>
	<body>

		<!-- Import Header -->
		<?php require_once($path.'/components/header.php'); ?>

		<!-- Define Layout of body -->
		<div class="body-layout">

			<!-- Add Sidebar -->
			<?php require_once($path.'/components/sidebar.php') ?>

			<!-- Add Requested Page -->
			<main class="main-content">
				<div class="content-box">
<?php } ?>
<?php function generatePageFoot() { ?>
	<?php $path = relativePath(); ?>
				</div>
			</main>
		</div>
	
		<!-- JavaScript Imports -->
		<script src="<?= $path ?>/scripts/header.js"></script>
		<script src="<?= $path ?>/scripts/sidebar.js"></script>
	</body>
</html> 
<?php } ?>