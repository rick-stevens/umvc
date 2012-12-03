<!doctype html>
<!-- RSMVC: Page loaded in #timer# seconds (#queries# database queries took #queryTimer# seconds) -->
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="description" content="">
		<link rel="stylesheet" href="<?php echo $config['root']; ?>/static/css/main.css">
	</head>
	<body>
		<p><b>Files used:</b></p>
		<p>
			/app/configs/config.php (<code>$config['routes']['/']</code>)<br>
			/app/models/HomeModel.php<br>
			/app/views/home/index.php<br>
			/app/controllers/home.php
		</p>
		<pre><b>$exampleData</b> = <?php var_dump($exampleData); ?></pre>
		<pre><b>$config</b> = <?php var_dump($config); ?></pre>
	</body>
</html>