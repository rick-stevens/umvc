<!doctype html>
<!-- RSMVC: Page loaded in #timer# seconds (#queries# database queries took #queryTimer# seconds) -->
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="<?php echo $config['root']; ?>/static/css/main.css">
	</head>
	<body>
		<p><b>Files used:</b></p>
		<p>
			/app/configs/config.php (<code>$config['routes']['/']</code>)<br>
			/app/models/ExampleModel.php<br>
			/app/views/example/index.php<br>
			/app/controllers/example.php
		</p>
		<pre><b>$exampleData</b> = <?php var_dump($exampleData); ?></pre>
		<pre><b>$config</b> = <?php var_dump($config); ?></pre>
	</body>
</html>