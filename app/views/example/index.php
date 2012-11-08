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
		<pre><b>Files used:</b><br>/app/controllers/example.php<br>/app/models/ExampleModel.php<br>/app/views/example/index.php</pre>
		<pre><b>$example</b> = <?php var_dump($example); ?></pre>
		<pre><b>$config</b> = <?php var_dump($config); ?></pre>
	</div>
</body>
</html>