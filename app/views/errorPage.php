<?php
if ( ! isset($message))
	switch ($errorCode) {
		case 400:
			$message = 'The request cannot be fulfilled due to bad syntax.';
			break;

		case 401:
			$message = 'You are not authorized to view this page.';
			break;

		case 403:
			$message = 'You cannot view this page.';
			break;

		case 404:
			$message = 'The page you were looking for cannot be found.';
			break;

		default:
			$message = 'Something went wrong.';
			break;
	}
?>
<!doctype html>
<!-- RSMVC: Page loaded in #timer# seconds (#queries# database queries took #queryTimer# seconds). -->
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="description" content="">
	<link rel="stylesheet" href="<?php echo $config['root']; ?>static/css/main.css">
</head>
<body>
	<div id="main">
		<h1><?php echo $errorCode; ?>: <?php echo $errorText; ?></h1>
		<p><?php echo $message; ?></p>
		<p><?php echo $config['root'] . htmlspecialchars(substr($_SERVER['REQUEST_URI'], 1)); ?></p>
	</div>
</body>
</html>