<?php
if ( ! isset($error['message']))
	switch ($error['code']) {
		case 400:
			$error['message'] = 'The request cannot be fulfilled due to bad syntax.';
			break;

		case 401:
			$error['message'] = 'You are not authorized to view this page.';
			break;

		case 403:
			$error['message'] = 'You are not allowed to view this page.';
			break;

		case 404:
			$error['message'] = 'The page you were looking for cannot be found.';
			break;

		default:
			$error['message'] = 'Something went wrong.';
			break;
	}
?>
<!doctype html>
<!-- RSMVC: Page loaded in #timer# seconds (#queries# database queries took #queryTimer# seconds) -->
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $error['code']; ?>: <?php echo $error['description']; ?></title>
		<meta name="description" content="">
		<link rel="stylesheet" href="<?php echo $config['root']; ?>/static/css/main.css">
	</head>
	<body>
		<h1><?php echo $error['code']; ?>: <?php echo $error['description']; ?></h1>
		<p><?php echo $error['message']; ?></p>
		<p><?php echo $config['root'] . htmlspecialchars($_SERVER['REQUEST_URI']); ?></p>
	</body>
</html>