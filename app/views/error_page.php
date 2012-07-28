<?php
include ROOT . 'app/views/includes/header.php';

switch ($errorCode) {
	case 400:
		$errorDescription = 'The request cannot be fulfilled due to bad syntax.';
		break;
	
	case 401:
		$errorDescription = 'You are not authorized to view this page.';
		break;
	
	case 403:
		$errorDescription = 'You are not allowed to view this page.';
		break;
	
	case 404:
		$errorDescription = 'The page you were looking for cannot be found.';
		break;
	
	default:
	case 500:
		$errorDescription = 'Something went wrong.';
		break;
}
?>

<h1><?=$errorCode?> - <?=$errorText?></h1>
<p><?=$errorDescription?></p>
<p><?=HTTP_ROOT . 	htmlspecialchars($input['url'])?></p>

<?php include ROOT . 'app/views/includes/footer.php'; ?>