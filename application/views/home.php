<?php include ROOT . '/application/views/includes/header.php'; ?>

<pre><?php
	// $input (array) will be populated with info gathered from the URL.
	var_dump($input);
	
	if ($query) {
		echo "\n" . $query->rowCount() . ' rows:';
		
		// Even though $query is an object, it can be iterated as an array:
		foreach($query as $row) {
			echo "\n" . $row['id'] . ' ' . htmlspecialchars($row['name']);
		}
	}
?></pre>

<?php include ROOT . '/application/views/includes/footer.php'; ?>