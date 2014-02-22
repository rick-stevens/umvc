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
<!-- #version# (#mode#): Page loaded in #timer# ms (#queries# database queries took #query_timer# ms) -->
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $error['code']; ?> <?php echo $error['description']; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			* {
				margin: 0;
				line-height: 1.5;
			}

			html {
				font-family: sans-serif;
				text-align: center;
				color: #888;
			}

			body {
				position: absolute;
				top: 50%;
				left: 5%;
				margin-top: -52px;
				width: 90%;
			}

			h1 {
				font-size: 2em;
				font-weight: 400;
				letter-spacing: -.05em;
				color: #555;
			}

			span {
				color: #ccc;
			}

			p {
				margin-bottom: .5em;
			}

			a {
				text-decoration: none;
				color: #39C;
			}

				a:hover,
				a:focus {
					text-decoration: underline;
				}
		</style>
	</head>
	<body>
		<h1><span><?php echo $error['code']; ?></span> <?php echo $error['description']; ?></h1>
		<p><?php echo htmlspecialchars($error['message']); ?></p>
		<small><a href="//<?php echo $config['root']; ?>/"><?php echo $config['root']; ?></a></small>
	</body>
</html>