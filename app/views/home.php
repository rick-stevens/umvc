<?php include ROOT . 'app/views/includes/header.php'; ?>

<pre><?php var_dump($input); ?></pre>

<?php
if ($query) {
	echo '<p>Found ' . $query->rowCount() . ' rows:</p>';
	
	// Even though $query is an object (PDOStatement), it can be iterated:
	foreach ($query as $row)
		echo '<div>' . $row['id'] . ' - ' . htmlspecialchars($row['name']) . '</div>';
}
?>

<?php include ROOT . 'app/views/includes/footer.php'; ?>