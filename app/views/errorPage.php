<?php include ROOT . 'app/views/includes/header.php';

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

<h1><?=$errorCode?>: <?=$errorText?></h1>
<p><?=$message?></p>
<p><?=$config['root'] . htmlspecialchars(substr($_SERVER['REQUEST_URI'], 1))?></p>

<?php include ROOT . 'app/views/includes/footer.php'; ?>