<!doctype html>
<!-- #version#: Page loaded in #timer# ms (#queries# database queries took #queryTimer# ms) -->
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php echo $config['root']; ?>/static/css/main.css">
	</head>
	<body>
		<!--[if lt IE 8]>
		<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve the speed, security and experience.</p>
		<![endif]-->

		<pre><b>$example</b> = <?php var_dump($example); ?></pre>
		<pre><b>$config</b> = <?php var_dump($config); ?></pre>
	</body>
</html>