<?php
if ( ! isset($error['message']))
	switch ($error['code']) {
		case 401:
			$error['message'] = 'Sorry, you are not authorized to view this page.';
			break;

		case 403:
			$error['message'] = 'Sorry, you are not allowed to view this page.';
			break;

		case 404:
			$error['message'] = 'Sorry, the page you are looking for doesn\'t exist.';
			break;

		default:
			$error['message'] = 'Sorry, something went wrong.';
			break;
	}
?>
<!doctype html>
<!-- #version#: Page loaded in #timer# ms (#queries# database queries took #query_timer# ms) -->
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $error['code']; ?> <?php echo $error['description']; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			* {
				margin: 0;
				line-height: 1;
			}

			html {
				padding: 6em 1em;
				font-family: sans-serif;
				font-size: 1.5em;
				color: #555;
				text-align: center;
				background-color: #f4f4f4;
			}

			h1 {
				font-size: 3em;
				font-weight: 400;
				letter-spacing: -.05em;
			}

			p {
				margin: 1em 0;
				line-height: 1.4;
			}

			span {
				color: #999;
			}

			a {
				color: #428bca;
				text-decoration: none;
			}

			a:hover,
			a:focus {
				text-decoration: underline;
			}

			@media only screen and (max-width: 768px) {
				html {
					font-size: 1em;
				}
			}
		</style>
	</head>
	<body>
		<h1><span><?php echo $error['code']; ?></span> <?php echo $error['description']; ?></h1>
		<p><?php echo htmlspecialchars($error['message']); ?></p>
		<small><a href="//<?php echo $config['root']; ?>"><?php echo $config['root']; ?></a></small>
	</body>
</html>