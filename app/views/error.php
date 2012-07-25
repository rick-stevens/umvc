<?php include ROOT . 'app/views/includes/header.php'; ?>

<h1><?=$errorCode?> <?=$errorText?></h1>
<p><?=$errorDescription?></p>
<p><?=htmlspecialchars($input['url'])?></p>

<?php include ROOT . 'app/views/includes/footer.php'; ?>